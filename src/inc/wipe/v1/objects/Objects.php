<?php
namespace wipe\inc\v1\objects;

use DB\Map\GroupsTableMap;
use DB\Map\HouseTableMap;
use DB\Map\ProjectTableMap;
use DB\Map\StageTableMap;
use DB\Map\SubprojectTableMap;
use DB\ProjectQuery;
use DB\Base\HouseQuery;
use DB\Base\StageQuery;
use DB\Base\GroupsQuery;
use DB\Base\SubprojectQuery;
use DB\Base\Stage as BaseStage;
use DB\Base\House as BaseHouse;
use DB\Base\Groups as BaseGroup;
use DB\Base\Project as BaseProject;
use DB\Base\Subproject as BaseSubproject;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use wipe\inc\v1\objects\exception\AccessDeniedException;
use wipe\inc\v1\objects\exception\IncorrectStatusException;
use wipe\inc\v1\objects\exception\NoFindObjectException;
use wipe\inc\v1\role\project_role\exception\IncorrectLvlException;
use wipe\inc\v1\role\project_role\exception\NoProjectFoundException;
use wipe\inc\v1\role\project_role\ProjectRole;

class Objects
{
    public const ATTRIBUTE_STATUS_IN_PROCESS = 'in_process';
    public const ATTRIBUTE_STATUS_COMPLETED = 'completed';
    public const ATTRIBUTE_STATUS_DELETED = 'deleted';

    public const ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS = true;
    public const ATTRIBUTE_IS_AVAILABLE_PRIVATE_ACCESS = false;

    /** @var int|null ID объекта. */
    protected ?int $id = null;

    /** @var string|null Наименование объекта. */
    protected ?string $name = null;

    /** @var string|null Статус разработки объекта (в процессе, завершен, удален). */
    protected ?string $status = null;

    /** @var bool|null Доступ к объекту (пуличный, приватный). */
    protected ?bool $isAvailable = null;

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * @return void
     */
    protected function applyByDefaultValues(): void
    {
        $this->status = $this::ATTRIBUTE_STATUS_IN_PROCESS;
        $this->isAvailable = $this::ATTRIBUTE_IS_AVAILABLE_OPEN_ACCESS;
    }

    /**
     * Заполнение свойств класса, используя объект.
     * @param BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage $obj
     * @return void
     */
    protected function applyDefaultValuesByObj(BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage &$obj): void
    {
        $this->name = $obj->getName();
        $this->status = $obj->getStatus();
        $this->isAvailable = $obj->getIsAvailable();
    }
    #endregion

    #region Access Control Functions
    /** @return bool|null Доступ к объекту (пуличный, приватный). */
    public function isAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    /**
     * Данный объект является публичным, иначе - ошибка.
     * @throws AccessDeniedException
     */
    public function isAvailableOrThrow(): bool
    {
        return $this->isAvailable ?: throw new AccessDeniedException();
    }

