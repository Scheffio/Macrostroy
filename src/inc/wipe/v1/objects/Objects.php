<?php
namespace wipe\inc\v1\objects;

use DB\Base\ObjGroupQuery;
use DB\Base\ObjHouseQuery;
use DB\Base\ObjProjectQuery;
use DB\Base\ObjStageQuery;
use DB\Base\ObjSubprojectQuery;
use DB\Map\ObjGroupTableMap;
use DB\Map\ObjHouseTableMap;
use DB\Map\ObjProjectTableMap;
use DB\Map\ObjStageMaterialTableMap;
use DB\Map\ObjStageTableMap;
use DB\Map\ObjStageTechnicTableMap;
use DB\Map\ObjStageWorkTableMap;
use DB\Map\ObjSubprojectTableMap;
use ext\ObjGroup;
use ext\ObjHouse;
use ext\ObjProject;
use ext\ObjStage;
use ext\ObjSubproject;
use inc\artemy\v1\json_output\JsonOutput;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\PropelQuery;
use wipe\inc\v1\access_lvl\AccessLvl;
use wipe\inc\v1\access_lvl\enum\eLvlObjInt;
use wipe\inc\v1\access_lvl\enum\eLvlObjStr;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlIntException;
use wipe\inc\v1\access_lvl\exception\InvalidAccessLvlStrException;
use wipe\inc\v1\objects\children\Group;
use wipe\inc\v1\objects\children\House;
use wipe\inc\v1\objects\children\Project;
use wipe\inc\v1\objects\children\Stage;
use wipe\inc\v1\objects\children\Subproject;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\ObjectIsDeletedException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\ProjectRole;
use wipe\inc\v1\role\user_role\AuthUserRole;

class Objects
{
    public const ATTRIBUTE_STATUS_IN_PROCESS = 'in_process';
    public const ATTRIBUTE_STATUS_COMPLETED = 'completed';
    public const ATTRIBUTE_STATUS_DELETED = 'deleted';

    public const ATTRIBUTE_IS_PUBLIC_OPEN_ACCESS = true;
    public const ATTRIBUTE_IS_PUBLIC_PRIVATE_ACCESS = false;

    public const ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS = true;
    public const ATTRIBUTE_IS_AVAILABLE_DELETED_ACCESS = false;

    /** @var int|null Номер уровня доступа. */
    protected ?int $lvlInt = null;

    /** @var string|null Наименвание уровня доступа. */
    protected ?string $lvlStr = null;

    /** @var int|null ID объекта. */
    protected ?int $id = null;

    /** @var string|null Наименование объекта. */
    protected ?string $name = null;

    /** @var string|null Статус разработки объекта (в процессе, завершен, удален). */
    protected ?string $status = null;

    /** @var bool|null Доступ к объекту (пуличный, приватный). */
    protected ?bool $isPublic = null;

    /** @var bool|null Доступ к объекту (доступен, удален). */
    protected ?bool $isAvailable = null;

