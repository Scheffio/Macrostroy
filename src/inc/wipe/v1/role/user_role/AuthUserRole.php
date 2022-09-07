<?php
namespace wipe\inc\v1\role\user_role;

use inc\artemy\v1\auth\Auth;
use Propel\Runtime\Exception\PropelException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageHistoryException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageObjectsException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageUsersException;
use wipe\inc\v1\role\user_role\exception\NoAccessManageVolumesException;
use wipe\inc\v1\role\user_role\exception\NoAccessObjectViewException;
use wipe\inc\v1\role\user_role\exception\NoRoleFoundException;
use wipe\inc\v1\role\user_role\exception\NoUserFoundException;

class AuthUserRole
{
    /** @var int|null ID пользователя. */
    private static ?int $userId = null;

    /** @var UserRole|null Объект роли. */
    private static ?UserRole $userRoleObj = null;

    /**
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    function __construct()
    {
        $this::$userId = Auth::getUser()->id();
        $this::$userRoleObj = UserRole::getByUserId($this::$userId);
    }

    #region Getter Functions
    /** @return int|null ID пользователя. */
    public function getUserId(): ?int
    {
        return $this::$userId;
    }

    /** @return UserRole|null Объект роли. */
    public function getUserRoleObj(): ?UserRole
    {
        return $this::$userRoleObj;
    }
    #endregion

    #region Access Control Functions
    /** @return bool Разрешен ли просмотр объектов. */
    public static function isAccessObjectViewer(): bool
    {
        return self::$userRoleObj->isAccessObjectViewer();
    }

    /**
     * Разрешен просмотр объектов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessObjectViewException
     */
    public static function isAccessObjectViewerOrThrow(): AuthUserRole
    {
        return self::isAccessObjectViewer() ? new self : throw new NoAccessObjectViewException();
    }

    /** @return bool Разрешен ли CRUD объектов. */
    public static function isAccessManageObjects(): bool
    {
        return self::$userRoleObj->isAccessManageObjects();
    }

    /**
     * Разрешен CRUD объектов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageObjectsException
     */
    public static function isAccessManageObjectsOrThrow(): AuthUserRole
    {
        return self::isAccessManageObjects() ? new self : throw new NoAccessManageObjectsException();
    }

    /** @return bool Разрешен ли CRUD объемов. */
    public static function isAccessManageVolumes(): bool
    {
        return self::$userRoleObj->isAccessManageVolumes();
    }

    /**
     * Разрешен CRUD объемов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageVolumesException
     */
    public static function isAccessManageVolumesOrThrow(): AuthUserRole
    {
        return self::isAccessManageVolumes() ? new self : throw new NoAccessManageVolumesException();
    }

    /** @return bool Разрешено ли управление историей. */
    public static function isAccessManageHistory(): bool
    {
        return self::$userRoleObj->isAccessManageHistory();
    }

    /**
     * Разрешено управление историей, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageHistoryException
     */
    public static function isAccessManageHistoryOrThrow(): AuthUserRole
    {
        return self::isAccessManageHistory() ? new self : throw new NoAccessManageHistoryException();
    }

    /** @return bool Разрешен ли CRUD учетными записями. */
    public static function isAccessManageUsers(): bool
    {
        return self::$userRoleObj->isAccessManageUsers();
    }

    /**
     * Разрешен CRUD учетными записями, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageUsersException
     */
    public static function isAccessManageUsersOrThrow(): AuthUserRole
    {
        return self::isAccessManageUsers() ? new self : throw new NoAccessManageUsersException();
    }
    #endregion

    #region CRUD Functions
    /**
     * Обновить ID роли пользователя.
     * @param int|null $id ID роли.
     * @return AuthUserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     * @throws PropelException
     */
    public function setUserRoleId(?int $id = null): AuthUserRole
    {
        if ($id !== null && $this::$userRoleObj !== null) {
            $this::$userRoleObj
                ->setRoleIdAndApply($id)
                ->updateUserRoleIdByObj();
        }

        return $this;
    }
    #endregion
}