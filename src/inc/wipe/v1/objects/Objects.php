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
use DB\Map\ObjStageTableMap;
use DB\Map\ObjSubprojectTableMap;
use ext\ObjGroup;
use ext\ObjHouse;
use ext\ObjProject;
use ext\ObjStage;
use ext\ObjSubproject;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\PropelQuery;
use wipe\inc\v1\objects\children\Group;
use wipe\inc\v1\objects\children\House;
use wipe\inc\v1\objects\children\Project;
use wipe\inc\v1\objects\children\Stage;
use wipe\inc\v1\objects\children\Subproject;
use wipe\inc\v1\role\project_role\enum\eLvlStr;
use wipe\inc\v1\role\project_role\enum\eLvlInt;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\ObjectIsNotEditableException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;

class Objects
{
    public const ATTRIBUTE_STATUS_IN_PROCESS = 'in_process';
    public const ATTRIBUTE_STATUS_COMPLETED = 'completed';
    public const ATTRIBUTE_STATUS_DELETED = 'deleted';

    public const ATTRIBUTE_IS_PUBLIC_OPEN_ACCESS = true;
    public const ATTRIBUTE_IS_PUBLIC_PRIVATE_ACCESS = false;

    public const ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS = true;
    public const ATTRIBUTE_IS_AVAILABLE_DELETED_ACCESS = false;

    /** @var int|null Уровень доступа. */
    protected ?int $lvl = null;

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

