<?php
namespace wipe\inc\v1\role\user_role;

use DB\Base\Users;
use DB\Base\UsersQuery;
use DB\UserRoleQuery;
use ext\DB;
use ext\ProjectRole as ExtProjectRole;
use ext\UserRole as ExtUserRole;
use DB\Base\UserRole as BaseUserRole;
use inc\artemy\v1\auth\Auth;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageHistoryException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageObjectsException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageVolumesException;
use wipe\inc\v1\role\user_role\exception\NoAccessObjectViewException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class UserRole
{
    /** @var int|null ID пользователя. */
    private ?int $userId = null;

    /** @var Users|null Объект пользователя. */
    private ?Users $userObj = null;

    /** @var int|null ID роли. */
    private ?int $userRoleId = null;

    /** @var ExtUserRole|BaseUserRole|null Объект роли. */
    private null|ExtUserRole|BaseUserRole $userRoleObj = null;

    /** @var string|null Наименование роли. */
    private ?string $roleName = null;

    /** @var bool Разрешен ли просмотр объектов. */
    private ?bool $accessObjectViewer = null;

    /** @var bool Разрешен ли CRUD объектов. */
    private ?bool $accessManageObjects = null;

    /** @var bool Разрешен ли CRUD объемов. */
    private ?bool $accessManageVolumes = null;

    /** @var bool Разрешено ли управление историей. */
    private ?bool $accessManageHistory = null;

    /** @var bool Разрешен ли CRUD учетными записями. */
    private ?bool $accessManageUsers = null;

    function __construct()
    {
        $this->applyDefault();
    }

    #region Apply Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * @return void
     */
    public function applyDefault(): void
    {
        $this->accessObjectViewer = false;
        $this->accessManageObjects = false;
        $this->accessManageVolumes = false;
        $this->accessManageHistory = false;
        $this->accessManageUsers = false;
    }

    /**
     * Заполнение свойств класса по ID авторизованного пользователя.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public function applyByUserAuth(): UserRole
    {
        $this->userId = Auth::getUser()->id();
        $this->applyByUserId();

        return $this;
    }

    /**
     * Заполнение свойств класса, используя ID пользователя.
     * @return void
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public function applyByUserId(): void
    {
        $this->userObj = UsersQuery::create()->filterByIsAvailable(1)->findPk($this->userId) ??
                        throw new NoUserFoundException();
        $this->applyByUserObj();
    }

    /**
     * Заполнение свойств класса, используя объект пользователя.
     * @return void
     * @throws NoRoleFoundException
     */
    public function applyByUserObj(): void
    {
        $this->userRoleId = $this->userObj->getRoleId();
        $this->applyByUserRoleId();
    }

    /**
     * Заполнение свойств класса, используя ID роли.
     * @return void
     * @throws NoRoleFoundException
     */
    public function applyByUserRoleId(): void
    {
        $this->setRoleObjById();
        $this->applyByUserRoleObj();
    }

    /**
     * Заполнение свойств класса, используя объект роли.
     * @return void
     */
    public function applyByUserRoleObj(): void
    {
        if ($this->userRoleId === null ||
            $this->userRoleId !== $this->userRoleObj->getId()
        ) {
            $this->userRoleId = $this->userRoleObj->getId();
        }

        $this->roleName = $this->userRoleObj->getName();
        $this->accessObjectViewer = $this->userRoleObj->getObjectViewer();
        $this->accessManageObjects = $this->userRoleObj->getManageObjects();
        $this->accessManageVolumes = $this->userRoleObj->getManageVolumes();
        $this->accessManageHistory = $this->userRoleObj->getManageHistory();
        $this->accessManageUsers = $this->userRoleObj->getManageUsers();
    }
    #endregion

    #region Access Control Functions
    /** @return bool Разрешен ли просмотр объектов. */
    public function isAccessObjectViewer(): bool
    {
        return $this->accessObjectViewer;
    }

    /**
     * Разрешен просмотр объектов, иначе - ошибка.
     * @return UserRole
     * @throws NoAccessObjectViewException
     */
    public function isAccessObjectViewerOrThrow(): UserRole
    {
        return $this->isAccessObjectViewer() ? $this : throw new NoAccessObjectViewException();
    }

    /** @return bool Разрешен ли CRUD объектов. */
    public function isAccessManageObjects(): bool
    {
        return $this->accessManageObjects;
    }

    /**
     * Разрешен CRUD объектов, иначе - ошибка.
     * @return UserRole
     * @throws NoAccessManageObjectsException
     */
    public function isAccessManageObjectsOrThrow(): UserRole
    {
        return $this->isAccessManageObjects() ? $this : throw new NoAccessManageObjectsException();
    }

    /** @return bool Разрешен ли CRUD объемов. */
    public function isAccessManageVolumes(): bool
    {
        return $this->accessManageVolumes;
    }

    /**
     * Разрешен CRUD объемов, иначе - ошибка.
     * @return UserRole
     * @throws NoAccessManageVolumesException
     */
    public function isAccessManageVolumesOrThrow(): UserRole
    {
        return $this->isAccessManageVolumes() ? $this : throw new NoAccessManageVolumesException();
    }

    /** @return bool Разрешено ли управление историей. */
    public function isAccessManageHistory(): bool
    {
        return $this->accessManageHistory;
    }

    /**
     * Разрешено управление историей, иначе - ошибка.
     * @return UserRole
     * @throws NoAccessManageHistoryException
     */
    public function isAccessManageHistoryOrThrow(): UserRole
    {
        return $this->isAccessManageHistory() ? $this : throw new NoAccessManageHistoryException();
    }

    /** @return bool Разрешен ли CRUD учетными записями. */
    public function isAccessManageUsers(): bool
    {
        return $this->accessManageUsers;
    }

    /**
     * Разрешен CRUD учетными записями, иначе - ошибка.
     * @return UserRole
     * @throws NoAccessManageUsersException
     */
    public function isAccessManageUsersOrThrow(): UserRole
    {
        return $this->isAccessManageUsers() ? $this : throw new NoAccessManageUsersException();
    }
    #endregion

    #region Getter Functions
    /** @return int|null ID пользователя. */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /** @return Users|null Объект пользователя. */
    public function getUserObj(): ?Users
    {
        return $this->userObj;
    }

    /** @return int|null ID роли. */
    public function getRoleId(): ?int
    {
        return $this->userRoleId;
    }

    /** @return string|null Наименование роли. */
    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    /** @return ExtUserRole|null Объект роли. */
    public function getRoleObj(): ?ExtUserRole
    {
        return $this->userRoleObj;
    }
    #endregion

    #region Static Getter Functions
    /**
     * Получить объект класса через статический метод, используя ID пользователя.
     * @param int|null $id ID пользователя.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function getByUserId(?int $id = null): UserRole
    {
        $i = new UserRole();

        if ($id !== null) {
            $i->setUserIdAndApply($id);
        }

        return $i;
    }

    /**
     * Получить объект класса через статический метод, используя ID роли.
     * @param int|null $id ID роли.
     * @return UserRole
     * @throws NoRoleFoundException
     */
    public static function getByRoleId(?int $id = null): UserRole
    {
        $i = new UserRole();

        if ($id !== null) {
            $i->setRoleIdAndApply($id);
        }

        return $i;
    }
    #endregion

    #region Setter Functions
    /**
     * Присваивание свойству класса ID пользователя.
     * @param int|null $id ID пользователя.
     * @return UserRole
     */
    public function setUserId(?int $id = null): UserRole
    {
        if ($id !== null && $this->userId !== $id) {
            $this->userId = $id;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса ID пользователя.
     * @param int $id ID пользователя.
     * @return $this
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public function setUserIdAndApply(int $id): UserRole
    {
        $this->setUserId($id)->applyByUserId();

        return $this;
    }

    /**
     * Присваивание свойству класса объект пользователя.
     * @param Users|null $obj Объект пользователя.
     * @return UserRole
     */
    public function setUserObj(?Users $obj = null): UserRole
    {
        if ($obj !== null &&
            ($this->userObj === null || $this->userObj->getId() !== $obj->getId())
        ) {
            $this->userObj = $obj;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса объект пользователя.
     * @param Users $obj Объект пользователя.
     * @return UserRole
     * @throws NoRoleFoundException
     */
    public function setUserObjAndApply(Users $obj): UserRole
    {
        $this->setUserObj($obj)->applyByUserObj();

        return $this;
    }

    /**
     * Присваивание свойству класса ID роли.
     * @param int|null $id ID роли.
     * @return $this
     */
    public function setRoleId(?int $id = null): UserRole
    {
        if ($id !== null && $this->userRoleId !== $id) {
            $this->userRoleId = $id;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса ID роли.
     * @param int $id ID роли.
     * @return UserRole
     * @throws NoRoleFoundException
     */
    public function setRoleIdAndApply(int $id): UserRole
    {
        $this->setRoleId($id)->applyByUserRoleId();

        return $this;
    }

    /**
     * Присваивание свойству класса объект роли.
     * @param ExtUserRole|BaseUserRole|null $obj Объект роли.
     * @return UserRole
     */
    public function setRoleObj(null|ExtUserRole|BaseUserRole $obj = null): UserRole
    {
        if ($obj !== null &&
            ($this->userRoleObj === null || $this->userRoleObj->getId() !== $obj->getId())
        ) {
            if (get_class($obj) !== ExtProjectRole::class) {
                $obj = DB::getExtUserRole($obj);
            }

            $this->userRoleObj = $obj;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса объект роли по ID.
     * @param int|null $id ID роли. При значении NULL используется свойства класса $userRoleId.
     * @return UserRole
     * @throws NoRoleFoundException
     */
    public function setRoleObjById(?int $id = null): UserRole
    {
        if ($id === null) $id = $this->userRoleId;

        $this->userRoleObj = UserRoleQuery::create()->findPk($id) ??
                            throw new NoRoleFoundException();
        $this->userRoleObj = DB::getExtUserRole($this->userRoleObj);

        return $this;
    }

    /**
     * Присваивание свойству класса объект роли.
     * @param ExtUserRole|BaseUserRole $obj Объект роли.
     * @return $this
     */
    public function setRoleObjAndApply(ExtUserRole|BaseUserRole $obj): UserRole
    {
        $this->setRoleObj($obj)->applyByUserRoleObj();

        return $this;
    }

    /**
     * Присваивание свойству класса наименование роли.
     * @param string|null $name Наименование роли.
     * @return UserRole
     */
    public function setRoleName(?string $name): UserRole
    {
        if ($name !== null && $this->roleName !== $name) {
            $this->roleName = $name;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на просмотр объектов.
     * @param bool|null $flag Разрешен ли просмотр объектов.
     * @return UserRole
     */
    public function setAccessObjectViewer(?bool $flag): UserRole
    {
        if ($flag !== null && $this->accessObjectViewer !== $flag) {
            $this->accessObjectViewer = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD объектов.
     * @param bool|null $flag Разрешен ли CRUD объектов.
     * @return UserRole
     */
    public function setAccessManageObjects(?bool $flag): UserRole
    {
        if ($flag !== null && $this->accessManageObjects !== $flag) {
            $this->accessManageObjects = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD объевом.
     * @param bool|null $flag Разрешен ли CRUD объевом.
     * @return UserRole
     */
    public function setAccessManageVolumes(?bool $flag): UserRole
    {
        if ($flag !== null && $this->accessManageVolumes !== $flag) {
            $this->accessManageVolumes = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на управление историей.
     * @param bool|null $flag Разрешено ли управление историей.
     * @return UserRole
     */
    public function setAccessManageHistory(?bool $flag): UserRole
    {
        if ($flag !== null && $this->accessManageHistory !== $flag) {
            $this->accessManageHistory = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD учетными записями.
     * @param bool|null $flag Разрешен ли CRUD учетными записями.
     * @return UserRole
     */
    public function setAccessManageUsers(?bool $flag): UserRole
    {
        if ($flag !== null && $this->accessManageUsers !== $flag) {
            $this->accessManageUsers = $flag;
        }

        return $this;
    }
    #endregion

    #region CRUD Functions
    /**
     * Обновление роли у пользователя.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     * @throws PropelException
     */
    public function updateUserRoleId(): UserRole
    {
        $this->userObj = UsersQuery::create()->findPk($this->userId) ??
                        throw new NoUserFoundException();
        $this->updateUserRoleIdByObj();

        return $this;
    }

    /**
     * Обновление роли у пользователя.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     * @throws PropelException
     */
    public function updateUserRoleIdByObj(): UserRole
    {
        if ($this->userObj === null) throw new NoUserFoundException();
        if ($this->userRoleId === null) throw new NoRoleFoundException();

        if ($this->userObj->getRoleId() !== $this->userRoleId) {
            $this->userObj->setRoleId($this->userRoleId)->save();
        }

        return $this;
    }

    /**
     * Добавление новой роли.
     * @return UserRole
     * @throws PropelException
     */
    public function add(): UserRole
    {
        $this->userRoleObj = new ExtUserRole();
        $this->userRoleObj
            ->setName($this->roleName)
            ->setObjectViewer($this->accessObjectViewer)
            ->setManageObjects($this->accessManageObjects)
            ->setManageVolumes($this->accessManageVolumes)
            ->setManageHistory($this->accessManageHistory)
            ->setManageUsers($this->accessManageUsers)
            ->save();

        $this->applyByUserRoleObj();

        return $this;
    }

    /**
     * Обновление роли, используя ID.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws PropelException
     */
    public function update(): UserRole
    {
        $this->userRoleObj = UserRoleQuery::create()->findPk($this->userRoleId) ??
                            throw new NoRoleFoundException();
        $this->userRoleObj = DB::getExtUserRole($this->userRoleObj);
        $this->updateByObj();

        return $this;
    }

    /**
     * Обновление роли, используя объект.
     * @return UserRole
     * @throws PropelException
     */
    public function updateByObj(): UserRole
    {
        if ($this->roleName !== null) $this->userRoleObj->setName($this->roleName);
        if ($this->accessObjectViewer !== null) $this->userRoleObj->setObjectViewer($this->accessObjectViewer);
        if ($this->accessManageObjects !== null) $this->userRoleObj->setManageObjects($this->accessManageObjects);
        if ($this->accessManageVolumes !== null) $this->userRoleObj->setManageVolumes($this->accessManageVolumes);
        if ($this->accessManageHistory !== null) $this->userRoleObj->setManageHistory($this->accessManageHistory);
        if ($this->accessManageUsers !== null) $this->userRoleObj->setManageUsers($this->accessManageUsers);

        $this->userRoleObj->save();

        return $this;
    }

    /**
     * Удаление роли по ID.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws PropelException
     */
    public function delete(): UserRole
    {
        $this->setRoleObjById();
        $this->deleteByObj();

        return $this;
    }

    /**
     * Удаление роли по объекта.
     * @return UserRole
     * @throws PropelException
     */
    public function deleteByObj(): UserRole
    {
        $this->userRoleObj->delete();

        return $this;
    }
    #endregion
}