<?php
namespace wipe\inc\v1\role\user_role;

use DB\Base\UserRoleQuery;
use DB\Base\UsersQuery;
use ext\DB;
use inc\artemy\v1\auth\Auth;
use Exception;
use ext\UserRole as ExtUserRole;
use DB\Base\UserRole as BaseUserRole;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageHistoryException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageObjectsException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageVolumes;
use wipe\inc\v1\role\user_role\exception\NoAccessObjectViewException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoRoleObjectException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class UserRole
{
    private static ?UserRole $staticConstruct = null;

    /** @var int|null ID пользователя. */
    private static ?int $userId = null;

    /** @var int|null ID роли. */
    private static ?int $roleId = null;

    /** @var string|null Наименование роли. */
    private static ?string $roleName = null;

    /** @var ExtUserRole|BaseUserRole|null Объект роли. */
    private static null|ExtUserRole|BaseUserRole $roleObj = null;

    /** @var bool Разрешен ли просмотр объектов. */
    private static ?bool $objectViewer = null;

    /** @var bool Разрешен ли CRUD объектов. */
    private static ?bool $manageObjects = null;

    /** @var bool Разрешен ли CRUD объемов. */
    private static ?bool $manageVolumes = null;

    /** @var bool Разрешено ли управление историей. */
    private static ?bool $manageHistory = null;

    /** @var bool Разрешен ли CRUD учетными записями. */
    private static ?bool $manageUsers = null;

    /**
     * @param int|null $userId ID пользователя.
     * @param int|null $roleId ID роли.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    function __construct(?int $userId = null, ?int $roleId = null)
    {
        if ($userId && $roleId) {
            $this::$userId = $userId;
            $this::$roleId = $roleId;
            $this->applyDefaultValuesByRoleId();
        } elseif ($roleId) {
            $this::$roleId = $roleId;
            $this::$userId = Auth::getUser()->id();
            $this->applyDefaultValuesByRoleId();
        } else {
            $this::$userId = $userId ?: Auth::getUser()->id();
            $this->applyDefaultValuesByUserId();
        }
    }

    #region Apply Default Values Functions
    /**
     * Заполнение свойств класса, используя ID пользователя.
     * Получение и присваивание ID роли (roleId).
     * @return void
     * @throws NoUserFoundException
     * @throws NoRoleFoundException
     */
    private function applyDefaultValuesByUserId(): void
    {
        $user = UsersQuery::create()->filterByIsAvailable(1)->findPk($this::$userId) ??
                throw new NoUserFoundException();
        $this::$roleId = $user->getRoleId();
        $this->applyDefaultValuesByRoleId();
    }

    /**
     * Заполнение свойств класса, используя ID роли.
     * Получение и присваивание объекта роли ($roleObj).
     * @param bool $flag Обновлять ли свойства класса в соответствие со значениями найденного объекта.
     * @return void
     * @throws NoRoleFoundException
     */
    private function applyDefaultValuesByRoleId(bool $flag = true): void
    {
        $this::$roleObj = UserRoleQuery::create()->findPk($this::$roleId) ??
                         throw new NoRoleFoundException();
        $this::$roleObj = DB::getExtUserRole($this::$roleObj);

        if ($flag) {
            $this->applyDefaultValuesByRoleObj();
        }
    }

    /**
     * Заполнение свойств класса, используя объект роли.
     * Получение и присваивание доступных права
     * ($roleName, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers).
     * @return void
     */
    private function applyDefaultValuesByRoleObj(): void
    {
        $this::$roleName = $this::$roleObj->getName();
        $this::$objectViewer = $this::$roleObj->getObjectViewer();
        $this::$manageObjects = $this::$roleObj->getManageObjects();
        $this::$manageVolumes = $this::$roleObj->getManageVolumes();
        $this::$manageHistory = $this::$roleObj->getManageHistory();
        $this::$manageUsers = $this::$roleObj->getManageUsers();
    }

    #endregion

    #region Access Control Functions
    /** @return bool Разрешен ли просмотр объектов. */
    public function isObjectViewer(): bool
    {
        return $this::$objectViewer;
    }

    /** @return bool Разрешен ли CRUD объектов. */
    public function isManageObjects(): bool
    {
        return $this::$manageObjects;
    }

    /** @return bool Разрешен ли CRUD объемов. */
    public function isManageVolumes(): bool
    {
        return $this::$manageVolumes;
    }

    /** @return bool Разрешено ли управление историей. */
    public function isManageHistory(): bool
    {
        return $this::$manageHistory;
    }

    /** @return bool Разрешен ли CRUD учетными записями. */
    public function isManageUsers(): bool
    {
        return $this::$manageUsers;
    }

    /**
     * @return bool Просмотр объектов разрешен, иначе - ошибка.
     * @throws NoAccessObjectViewException
     */
    public function isObjectViewerOrThrow(): bool
    {
        return $this::$objectViewer ?: throw new NoAccessObjectViewException();
    }

    /**
     * @return bool CRUD объектов разрешен, иначе - ошибка.
     * @throws NoAccessManageObjectsException
     */
    public function isManageObjectsOrThrow(): bool
    {
        return $this::$manageObjects ?: throw new NoAccessManageObjectsException();
    }

    /**
     * @return bool CRUD объемов разрешен, иначе - ошибка.
     * @throws NoAccessManageVolumes
     */
    public function isManageVolumesOrThrow(): bool
    {
        return $this::$manageVolumes ?: throw new NoAccessManageVolumes();
    }

    /**
     * @return bool Управление историей разрешено, иначе - ошибка.
     * @throws Exception
     */
    public function isManageHistoryOrThrow(): bool
    {
        return $this::$manageHistory ?: throw new NoAccessManageHistoryException();
    }

    /**
     * @return bool CRUD учетными записями разрешен, иначе - ошибка.
     * @throws NoAccessManageUsersException
     */
    public function isManageUsersOrThrow(): bool
    {
        return $this::$manageUsers ?: throw new NoAccessManageUsersException();
    }
    #endregion

    #region Getter Default Values Functions
    /** @return int ID пользователя. */
    public function getUserId(): int
    {
        return $this::$userId;
    }

    /** @return int ID роли. */
    public function getRoleId(): int
    {
        return $this::$roleId;
    }

    /** @return string Наименование роли. */
    public function getRoleName(): string
    {
        return $this::$roleName;
    }

    /** @return ExtUserRole Объект роли. */
    public function getRoleObj(): ExtUserRole
    {
        return $this::$roleObj;
    }
    #endregion

    #region Static Getter Functions
    /**
     * Получить объект класса через статический метод, используя ID пользователя.
     * @param int|null $id ID пользователя, по умолчанию выбирается ID авторизированного пользователя.
     * @return UserRole|null
     * @throws Exception
     */
    public static function getByUserId(?int $id = null): ?UserRole
    {
        if ($id !== null) {
            if (self::$userId === $id) return self::$staticConstruct;
            return new UserRole(userId: $id);
        }
    }

    /**
     * Получить объект класса через статический метод, используя ID роли.
     * Свойству $userId будет присвоенно ID авторизованного пользователя.
     * @param int|null $id ID роли.
     * @return UserRole
     * @throws Exception
     */
    public static function getByRoleId(?int $id = null): UserRole
    {
        if (self::$staticConstruct === null || self::$roleId !== $id) {
            self::$staticConstruct = new UserRole(roleId: $id);
        }

        return self::$staticConstruct;
    }
    #endregion

    #region Setter Default Values Function
    /**
     * Присваивание свойству класса ID пользователя.
     * @param int $id ID пользователя.
     * @param bool $flag Необходимо ли обновлять свойства роли, в соответствие с ролью пользователя.
     * Обновляются такие значения как: $roleId, $roleName, $roleObj, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers.
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public function setUserId(int $id, bool $flag = true): UserRole
    {
        if ($this::$userId !== $id) {
            $this::$userId = $id;

            if ($flag) {
                $this->applyDefaultValuesByUserId();
            }
        }

        return $this;
    }

    /**
     * Присваивание свойству класса ID роли.
     * @param int $id ID роли.
     * @param bool $flag Необходимо ли обновлять свойства роли под значения переданного ID роли.
     * Обновляются такие значения как: $roleId, $roleName, $roleObj, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers.
     * @return UserRole
     * @throws NoRoleFoundException
     */
    public function setRoleId(int $id, bool $flag = true): UserRole
    {
        if ($this::$roleId !== $id) {
            $this::$roleId = $id;

            if ($flag) {
                $this->applyDefaultValuesByRoleId();
            }
        }

        return $this;
    }

    /**
     * Присваивание свойству класса наименование роли.
     * @param string|null $name Наименование роли.
     * @return UserRole
     */
    public function setRoleName(?string $name): UserRole
    {
        if ($name !== null && $this::$roleName !== $name) {
            $this::$roleName = $name;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса объект роли.
     * @param ExtUserRole $role Объект роли.
     * @param bool $flag Необходимо ли обновлять свойства роли в соответсвие с переданным объектом.
     * Обновляются такие значения как: $roleId, $roleName, $roleObj, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers.
     * @return UserRole
     */
    public function setRoleObj(ExtUserRole $role, bool $flag = true): UserRole
    {
        if ($this::$roleId !== $role->getId()) {
            $this::$roleObj = $role;

            if ($flag) {
                $this::$roleId = $role->getId();
                $this->applyDefaultValuesByRoleObj();
            }
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на просмотр объектов.
     * @param bool|null $flag Разрешен ли просмотр объектов.
     * @return UserRole
     */
    public function setObjectViewer(?bool $flag): UserRole
    {
        if ($flag !== null && $this::$objectViewer !== $flag) {
            $this::$objectViewer = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD объектов.
     * @param bool|null $flag Разрешен ли CRUD объектов.
     * @return UserRole
     */
    public function setManageObjects(?bool $flag): UserRole
    {
        if ($flag !== null && $this::$manageObjects !== $flag) {
            $this::$manageObjects = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD объевом.
     * @param bool|null $flag Разрешен ли CRUD объевом.
     * @return UserRole
     */
    public function setManageVolumes(?bool $flag): UserRole
    {
        if ($flag !== null && $this::$manageVolumes !== $flag) {
            $this::$manageVolumes = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на управление историей.
     * @param bool|null $flag Разрешено ли управление историей.
     * @return UserRole
     */
    public function setManageHistory(?bool $flag): UserRole
    {
        if ($flag !== null && $this::$manageHistory !== $flag) {
            $this::$manageHistory = $flag;
        }

        return $this;
    }

    /**
     * Присваивание свойству класса разрешение на CRUD учетными записями.
     * @param bool|null $flag Разрешен ли CRUD учетными записями.
     * @return UserRole
     */
    public function setManageUsers(?bool $flag): UserRole
    {
        if ($flag !== null && $this::$manageUsers !== $flag) {
            $this::$manageUsers = $flag;
        }

        return $this;
    }
    #endregion

    #region CRUD User Role Functions
    /**
     * Обновление роли у пользователя.
     * Используются такие свойства класса, как: $userId, $roleId.
     * @return UserRole
     * @throws NoUserFoundException
     * @throws PropelException
     */
    public function updateUserRole(): UserRole
    {
        $user = UsersQuery::create()->findPk($this::$userId) ??
                throw new NoUserFoundException();

        if ($user->getRoleId() !== $this::$roleId) {
            $user
                ->setRoleId($this::$roleId)
                ->save();
        }

        return $this;
    }

    /**
     * Добавление новой роли.
     * Используются такие свойства класса, как:
     * $roleName, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers.
     * @return UserRole
     * @throws PropelException
     */
    public function add(): UserRole
    {
        $this::$roleObj = new ExtUserRole();
        $this->roleObj
            ->setName($this::$roleName)
            ->setObjectViewer($this::$objectViewer)
            ->setManageObjects($this::$manageObjects)
            ->setManageVolumes($this::$manageVolumes)
            ->setManageHistory($this::$manageHistory)
            ->setManageUsers($this::$manageUsers)
            ->save();

        $this::$roleId = $this::$roleObj->getId();

        return $this;
    }

    /**
     * Обновление роли.
     * Используются такие свойства класса, как:
     * $roleName, $objectViewer, $manageObjects, $manageVolumes, $manageHistory, $manageUsers.
     * @param bool $isObj Использовать объект роли (true) / ID роли (false).
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoRoleObjectException
     * @throws PropelException
     */
    public function update(bool $isObj = false): UserRole
    {
        if ($isObj && !$this::$roleObj) throw new NoRoleObjectException();
        elseif (!$isObj) $this->applyDefaultValuesByRoleId(false);

        if ($this::$roleName !== null) $this::$roleObj->setName($this::$roleName);
        if ($this::$objectViewer !== null) $this::$roleObj->setObjectViewer($this::$objectViewer);
        if ($this::$manageObjects !== null) $this::$roleObj->setManageObjects($this::$manageObjects);
        if ($this::$manageVolumes !== null) $this::$roleObj->setManageVolumes($this::$manageVolumes);
        if ($this::$manageHistory !== null) $this::$roleObj->setManageHistory($this::$manageHistory);
        if ($this::$manageUsers !== null) $this::$roleObj->setManageUsers($this::$manageUsers);

        $this::$roleObj->save();

        return $this;
    }

    /**
     * Удаление роли.
     * Перед удалением функция preDelete заменяется у всех пользователе данною роль на ID номер 1.
     * @param bool $isObj Использовать объект роли (true) / ID роли (false).
     * @return UserRole
     * @throws NoRoleFoundException
     * @throws NoRoleObjectException
     * @throws PropelException
     */
    public function delete(bool $isObj = false): UserRole
    {
        if ($isObj && $this::$roleObj === null) throw new NoRoleObjectException();
        elseif (!$isObj) $this->applyDefaultValuesByRoleId();

        $this::$roleObj->delete();

        return $this;
    }
    #endregion
}