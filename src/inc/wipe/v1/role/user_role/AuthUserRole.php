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
        $this::applyDefault();
    }

    #region Apply Functions
    /**
     * Заполнение свойств класса по умолчанию.
     * Т.е. по авторизованному пользователю.
     * @return void
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function applyDefault(): void
    {
        self::$userId = Auth::getUser()->id();
        self::$userRoleObj = UserRole::getByUserId(self::$userId);
    }
    #endregion

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
    /**
     * Проверяет на наличие объекта роли, иначе - заполняет по умолчанию.
     * Т.е. заполняет по авторизованному пользователю.
     * @return AuthUserRole
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isNoEmptyRoleObjOrApplyDefault(): AuthUserRole
    {
        if (self::$userRoleObj === null) {
            self::applyDefault();
        }

        return new self;
    }

    /**
     * @return bool Разрешен ли просмотр объектов.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessObjectViewer(): bool
    {
        self::isNoEmptyRoleObjOrApplyDefault();
        return self::$userRoleObj->isAccessObjectViewer();
    }

    /**
     * Разрешен просмотр объектов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessObjectViewException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessObjectViewerOrThrow(): AuthUserRole
    {
        return self::isAccessObjectViewer() ? new self : throw new NoAccessObjectViewException();
    }

    /**
     * @return bool Разрешен ли CRUD объектов.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageObjects(): bool
    {
        self::isNoEmptyRoleObjOrApplyDefault();
        return self::$userRoleObj->isAccessManageObjects();
    }

    /**
     * Разрешен CRUD объектов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageObjectsException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageObjectsOrThrow(): AuthUserRole
    {
        return self::isAccessManageObjects() ? new self : throw new NoAccessManageObjectsException();
    }

    /**
     * @return bool Разрешен ли CRUD объемов.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageVolumes(): bool
    {
        self::isNoEmptyRoleObjOrApplyDefault();
        return self::$userRoleObj->isAccessManageVolumes();
    }

    /**
     * Разрешен CRUD объемов, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageVolumesException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageVolumesOrThrow(): AuthUserRole
    {
        return self::isAccessManageVolumes() ? new self : throw new NoAccessManageVolumesException();
    }

    /**
     * @return bool Разрешено ли управление историей.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageHistory(): bool
    {
        self::isNoEmptyRoleObjOrApplyDefault();
        return self::$userRoleObj->isAccessManageHistory();
    }

    /**
     * Разрешено управление историей, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageHistoryException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageHistoryOrThrow(): AuthUserRole
    {
        return self::isAccessManageHistory() ? new self : throw new NoAccessManageHistoryException();
    }

    /**
     * @return bool Разрешен ли CRUD учетными записями.
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
     */
    public static function isAccessManageUsers(): bool
    {
        self::isNoEmptyRoleObjOrApplyDefault();
        return self::$userRoleObj->isAccessManageUsers();
    }

    /**
     * Разрешен CRUD учетными записями, иначе - ошибка.
     * @return AuthUserRole
     * @throws NoAccessManageUsersException
     * @throws NoRoleFoundException
     * @throws NoUserFoundException
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