    /**
     * Данный объект доступен для редактирования, т.е. статус разработки равен "В процессе", иначе - ошибка.
     * @throws AccessDeniedException
     */
    public function isAccessEditOrThrow(): bool
    {
        return $this->status === $this::ATTRIBUTE_STATUS_IN_PROCESS ?: throw new AccessDeniedException();
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

    /**
     * Фильтрация удаленных объектов.
     * @param ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery $obj Запрос.
     * @param string $colName Наименование колонки с статусом разработки объекта (TableMap).
     * @return ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery
     */
    public function getFilterNoDeletedStatusQuery(
        ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery $obj,
        string $colName
    ): ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery
    {
        return $obj->where($colName . '!=?', $this::ATTRIBUTE_STATUS_DELETED);
    }

    /**
     * Получить объект по ID, иначе - ошибка.
     * @param ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery $obj Запрос.
     * @param string $colName Наименование колонки с статусом разработки объекта (TableMap).
     * @return BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage
     * @throws NoProjectFoundException
     */
    public function getSearchByIdOrThrow(
        ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery $obj,
        string $colName
    ): BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage
    {
        $this->getFilterNoDeletedStatusQuery($obj, $colName);

        return $obj->findPk($this->id) ?? throw new NoProjectFoundException();
    }
    #endregion

    #region Static Getter Functions
    /**
     * @param int|null $id ID проекта.
     * @return Project
     * @throws NoFindObjectException
     */
    public static function getProject(?int $id = null): Project
    {
        return new Project(projectId: $id);
    }

    /**
     * @param int $objectId ID объекта.
     * @param int|string $lvl Уровень доступа.
     * @return int|string ID проекта, которому принадлежит объект.
     * @throws IncorrectLvlException
     * @throws PropelException
     */
    public static function getProjectIdByLvlAndId(int $objectId, int|string $lvl): int|string|array
    {
        $col = self::getColIdByLvl($lvl);

        return [
            'TYPE_CAMELNAME' => ProjectTableMap::getFieldNames(TableMap::TYPE_CAMELNAME),
            'TYPE_COLNAME' => ProjectTableMap::getFieldNames(TableMap::TYPE_COLNAME),
            'TYPE_PHPNAME' => ProjectTableMap::getFieldNames(TableMap::TYPE_PHPNAME),
            'TYPE_FIELDNAME' => ProjectTableMap::getFieldNames(TableMap::TYPE_FIELDNAME),
        ];

//        return  ProjectQuery::create()
//                ->addJoin(ProjectTableMap::COL_ID.ProjectTableMap::getFieldNames(), SubprojectTableMap::COL_PROJECT_ID)
//                ->addJoin(SubprojectTableMap::COL_ID, GroupsTableMap::COL_SUBPROJECT_ID)
//                ->addJoin(GroupsTableMap::COL_ID, HouseTableMap::COL_GROUP_ID)
//                ->addJoin(HouseTableMap::COL_ID, StageTableMap::COL_HOUSE_ID)
//                ->where($col.'=?', $objectId)
//                ->findOne()
//                ->getId();
//                ->toString();
    }

    /**
     * @param int|string $lvl Уровень доступа.
     * @return string Наименование атрибута, в котором хранится идентификатор родителя.
     * @throws IncorrectLvlException
     */
    public static function getColIdByLvl(int|string $lvl): string
    {
        return match ($lvl) {
            ProjectRole::ATTRIBUTE_LVL_STR_PROJECT,
            ProjectRole::ATTRIBUTE_LVL_INT_PROJECT => ProjectTableMap::COL_ID,

            ProjectRole::ATTRIBUTE_LVL_STR_SUBPROJECT,
            ProjectRole::ATTRIBUTE_LVL_INT_SUBPROJECT => SubprojectTableMap::COL_ID,

            ProjectRole::ATTRIBUTE_LVL_STR_GROUP,
            ProjectRole::ATTRIBUTE_LVL_INT_GROUP => GroupsTableMap::COL_ID,

            ProjectRole::ATTRIBUTE_LVL_STR_HOUSE,
            ProjectRole::ATTRIBUTE_LVL_INT_HOUSE => HouseTableMap::COL_ID,

            ProjectRole::ATTRIBUTE_LVL_STR_STAGE,
            ProjectRole::ATTRIBUTE_LVL_INT_STAGE => StageTableMap::COL_ID,

            default => throw new IncorrectLvlException()
        };
    }

    /**
     * Получить ID проекта, используя ID подпроекта.
     * @param int $subprojectId ID подпроекта.
     * @return int ID проекта.
     * @throws NoFindObjectException
     */
    public static function getProjectIdBySubprojectId(int $subprojectId): int
    {
        $i = SubprojectQuery::create()->findPk($subprojectId)
            ?? throw new NoFindObjectException();

        return $i->getProjectId();
    }

    /**
     * Получить ID подпроекта, используя ID группы.
     * @param int $groupId ID группы.
     * @return int ID подпроекта.
     * @throws NoFindObjectException
     */
    public static function getSubprojectIdByGroupId(int $groupId): int
    {
        $i = GroupsQuery::create()->findPk($groupId)
            ?? throw new NoFindObjectException();

        return $i->getSubprojectId();
    }

    /**
     * Получить ID группы, используя ID дома.
     * @param int $houseId ID дома.
     * @return int ID группы.
     * @throws NoFindObjectException
     */
    public static function getGroupIdByHouseId(int $houseId): int
    {
        $i = HouseQuery::create()->findPk($houseId)
            ?? throw new NoFindObjectException();

        return $i->getGroupId();
    }

    /**
     * Получить ID дома, используя ID этапа.
     * @param int $stageId ID этапа.
     * @return int ID дома.
     * @throws NoFindObjectException
     */
    public static function getHouseIdByStageId(int $stageId): int
    {
        $i = StageQuery::create()->findPk($stageId)
            ?? throw new NoFindObjectException();

        return $i->getHouseId();
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
     * Присваивание свойству класса доступа к объекту.
     * @param bool|null $isAvailable Доступ к объекту (пуличный, приватный).
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
     * Заполнение свойств класса.
     * @param BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage $obj Объект.
     * @return void
     */
    protected function setUpdateByDefaultValues(BaseProject|BaseSubproject|BaseGroup|BaseHouse|BaseStage &$obj): void
    {
        if ($this->name) $obj->setName($this->name);
        if ($this->status) $obj->setStatus($this->status);
        if ($this->isAvailable) $obj->setIsAvailable($this->isAvailable);
    }

    /**
     * Заполнение фильтрации запроса.
     * @param ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery $obj Объект запроса.
     * @return void
     */
    protected function setFilterByDefaultValues(ProjectQuery|SubprojectQuery|GroupsQuery|HouseQuery|StageQuery &$obj): void
    {
        if ($this->id) $obj->filterById($this->id);
        if ($this->name) $obj->filterByName($this->name);
        if ($this->status) $obj->filterByStatus($this->status);
        if ($this->isAvailable) $obj->filterByIsAvailable($this->isAvailable);
    }
    #endregion
}