    /** @var mixed Объект класса (подкласса). */
    protected mixed $object = null;

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * @return void
     */
    public function applyDefault(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->isPublic = $this::ATTRIBUTE_IS_PUBLIC_OPEN_ACCESS;
        $this->isAvailable = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    /**
     * Заполнение свойств класса, используя объект.
     * @return void
     * @throws NoFindObjectException
     */
    public function applyByObj(): void
    {
        if ($this->object === null) throw new NoFindObjectException();

        $this->name = $this->object->getName();
        $this->status = $this->object->getStatus();
        $this->isPublic = $this->object->getIsPublic();
        $this->isAvailable = $this->object->getIsAvailable();
    }
    #endregion

    #region Access Control Functions
    /** @return bool|null Доступ к объекту (доступен, удален). */
    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    /**
     * Данный объект является доступным, иначе - ошибка.
     * @return Objects
     * @throws AccessDeniedException
     */
    public function isAvailableOrThrow(): Objects
    {
        return $this->isAvailable ? $this : throw new AccessDeniedException();
    }

    /** @return bool|null Доступ к объекту (доступен, удален). */
    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * Данный объект является публичным, иначе - ошибка.
     * @return Objects
     * @throws AccessDeniedException
     */
    public function isPublicOrThrow(): Objects
    {
        return $this->isPublic ? $this : throw new AccessDeniedException();
    }

    /**
     * Данный объект доступен для редактирования, т.е. статус разработки равен "В процессе", иначе - ошибка.
     * @return Objects
     * @throws AccessDeniedException
     */
    public function isAccessEditOrThrow(): Objects
    {
        return $this->status === $this::ATTRIBUTE_STATUS_IN_PROCESS ? $this : throw new AccessDeniedException();
    }

    /**
     * Сущетсвует ли данный объект в БД.
     * @return bool
     * @throws IncorrectLvlException
     */
    public function isExisting(): bool
    {
        $className = self::getColStatusByLvl($this->lvlInt);

        return PropelQuery::from($className)->findPk($this->id) !== null;
    }

    /**
     * Сущетсвует ли данный объект в БД, иначе - ошибка.
     * @return Objects
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function isExistingOrThrow(): Objects
    {
        return $this->isExisting() ? $this : throw new NoFindObjectException();
    }

    /**
     * Данный объект доступен для редатирования.
     * @return bool
     * @throws IncorrectLvlException
     */
    public function isEditable(): bool
    {
        $colStatus = self::getColStatusByLvl($this->lvlInt);
        $className = self::getClassNameObjByLvl($this->lvlInt);

        return  PropelQuery::from($className)
                ->where($colStatus . '=?', self::ATTRIBUTE_STATUS_IN_PROCESS)
                ->findPk($this->id) !== null;
    }

    /**
     * Данный объект доступен для редатирования, иначе - ошибка.
     * @return Objects
     * @throws IncorrectLvlException
     * @throws ObjectIsNotEditableException
     */
    public function isEditableOrThrow(): Objects
    {
        return $this->isEditable() ? $this : throw new ObjectIsNotEditableException();
    }

    /**
     * Данный объект не является удаленным.
     * @return bool
     * @throws IncorrectLvlException
     */
    public function isNotDeletedTable(): bool
    {
        $colStatus = self::getColStatusByLvl($this->lvlInt);
        $className = self::getClassNameObjByLvl($this->lvlInt);

        return  PropelQuery::from($className)
                ->where($colStatus . '!=?', self::ATTRIBUTE_STATUS_DELETED)
                ->findPk($this->id) !== null;
    }

    /**
     * Данный объект не является удаленным, иначе - ошибка.
     * @return Objects
     * @throws IncorrectLvlException
     * @throws ObjectIsDeletedException
     */
    public function isNotDeletedTableOrThrow(): Objects
    {
        return self::isNotDeletedTable() ? $this : throw new ObjectIsDeletedException();
    }
    #endregion

    #region Getter Functions
    /** @return int|null ID объекта. */
    public function getId(): ?int
    {
        return $this->id;
    }

    /** @return string|null Наименование объекта. */
    public function getName(): ?string
    {
        return $this->name;
    }

    /** @return string|null  Статус разработки объекта (в процессе, завершен, удален). */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /** @return ObjProject|ObjSubproject|ObjGroup|ObjHouse|ObjStage|null Объект класса (подкласса). */
    public function getObj(): null|ObjProject|ObjSubproject|ObjGroup|ObjHouse|ObjStage
    {
        return $this->object;
    }

    /** @return int|null Номер уровня доступа. */
    public function getAccessLvlInt(): ?int
    {
        return $this->lvlInt;
    }

    /**
     * @return string|null Наименвание уровня доступа.
     * @throws InvalidAccessLvlIntException
     */
    public function getAccessLvlStr(): ?string
    {
        return $this->lvlInt ? AccessLvl::getAccessLvlStrObjByInt($this->lvlInt) : null;
    }

    /**
     * Поиск объекта по уровню доступа и ID.
     * @return mixed
     * @throws IncorrectLvlException
     */
    public function getObjById(): mixed
    {
        $className = $this::getClassNameObjByLvl($this->lvlInt);

        return PropelQuery::from($className)->findPk($this->id);
    }

    /**
     * Поиск объекта по уровню доступа и ID, иначе - ошибка.
     * @return mixed
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function getObjByIdOrThrow(): mixed
    {
        return $this->getObjById() ?? throw new NoFindObjectException();
    }

    /**
     * Получить ID проекта, к которому относить объект, иначе - ошибка.
     * @return int ID проекта.
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public function getProjectIdObjOrThrow(): int
    {
        return self::getProjectIdByChildOrThrow($this->lvlInt, $this->id);
    }
    #endregion

    #region Static Select Objects
    public static function getObjectsByLvl(
        int $lvl,
        int $parentId,
        int $parentLvl,
        int $projectId,
        int $useId,
        int $limit = 10,
        int $limitFrom = 0,
        bool $isAccessManageUsers = false,
        bool $isAccessManageObjects = false,
        bool $isAccessObjectViewer = false,
    )
    {
        $isCrud = ProjectRole::isAccessCrudObj(
            lvl: $lvl,
            projectId: $projectId,
            userId: $useId,
            objId: $parentId
        );

        $objects = self::getObjectsQuery(
            objId: $parentId,
            lvl: $lvl,
            limit: $limit,
            limitFrom: $limitFrom,
            isAccessManageUsers: $isAccessManageUsers
        )->find()->getData();

        return $objects;

//        IsCrud: true
//        Objects: {
//                Id:
//                Name:
//                IsCrud:
//                IsAdmin:
//        }
    }

    public static function getObjectsQuery(int &$objId, int &$lvl, int &$limit, int &$limitFrom, bool &$isAccessManageUsers)
    {
        $colId = self::getColIdByLvl($lvl);
        $colStatus = self::getColStatusByLvl($lvl);
        $colIsPublic = self::getColIsPublicByLvl($lvl);
        $colCreatedBy = self::getColCreatedUserIdByLvl($lvl);

        $tableName = self::getClassNameObjByLvl($lvl);

        JsonOutput::success(
            self::getObjectsPriceQuery(
                colId: $colId,
                objId: $objId
            )
            ->toString()
                //->find()->getData()
        );

        $query = PropelQuery::from($tableName)
                ->select([
                    $colId,
                    $colStatus,
                    $colIsPublic,
                    $colCreatedBy
                ])
                ->addSelectQuery(
                    self::getObjectsPriceQuery(
                        colId: $colId,
                        objId: $objId
                    )
                );

        if (!$isAccessManageUsers) {
            $query->filterBy(
                column: 'Status',
                value: self::ATTRIBUTE_STATUS_DELETED,
                comparison: Criteria::ALT_NOT_EQUAL
            );
        }

        if ($limitFrom) {
            $query->filterBy(
                column: 'Id',
                value: $limitFrom,
                comparison: Criteria::GREATER_THAN
            );
        }

        $query->limit($limit);

        return $query;
    }

    public static function getObjectsPriceQuery(string $colId, int $objId)
    {
        return ObjProjectQuery::create()
            ->withColumn(ObjStageWorkTableMap::COL_PRICE, 'price_work')
            ->withColumn(ObjStageMaterialTableMap::COL_PRICE, 'price_material')
            ->withColumn(ObjStageTechnicTableMap::COL_PRICE, 'price_technic')
            ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                        ->leftJoinObjStage()
                    ->endUse()
                ->endUse()
            ->endUse();
    }
    #endregion

    #region Static Getter Functions
    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование propel класса для запроса.
     * @throws IncorrectLvlException
     */
    public static function getClassNameObjByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => \DB\ObjProject::class,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => \DB\ObjSubproject::class,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => \DB\ObjGroup::class,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => \DB\ObjHouse::class,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => \DB\ObjStage::class,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится идентификатор родителя.
     * @throws IncorrectLvlException
     */
    public static function getColIdByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => ObjProjectTableMap::COL_ID,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_ID,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => ObjGroupTableMap::COL_ID,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => ObjHouseTableMap::COL_ID,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => ObjStageTableMap::COL_ID,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится статус родителя.
     * @throws IncorrectLvlException
     */
    public static function getColStatusByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => ObjProjectTableMap::COL_STATUS,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_STATUS,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => ObjGroupTableMap::COL_STATUS,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => ObjHouseTableMap::COL_STATUS,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => ObjStageTableMap::COL_STATUS,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится наименование родителя.
     * @throws IncorrectLvlException
     */
    public static function getColNameByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => ObjProjectTableMap::COL_NAME,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_NAME,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => ObjGroupTableMap::COL_NAME,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => ObjHouseTableMap::COL_NAME,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => ObjStageTableMap::COL_NAME,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится доступ (публичный, приватный) родителя.
     * @throws IncorrectLvlException
     */
    public static function getColIsPublicByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => ObjProjectTableMap::COL_IS_PUBLIC,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_IS_PUBLIC,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => ObjGroupTableMap::COL_IS_PUBLIC,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => ObjHouseTableMap::COL_IS_PUBLIC,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => ObjStageTableMap::COL_IS_PUBLIC,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится ID пользователя родителя, который редактировал его в последний раз.
     * @throws IncorrectLvlException
     */
    public static function getColCreatedUserIdByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            eLvlObjStr::PROJECT->value,
            eLvlObjInt::PROJECT->value => ObjProjectTableMap::COL_VERSION_CREATED_BY,

            eLvlObjStr::SUBPROJECT->value,
            eLvlObjInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_VERSION_CREATED_BY,

            eLvlObjStr::GROUP->value,
            eLvlObjInt::GROUP->value => ObjGroupTableMap::COL_VERSION_CREATED_BY,

            eLvlObjStr::HOUSE->value,
            eLvlObjInt::HOUSE->value => ObjHouseTableMap::COL_VERSION_CREATED_BY,

            eLvlObjStr::STAGE->value,
            eLvlObjInt::STAGE->value => ObjStageTableMap::COL_VERSION_CREATED_BY,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * Получить ID проекта, к которому относить объект.
     * @param int|string $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @return int|null
     * @throws IncorrectLvlException
     */
    public static function getProjectIdByChild(int|string $lvl, int $objectId): ?int
    {
        $col = self::getColIdByLvl($lvl);

        return  ObjProjectQuery::create()
                ->useObjSubprojectQuery(joinType: Criteria::LEFT_JOIN)
                    ->useObjGroupQuery(joinType: Criteria::LEFT_JOIN)
                        ->useObjHouseQuery(joinType: Criteria::LEFT_JOIN)
                            ->leftJoinObjStage()
                        ->endUse()
                    ->endUse()
                ->endUse()
                ->where($col.'=?', $objectId)
                ->findOne()
                ->getId() ?? null;
    }

    /**
     * Получить ID проекта, к которому относить объект, иначе - ошибка.
     * @param int|string $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @return int
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getProjectIdByChildOrThrow(int|string $lvl, int $objectId): int
    {
        return self::getProjectIdByChild($lvl, $objectId) ?? throw new NoFindObjectException();
    }

    /**
     * Получить ID проекта, используя ID подпроекта.
     * @param int $subprojectId ID подпроекта.
     * @return int ID проекта.
     * @throws NoFindObjectException
     */
    public static function getProjectIdBySubprojectId(int $subprojectId): int
    {
        return ObjSubprojectQuery::create()->findPk($subprojectId)->getProjectId()
            ?? throw new NoFindObjectException();
    }

    /**
     * Получить ID подпроекта, используя ID группы.
     * @param int $groupId ID группы.
     * @return int ID подпроекта.
     * @throws NoFindObjectException
     */
    public static function getSubprojectIdByGroupId(int $groupId): int
    {
        return ObjGroupQuery::create()->findPk($groupId)->getSubprojectId()
            ?? throw new NoFindObjectException();
    }

    /**
     * Получить ID группы, используя ID дома.
     * @param int $houseId ID дома.
     * @return int ID группы.
     * @throws NoFindObjectException
     */
    public static function getGroupIdByHouseId(int $houseId): int
    {
        return ObjHouseQuery::create()->findPk($houseId)->getGroupId()
            ?? throw new NoFindObjectException();
    }

    /**
     * Получить ID дома, используя ID этапа.
     * @param int $stageId ID этапа.
     * @return int ID дома.
     * @throws NoFindObjectException
     */
    public static function getHouseIdByStageId(int $stageId): int
    {
        return ObjStageQuery::create()->findPk($stageId)->getHouseId()
            ?? throw new NoFindObjectException();
    }
    #endregion

    #region Static Getter Classes Functions
    /**
     * @param int|null $id ID объекта.
     * @param int|string|eLvlObjInt|eLvlObjStr|null $lvl Уровень доступа.
     * @param string|null $name Наименование.
     * @param string|null $status Статус.
     * @param bool|null $isPublic Состоит ли объект в публичном доступе.
     * @param bool|null $isAvailable Является ли объект достпуным, т.е. не удаленным.
     * @return Objects
     * @throws IncorrectStatusException
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     */
    public static function getObject(
        ?int $id = null,
        null|int|string|eLvlObjInt|eLvlObjStr $lvl = null,
        ?string $name = null,
        ?string $status = null,
        ?bool $isPublic = null,
        ?bool $isAvailable = null,
    ): Objects
    {
        if (is_object($lvl)) {
            $lvl = $lvl->value;
        }

        $obj = new self();
        $obj->setId($id)
            ->setAccessLvl($lvl)
            ->setName($name)
            ->setStatus($status)
            ->setIsPublic($isPublic)
            ->setIsAvailable($isAvailable);

        return $obj;
    }

    /**
     * @param int|null $id
     * @return Project
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getProject(?int $id = null): Project
    {
        return new Project($id);
    }

    /**
     * @param int|null $id
     * @return Subproject
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getSubproject(?int $id = null): Subproject
    {
        return new Subproject($id);
    }

    /**
     * @param int|null $id
     * @return Group
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getGroup(?int $id = null): Group
    {
        return new Group($id);
    }

    /**
     * @param int|null $id
     * @return House
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getHouse(?int $id = null): House
    {
        return new House($id);
    }

    /**
     * @param int|null $id
     * @return Stage
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getStage(?int $id = null): Stage
    {
        return new Stage($id);
    }
    #endregion

    #region Setter Default Values Functions
    /**
     * Присваивание свойству класса ID объекта.
     * @param int|null $id ID объекта.
     * @return Objects
     */
    public function setId(?int $id): Objects
    {
        if ($this->id !== $id) {
            $this->id = $id;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса наименование объекта.
     * @param string|null $name Наименование объекта.
     * @return Objects
     */
    public function setName(?string $name): Objects
    {
        if ($name !== null && $this->name !== $name) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса статус разработки объекта.
     * @param string|null $status Наименование статуса разработки (self::ATTRIBUTE_STATUS_).
     * @return Objects
     * @throws IncorrectStatusException
     */
    public function setStatus(?string $status): Objects
    {
        if ($status !== null && $this->status !== $status) {
            if ($status === $this::ATTRIBUTE_STATUS_IN_PROCESS ||
                $status === $this::ATTRIBUTE_STATUS_COMPLETED ||
                $status === $this::ATTRIBUTE_STATUS_DELETED) $this->status = $status;
            else throw new IncorrectStatusException();
        }

        return $this;
    }

    /**
     * Присваивание свойству класса доступа (пуличный, приватный) к объекту.
     * @param bool|null $isPublic Доступ к объекту (пуличный, приватный).
     * @return Objects
     */
    public function setIsPublic(?bool $isPublic = true): Objects
    {
        if ($isPublic !== null && $this->isPublic !== $isPublic) {
            $this->isPublic = $isPublic;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса доступа (доступен, удален) к объекту.
     * @param bool|null $isAvailable Доступ к объекту (доступен, удален).
     * @return Objects
     */
    public function setIsAvailable(?bool $isAvailable = true): Objects
    {
        if ($isAvailable !== null && $this->isAvailable !== $isAvailable) {
            $this->isAvailable = $isAvailable;
        }

        return $this;
    }

    /**
     * @param int|string|null $lvl Номер или наименование уровня доступа.
     * @return Objects
     * @throws InvalidAccessLvlIntException
     * @throws InvalidAccessLvlStrException
     */
    protected function setAccessLvl(null|int|string $lvl): Objects
    {
        if ($lvl !== null) {
            if (is_int($lvl) &&
                $this->lvlInt !== $lvl &&
                AccessLvl::isAccessLvlIntObj($lvl)) {
                    $this->lvlInt = $lvl;
                    $this->lvlStr = AccessLvl::getAccessLvlStrObjByInt($lvl);
            } elseif (  is_string($lvl) &&
                        $this->lvlStr !== $lvl &&
                        AccessLvl::isAccessLvlStrObj($lvl)) {
                $this->lvlStr = $lvl;
                $this->lvlInt = AccessLvl::getAccessLvlIntObjByStr($lvl);
            }
        }

        return $this;
    }
    #endregion

    #region Setter Functions
    /**
     * Заполнение свойств объекта, в соответсвие с актуальными знаениями класса.
     * @return void
     */
    public function setUpdateObjByCurrentValues(): void
    {
        if ($this->name) $this->object->setName($this->name);
        if ($this->status) $this->object->setStatus($this->status);
        if ($this->isPublic !== null) $this->object->setIsPublic($this->isPublic);
        if ($this->isAvailable !== null) $this->object->setIsAvailable($this->isAvailable);
    }

    /**
     * @param string|null $id ID объекта.
     * @param string|null $name Наименование объекта.
     * @param string|null $status Статус разработки объекта (в процессе, завершен, удален).
     * @param bool|null $isPublic Доступ (открытый/публичный).
     * @param bool|null $isAvailable Доступ (доступен/удален).
     * @return Objects
     * @throws IncorrectStatusException
     */
    public function setObjDefaultValues(
        ?string $id = null,
        ?string $name = null,
        ?string $status = self::ATTRIBUTE_STATUS_IN_PROCESS,
        ?bool $isPublic = true,
        ?bool $isAvailable = true
    ): Objects
    {
        if ($id !== null) $this->setId($id);
        if ($name !== null) $this->setName($name);
        if ($status !== null) $this->setStatus($status);
        if ($isPublic !== null) $this->setIsPublic($isPublic);
        if ($isAvailable !== null) $this->setIsAvailable($isAvailable);

        return $this;
    }
    #endregion
}