    /** @var ObjGroup|ObjHouse|ObjProject|ObjStage|ObjSubproject|null Объект класса (подкласса). */
    protected null|ObjProject|ObjSubproject|ObjGroup|ObjHouse|ObjStage $object = null;

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * @return void
     */
    protected function applyByDefaultValues(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->isPublic = $this::ATTRIBUTE_IS_PUBLIC_OPEN_ACCESS;
        $this->isAvailable = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    /**
     * Заполнение свойств класса, используя объект.
     * @return void
     */
    protected function applyDefaultValuesByObj(): void
    {
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
     * @throws AccessDeniedException
     */
    public function isAvailableOrThrow(): bool
    {
        return $this->isAvailable ?: throw new AccessDeniedException();
    }

    /** @return bool|null Доступ к объекту (доступен, удален). */
    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * Данный объект является публичным, иначе - ошибка.
     * @throws AccessDeniedException
     */
    public function isPublicOrThrow()
    {
        return $this->isPublic
            ?: throw new AccessDeniedException();
    }

    /**
     * Данный объект доступен для редактирования, т.е. статус разработки равен "В процессе", иначе - ошибка.
     * @throws AccessDeniedException
     */
    public function isAccessEditOrThrow(): bool
    {
        return $this->status === $this::ATTRIBUTE_STATUS_IN_PROCESS
            ?: throw new AccessDeniedException();
    }
    #endregion

    #region Static Access Control Functions
    /**
     * @param int|string $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return bool Сущетсвует ли данный объект.
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function isExistingOrThrow(int|string $lvl, int $objId): bool
    {
        $className = self::getColStatusByLvl($lvl);

        return PropelQuery::from($className)->findPk($objId) !== null
            ?: throw new NoFindObjectException();
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @param int $objId ID объекта.
     * @return bool Доступно ли редактирование объекта.
     * @throws IncorrectLvlException
     * @throws ObjectIsNotEditableException
     */
    public static function isAvailableForEditionOrThrow(int|string $lvl, int $objId): bool
    {
        $colStatus = self::getColStatusByLvl($lvl);
        $className = self::getClassNameObjByLvl($lvl);

        return  PropelQuery::from($className)
                ->where($colStatus . '=?', self::ATTRIBUTE_STATUS_IN_PROCESS)
                ->findPk($objId) !== null ?:
                throw new ObjectIsNotEditableException();
    }
    #endregion

    #region Getter Default Values Functions
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
    #endregion

    #region Getter Function
    /**
     * Поиск объекта по уровню доступа и ID, иначе - ошибка.
     * @return mixed
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     */
    public function getObjByLvlAndIdOrThrow(): mixed
    {
        $className = $this::getClassNameObjByLvl($this->lvl);

        return  PropelQuery::from($className)
                ->findPk($this->id) ?? throw new NoProjectFoundException();
    }

    /**
     * Поиск не удаленного объекта по уровню доступа и ID, иначе - ошибка.
     * @return mixed
     * @throws IncorrectLvlException
     * @throws NoProjectFoundException
     */
    public function getObjByLvlAndIdNoDeletedOrThrow(): mixed
    {
        $colStatus = $this::getColStatusByLvl($this->lvl);
        $className = $this::getClassNameObjByLvl($this->lvl);

        return  PropelQuery::from($className)
            ->filterBy($colStatus, self::ATTRIBUTE_STATUS_DELETED, Criteria::ALT_NOT_EQUAL)
            ->findPk($this->id) ?? throw new NoProjectFoundException();
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
            eLvlStr::PROJECT->value,
            eLvlInt::PROJECT->value => \DB\ObjProject::class,

            eLvlStr::SUBPROJECT->value,
            eLvlInt::SUBPROJECT->value => \DB\ObjSubproject::class,

            eLvlStr::GROUP->value,
            eLvlInt::GROUP->value => \DB\ObjGroup::class,

            eLvlStr::HOUSE->value,
            eLvlInt::HOUSE->value => \DB\ObjHouse::class,

            eLvlStr::STAGE->value,
            eLvlInt::STAGE->value => \DB\ObjStage::class,

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
            eLvlStr::PROJECT->value,
            eLvlInt::PROJECT->value => ObjProjectTableMap::COL_ID,

            eLvlStr::SUBPROJECT->value,
            eLvlInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_ID,

            eLvlStr::GROUP->value,
            eLvlInt::GROUP->value => ObjGroupTableMap::COL_ID,

            eLvlStr::HOUSE->value,
            eLvlInt::HOUSE->value => ObjHouseTableMap::COL_ID,

            eLvlStr::STAGE->value,
            eLvlInt::STAGE->value => ObjStageTableMap::COL_ID,

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
            eLvlStr::PROJECT->value,
            eLvlInt::PROJECT->value => ObjProjectTableMap::COL_STATUS,

            eLvlStr::SUBPROJECT->value,
            eLvlInt::SUBPROJECT->value => ObjSubprojectTableMap::COL_STATUS,

            eLvlStr::GROUP->value,
            eLvlInt::GROUP->value => ObjGroupTableMap::COL_STATUS,

            eLvlStr::HOUSE->value,
            eLvlInt::HOUSE->value => ObjHouseTableMap::COL_STATUS,

            eLvlStr::STAGE->value,
            eLvlInt::STAGE->value => ObjStageTableMap::COL_STATUS,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @param int $objectId ID объекта.
     * @return int
     * @throws IncorrectLvlException
     * @throws NoFindObjectException
     */
    public static function getProjectIdByChildOrThrow(int|string $lvl, int $objectId): int
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
                ->getId() ?: throw new NoFindObjectException();
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

    #region Static Getter Children Classes Functions
    /**
     * @param int|null $id ID проекта.
     * @return Project
     */
    public static function getProject(?int $id = null): Project
    {
        return new Project();
    }

    /**
     * @param int|null $id ID подпроекта.
     * @return Subproject
     */
    public static function getSubproject(?int $id = null): Subproject
    {
        return new Subproject();
    }

    /**
     * @param int|null $id ID группы.
     * @return Group
     */
    public static function getGroup(?int $id = null): Group
    {
        return new Group();
    }

    /**
     * @param int|null $id ID дома.
     * @return House
     */
    public static function getHouse(?int $id = null): House
    {
        return new House();
    }

    /**
     * @param int|null $id ID этапа.
     * @return Stage
     */
    public static function getStage(?int $id = null): Stage
    {
        return new Stage();
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
     * @param string $name
     * @param string $status
     * @param bool $isPublic
     * @param bool $isAvailable
     * @return void
     * @throws IncorrectStatusException
     */
    public function setObjDefaultValues(string $name, string $status, bool $isPublic, bool $isAvailable): void
    {
        $this->setName($name)
             ->setStatus($status)
             ->setIsPublic($isPublic)
             ->setIsAvailable($isAvailable);
    }
    #endregion
}