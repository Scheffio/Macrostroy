<?php

namespace DB\Base;

use \Exception;
use \PDO;
use DB\Users as ChildUsers;
use DB\UsersQuery as ChildUsersQuery;
use DB\Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByUsername($order = Criteria::ASC) Order by the username column
 * @method     ChildUsersQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildUsersQuery orderByRoleId($order = Criteria::ASC) Order by the role_id column
 * @method     ChildUsersQuery orderByVerified($order = Criteria::ASC) Order by the verified column
 * @method     ChildUsersQuery orderByResettable($order = Criteria::ASC) Order by the resettable column
 * @method     ChildUsersQuery orderByRolesMask($order = Criteria::ASC) Order by the roles_mask column
 * @method     ChildUsersQuery orderByRegistered($order = Criteria::ASC) Order by the registered column
 * @method     ChildUsersQuery orderByLastLogin($order = Criteria::ASC) Order by the last_login column
 * @method     ChildUsersQuery orderByForceLogout($order = Criteria::ASC) Order by the force_logout column
 * @method     ChildUsersQuery orderByIsAvailable($order = Criteria::ASC) Order by the is_available column
 *
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByPhone() Group by the phone column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByUsername() Group by the username column
 * @method     ChildUsersQuery groupByStatus() Group by the status column
 * @method     ChildUsersQuery groupByRoleId() Group by the role_id column
 * @method     ChildUsersQuery groupByVerified() Group by the verified column
 * @method     ChildUsersQuery groupByResettable() Group by the resettable column
 * @method     ChildUsersQuery groupByRolesMask() Group by the roles_mask column
 * @method     ChildUsersQuery groupByRegistered() Group by the registered column
 * @method     ChildUsersQuery groupByLastLogin() Group by the last_login column
 * @method     ChildUsersQuery groupByForceLogout() Group by the force_logout column
 * @method     ChildUsersQuery groupByIsAvailable() Group by the is_available column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinUserRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRole relation
 * @method     ChildUsersQuery rightJoinUserRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRole relation
 * @method     ChildUsersQuery innerJoinUserRole($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRole relation
 *
 * @method     ChildUsersQuery joinWithUserRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserRole relation
 *
 * @method     ChildUsersQuery leftJoinWithUserRole() Adds a LEFT JOIN clause and with to the query using the UserRole relation
 * @method     ChildUsersQuery rightJoinWithUserRole() Adds a RIGHT JOIN clause and with to the query using the UserRole relation
 * @method     ChildUsersQuery innerJoinWithUserRole() Adds a INNER JOIN clause and with to the query using the UserRole relation
 *
 * @method     ChildUsersQuery leftJoinProjectRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRole relation
 * @method     ChildUsersQuery rightJoinProjectRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRole relation
 * @method     ChildUsersQuery innerJoinProjectRole($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRole relation
 *
 * @method     ChildUsersQuery joinWithProjectRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProjectRole relation
 *
 * @method     ChildUsersQuery leftJoinWithProjectRole() Adds a LEFT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildUsersQuery rightJoinWithProjectRole() Adds a RIGHT JOIN clause and with to the query using the ProjectRole relation
 * @method     ChildUsersQuery innerJoinWithProjectRole() Adds a INNER JOIN clause and with to the query using the ProjectRole relation
 *
 * @method     ChildUsersQuery leftJoinObjProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjProject relation
 * @method     ChildUsersQuery rightJoinObjProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjProject relation
 * @method     ChildUsersQuery innerJoinObjProject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjProject relation
 *
 * @method     ChildUsersQuery joinWithObjProject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjProject relation
 *
 * @method     ChildUsersQuery leftJoinWithObjProject() Adds a LEFT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildUsersQuery rightJoinWithObjProject() Adds a RIGHT JOIN clause and with to the query using the ObjProject relation
 * @method     ChildUsersQuery innerJoinWithObjProject() Adds a INNER JOIN clause and with to the query using the ObjProject relation
 *
 * @method     ChildUsersQuery leftJoinObjSubproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildUsersQuery rightJoinObjSubproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjSubproject relation
 * @method     ChildUsersQuery innerJoinObjSubproject($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjSubproject relation
 *
 * @method     ChildUsersQuery joinWithObjSubproject($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildUsersQuery leftJoinWithObjSubproject() Adds a LEFT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildUsersQuery rightJoinWithObjSubproject() Adds a RIGHT JOIN clause and with to the query using the ObjSubproject relation
 * @method     ChildUsersQuery innerJoinWithObjSubproject() Adds a INNER JOIN clause and with to the query using the ObjSubproject relation
 *
 * @method     ChildUsersQuery leftJoinObjGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjGroup relation
 * @method     ChildUsersQuery rightJoinObjGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjGroup relation
 * @method     ChildUsersQuery innerJoinObjGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjGroup relation
 *
 * @method     ChildUsersQuery joinWithObjGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjGroup relation
 *
 * @method     ChildUsersQuery leftJoinWithObjGroup() Adds a LEFT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildUsersQuery rightJoinWithObjGroup() Adds a RIGHT JOIN clause and with to the query using the ObjGroup relation
 * @method     ChildUsersQuery innerJoinWithObjGroup() Adds a INNER JOIN clause and with to the query using the ObjGroup relation
 *
 * @method     ChildUsersQuery leftJoinObjHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjHouse relation
 * @method     ChildUsersQuery rightJoinObjHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjHouse relation
 * @method     ChildUsersQuery innerJoinObjHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjHouse relation
 *
 * @method     ChildUsersQuery joinWithObjHouse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjHouse relation
 *
 * @method     ChildUsersQuery leftJoinWithObjHouse() Adds a LEFT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildUsersQuery rightJoinWithObjHouse() Adds a RIGHT JOIN clause and with to the query using the ObjHouse relation
 * @method     ChildUsersQuery innerJoinWithObjHouse() Adds a INNER JOIN clause and with to the query using the ObjHouse relation
 *
 * @method     ChildUsersQuery leftJoinObjStage($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStage relation
 * @method     ChildUsersQuery rightJoinObjStage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStage relation
 * @method     ChildUsersQuery innerJoinObjStage($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStage relation
 *
 * @method     ChildUsersQuery joinWithObjStage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStage relation
 *
 * @method     ChildUsersQuery leftJoinWithObjStage() Adds a LEFT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildUsersQuery rightJoinWithObjStage() Adds a RIGHT JOIN clause and with to the query using the ObjStage relation
 * @method     ChildUsersQuery innerJoinWithObjStage() Adds a INNER JOIN clause and with to the query using the ObjStage relation
 *
 * @method     ChildUsersQuery leftJoinObjStageWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildUsersQuery rightJoinObjStageWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageWork relation
 * @method     ChildUsersQuery innerJoinObjStageWork($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageWork relation
 *
 * @method     ChildUsersQuery joinWithObjStageWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildUsersQuery leftJoinWithObjStageWork() Adds a LEFT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildUsersQuery rightJoinWithObjStageWork() Adds a RIGHT JOIN clause and with to the query using the ObjStageWork relation
 * @method     ChildUsersQuery innerJoinWithObjStageWork() Adds a INNER JOIN clause and with to the query using the ObjStageWork relation
 *
 * @method     ChildUsersQuery leftJoinObjStageMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageMaterial relation
 * @method     ChildUsersQuery rightJoinObjStageMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageMaterial relation
 * @method     ChildUsersQuery innerJoinObjStageMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageMaterial relation
 *
 * @method     ChildUsersQuery joinWithObjStageMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageMaterial relation
 *
 * @method     ChildUsersQuery leftJoinWithObjStageMaterial() Adds a LEFT JOIN clause and with to the query using the ObjStageMaterial relation
 * @method     ChildUsersQuery rightJoinWithObjStageMaterial() Adds a RIGHT JOIN clause and with to the query using the ObjStageMaterial relation
 * @method     ChildUsersQuery innerJoinWithObjStageMaterial() Adds a INNER JOIN clause and with to the query using the ObjStageMaterial relation
 *
 * @method     ChildUsersQuery leftJoinObjStageTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildUsersQuery rightJoinObjStageTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ObjStageTechnic relation
 * @method     ChildUsersQuery innerJoinObjStageTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the ObjStageTechnic relation
 *
 * @method     ChildUsersQuery joinWithObjStageTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildUsersQuery leftJoinWithObjStageTechnic() Adds a LEFT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildUsersQuery rightJoinWithObjStageTechnic() Adds a RIGHT JOIN clause and with to the query using the ObjStageTechnic relation
 * @method     ChildUsersQuery innerJoinWithObjStageTechnic() Adds a INNER JOIN clause and with to the query using the ObjStageTechnic relation
 *
 * @method     ChildUsersQuery leftJoinVolMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolMaterial relation
 * @method     ChildUsersQuery rightJoinVolMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolMaterial relation
 * @method     ChildUsersQuery innerJoinVolMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolMaterial relation
 *
 * @method     ChildUsersQuery joinWithVolMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolMaterial relation
 *
 * @method     ChildUsersQuery leftJoinWithVolMaterial() Adds a LEFT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildUsersQuery rightJoinWithVolMaterial() Adds a RIGHT JOIN clause and with to the query using the VolMaterial relation
 * @method     ChildUsersQuery innerJoinWithVolMaterial() Adds a INNER JOIN clause and with to the query using the VolMaterial relation
 *
 * @method     ChildUsersQuery leftJoinVolTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolTechnic relation
 * @method     ChildUsersQuery rightJoinVolTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolTechnic relation
 * @method     ChildUsersQuery innerJoinVolTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolTechnic relation
 *
 * @method     ChildUsersQuery joinWithVolTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolTechnic relation
 *
 * @method     ChildUsersQuery leftJoinWithVolTechnic() Adds a LEFT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildUsersQuery rightJoinWithVolTechnic() Adds a RIGHT JOIN clause and with to the query using the VolTechnic relation
 * @method     ChildUsersQuery innerJoinWithVolTechnic() Adds a INNER JOIN clause and with to the query using the VolTechnic relation
 *
 * @method     ChildUsersQuery leftJoinVolWork($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWork relation
 * @method     ChildUsersQuery rightJoinVolWork($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWork relation
 * @method     ChildUsersQuery innerJoinVolWork($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWork relation
 *
 * @method     ChildUsersQuery joinWithVolWork($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWork relation
 *
 * @method     ChildUsersQuery leftJoinWithVolWork() Adds a LEFT JOIN clause and with to the query using the VolWork relation
 * @method     ChildUsersQuery rightJoinWithVolWork() Adds a RIGHT JOIN clause and with to the query using the VolWork relation
 * @method     ChildUsersQuery innerJoinWithVolWork() Adds a INNER JOIN clause and with to the query using the VolWork relation
 *
 * @method     ChildUsersQuery leftJoinVolWorkMaterial($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildUsersQuery rightJoinVolWorkMaterial($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkMaterial relation
 * @method     ChildUsersQuery innerJoinVolWorkMaterial($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkMaterial relation
 *
 * @method     ChildUsersQuery joinWithVolWorkMaterial($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkMaterial relation
 *
 * @method     ChildUsersQuery leftJoinWithVolWorkMaterial() Adds a LEFT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildUsersQuery rightJoinWithVolWorkMaterial() Adds a RIGHT JOIN clause and with to the query using the VolWorkMaterial relation
 * @method     ChildUsersQuery innerJoinWithVolWorkMaterial() Adds a INNER JOIN clause and with to the query using the VolWorkMaterial relation
 *
 * @method     ChildUsersQuery leftJoinVolWorkTechnic($relationAlias = null) Adds a LEFT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildUsersQuery rightJoinVolWorkTechnic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VolWorkTechnic relation
 * @method     ChildUsersQuery innerJoinVolWorkTechnic($relationAlias = null) Adds a INNER JOIN clause to the query using the VolWorkTechnic relation
 *
 * @method     ChildUsersQuery joinWithVolWorkTechnic($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VolWorkTechnic relation
 *
 * @method     ChildUsersQuery leftJoinWithVolWorkTechnic() Adds a LEFT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildUsersQuery rightJoinWithVolWorkTechnic() Adds a RIGHT JOIN clause and with to the query using the VolWorkTechnic relation
 * @method     ChildUsersQuery innerJoinWithVolWorkTechnic() Adds a INNER JOIN clause and with to the query using the VolWorkTechnic relation
 *
 * @method     \DB\UserRoleQuery|\DB\ProjectRoleQuery|\DB\ObjProjectQuery|\DB\ObjSubprojectQuery|\DB\ObjGroupQuery|\DB\ObjHouseQuery|\DB\ObjStageQuery|\DB\ObjStageWorkQuery|\DB\ObjStageMaterialQuery|\DB\ObjStageTechnicQuery|\DB\VolMaterialQuery|\DB\VolTechnicQuery|\DB\VolWorkQuery|\DB\VolWorkMaterialQuery|\DB\VolWorkTechnicQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers|null findOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers|null findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers|null findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers|null findOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column
 * @method     ChildUsers|null findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers|null findOneByUsername(string $username) Return the first ChildUsers filtered by the username column
 * @method     ChildUsers|null findOneByStatus(int $status) Return the first ChildUsers filtered by the status column
 * @method     ChildUsers|null findOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column
 * @method     ChildUsers|null findOneByVerified(int $verified) Return the first ChildUsers filtered by the verified column
 * @method     ChildUsers|null findOneByResettable(int $resettable) Return the first ChildUsers filtered by the resettable column
 * @method     ChildUsers|null findOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column
 * @method     ChildUsers|null findOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column
 * @method     ChildUsers|null findOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column
 * @method     ChildUsers|null findOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column
 * @method     ChildUsers|null findOneByIsAvailable(boolean $is_available) Return the first ChildUsers filtered by the is_available column *

 * @method     ChildUsers requirePk($key, ?ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(?ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUsername(string $username) Return the first ChildUsers filtered by the username column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByStatus(int $status) Return the first ChildUsers filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRoleId(int $role_id) Return the first ChildUsers filtered by the role_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByVerified(int $verified) Return the first ChildUsers filtered by the verified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByResettable(int $resettable) Return the first ChildUsers filtered by the resettable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRolesMask(int $roles_mask) Return the first ChildUsers filtered by the roles_mask column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRegistered(int $registered) Return the first ChildUsers filtered by the registered column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByLastLogin(int $last_login) Return the first ChildUsers filtered by the last_login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByForceLogout(int $force_logout) Return the first ChildUsers filtered by the force_logout column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIsAvailable(boolean $is_available) Return the first ChildUsers filtered by the is_available column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|Collection find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildUsers> find(?ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|Collection findById(int $id) Return ChildUsers objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildUsers> findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|Collection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildUsers> findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|Collection findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @method     ChildUsers[]|Collection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildUsers> findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|Collection findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @psalm-method Collection&\Traversable<ChildUsers> findByUsername(string $username) Return ChildUsers objects filtered by the username column
 * @method     ChildUsers[]|Collection findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildUsers> findByStatus(int $status) Return ChildUsers objects filtered by the status column
 * @method     ChildUsers[]|Collection findByRoleId(int $role_id) Return ChildUsers objects filtered by the role_id column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRoleId(int $role_id) Return ChildUsers objects filtered by the role_id column
 * @method     ChildUsers[]|Collection findByVerified(int $verified) Return ChildUsers objects filtered by the verified column
 * @psalm-method Collection&\Traversable<ChildUsers> findByVerified(int $verified) Return ChildUsers objects filtered by the verified column
 * @method     ChildUsers[]|Collection findByResettable(int $resettable) Return ChildUsers objects filtered by the resettable column
 * @psalm-method Collection&\Traversable<ChildUsers> findByResettable(int $resettable) Return ChildUsers objects filtered by the resettable column
 * @method     ChildUsers[]|Collection findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRolesMask(int $roles_mask) Return ChildUsers objects filtered by the roles_mask column
 * @method     ChildUsers[]|Collection findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @psalm-method Collection&\Traversable<ChildUsers> findByRegistered(int $registered) Return ChildUsers objects filtered by the registered column
 * @method     ChildUsers[]|Collection findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @psalm-method Collection&\Traversable<ChildUsers> findByLastLogin(int $last_login) Return ChildUsers objects filtered by the last_login column
 * @method     ChildUsers[]|Collection findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @psalm-method Collection&\Traversable<ChildUsers> findByForceLogout(int $force_logout) Return ChildUsers objects filtered by the force_logout column
 * @method     ChildUsers[]|Collection findByIsAvailable(boolean $is_available) Return ChildUsers objects filtered by the is_available column
 * @psalm-method Collection&\Traversable<ChildUsers> findByIsAvailable(boolean $is_available) Return ChildUsers objects filtered by the is_available column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsers> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \DB\Base\UsersQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\DB\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, email, phone, password, username, status, role_id, verified, resettable, roles_mask, registered, last_login, force_logout, is_available FROM users WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone(['foo', 'bar']); // WHERE phone IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $phone The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone($phone = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PHONE, $phone, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the username column
     *
     * Example usage:
     * <code>
     * $query->filterByUsername('fooValue');   // WHERE username = 'fooValue'
     * $query->filterByUsername('%fooValue%', Criteria::LIKE); // WHERE username LIKE '%fooValue%'
     * $query->filterByUsername(['foo', 'bar']); // WHERE username IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $username The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUsername($username = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($username)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_USERNAME, $username, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoleId(1234); // WHERE role_id = 1234
     * $query->filterByRoleId(array(12, 34)); // WHERE role_id IN (12, 34)
     * $query->filterByRoleId(array('min' => 12)); // WHERE role_id > 12
     * </code>
     *
     * @see       filterByUserRole()
     *
     * @param mixed $roleId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRoleId($roleId = null, ?string $comparison = null)
    {
        if (is_array($roleId)) {
            $useMinMax = false;
            if (isset($roleId['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roleId['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLE_ID, $roleId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the verified column
     *
     * Example usage:
     * <code>
     * $query->filterByVerified(1234); // WHERE verified = 1234
     * $query->filterByVerified(array(12, 34)); // WHERE verified IN (12, 34)
     * $query->filterByVerified(array('min' => 12)); // WHERE verified > 12
     * </code>
     *
     * @param mixed $verified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVerified($verified = null, ?string $comparison = null)
    {
        if (is_array($verified)) {
            $useMinMax = false;
            if (isset($verified['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($verified['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_VERIFIED, $verified, $comparison);

        return $this;
    }

    /**
     * Filter the query on the resettable column
     *
     * Example usage:
     * <code>
     * $query->filterByResettable(1234); // WHERE resettable = 1234
     * $query->filterByResettable(array(12, 34)); // WHERE resettable IN (12, 34)
     * $query->filterByResettable(array('min' => 12)); // WHERE resettable > 12
     * </code>
     *
     * @param mixed $resettable The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByResettable($resettable = null, ?string $comparison = null)
    {
        if (is_array($resettable)) {
            $useMinMax = false;
            if (isset($resettable['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resettable['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_RESETTABLE, $resettable, $comparison);

        return $this;
    }

    /**
     * Filter the query on the roles_mask column
     *
     * Example usage:
     * <code>
     * $query->filterByRolesMask(1234); // WHERE roles_mask = 1234
     * $query->filterByRolesMask(array(12, 34)); // WHERE roles_mask IN (12, 34)
     * $query->filterByRolesMask(array('min' => 12)); // WHERE roles_mask > 12
     * </code>
     *
     * @param mixed $rolesMask The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRolesMask($rolesMask = null, ?string $comparison = null)
    {
        if (is_array($rolesMask)) {
            $useMinMax = false;
            if (isset($rolesMask['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rolesMask['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_ROLES_MASK, $rolesMask, $comparison);

        return $this;
    }

    /**
     * Filter the query on the registered column
     *
     * Example usage:
     * <code>
     * $query->filterByRegistered(1234); // WHERE registered = 1234
     * $query->filterByRegistered(array(12, 34)); // WHERE registered IN (12, 34)
     * $query->filterByRegistered(array('min' => 12)); // WHERE registered > 12
     * </code>
     *
     * @param mixed $registered The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegistered($registered = null, ?string $comparison = null)
    {
        if (is_array($registered)) {
            $useMinMax = false;
            if (isset($registered['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($registered['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_REGISTERED, $registered, $comparison);

        return $this;
    }

    /**
     * Filter the query on the last_login column
     *
     * Example usage:
     * <code>
     * $query->filterByLastLogin(1234); // WHERE last_login = 1234
     * $query->filterByLastLogin(array(12, 34)); // WHERE last_login IN (12, 34)
     * $query->filterByLastLogin(array('min' => 12)); // WHERE last_login > 12
     * </code>
     *
     * @param mixed $lastLogin The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastLogin($lastLogin = null, ?string $comparison = null)
    {
        if (is_array($lastLogin)) {
            $useMinMax = false;
            if (isset($lastLogin['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastLogin['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_LAST_LOGIN, $lastLogin, $comparison);

        return $this;
    }

    /**
     * Filter the query on the force_logout column
     *
     * Example usage:
     * <code>
     * $query->filterByForceLogout(1234); // WHERE force_logout = 1234
     * $query->filterByForceLogout(array(12, 34)); // WHERE force_logout IN (12, 34)
     * $query->filterByForceLogout(array('min' => 12)); // WHERE force_logout > 12
     * </code>
     *
     * @param mixed $forceLogout The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByForceLogout($forceLogout = null, ?string $comparison = null)
    {
        if (is_array($forceLogout)) {
            $useMinMax = false;
            if (isset($forceLogout['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($forceLogout['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(UsersTableMap::COL_FORCE_LOGOUT, $forceLogout, $comparison);

        return $this;
    }

    /**
     * Filter the query on the is_available column
     *
     * Example usage:
     * <code>
     * $query->filterByIsAvailable(true); // WHERE is_available = true
     * $query->filterByIsAvailable('yes'); // WHERE is_available = true
     * </code>
     *
     * @param bool|string $isAvailable The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIsAvailable($isAvailable = null, ?string $comparison = null)
    {
        if (is_string($isAvailable)) {
            $isAvailable = in_array(strtolower($isAvailable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $this->addUsingAlias(UsersTableMap::COL_IS_AVAILABLE, $isAvailable, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \DB\UserRole object
     *
     * @param \DB\UserRole|ObjectCollection $userRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserRole($userRole, ?string $comparison = null)
    {
        if ($userRole instanceof \DB\UserRole) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $userRole->getId(), $comparison);
        } elseif ($userRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(UsersTableMap::COL_ROLE_ID, $userRole->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByUserRole() only accepts arguments of type \DB\UserRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUserRole(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRole');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'UserRole');
        }

        return $this;
    }

    /**
     * Use the UserRole relation UserRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\UserRoleQuery A secondary query class using the current class as primary query
     */
    public function useUserRoleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRole', '\DB\UserRoleQuery');
    }

    /**
     * Use the UserRole relation UserRole object
     *
     * @param callable(\DB\UserRoleQuery):\DB\UserRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUserRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UserRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\UserRoleQuery The inner query object of the EXISTS statement
     */
    public function useUserRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserRole', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UserRole table for a NOT EXISTS query.
     *
     * @see useUserRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\UserRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserRole', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ProjectRole object
     *
     * @param \DB\ProjectRole|ObjectCollection $projectRole the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProjectRole($projectRole, ?string $comparison = null)
    {
        if ($projectRole instanceof \DB\ProjectRole) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $projectRole->getUserId(), $comparison);

            return $this;
        } elseif ($projectRole instanceof ObjectCollection) {
            $this
                ->useProjectRoleQuery()
                ->filterByPrimaryKeys($projectRole->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProjectRole() only accepts arguments of type \DB\ProjectRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProjectRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectRole');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProjectRole');
        }

        return $this;
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ProjectRoleQuery A secondary query class using the current class as primary query
     */
    public function useProjectRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectRole', '\DB\ProjectRoleQuery');
    }

    /**
     * Use the ProjectRole relation ProjectRole object
     *
     * @param callable(\DB\ProjectRoleQuery):\DB\ProjectRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProjectRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProjectRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProjectRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ProjectRoleQuery The inner query object of the EXISTS statement
     */
    public function useProjectRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProjectRole table for a NOT EXISTS query.
     *
     * @see useProjectRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ProjectRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useProjectRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProjectRole', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjProject object
     *
     * @param \DB\ObjProject|ObjectCollection $objProject the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjProject($objProject, ?string $comparison = null)
    {
        if ($objProject instanceof \DB\ObjProject) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objProject->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objProject instanceof ObjectCollection) {
            $this
                ->useObjProjectQuery()
                ->filterByPrimaryKeys($objProject->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjProject() only accepts arguments of type \DB\ObjProject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjProject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjProject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjProject');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjProject');
        }

        return $this;
    }

    /**
     * Use the ObjProject relation ObjProject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjProjectQuery A secondary query class using the current class as primary query
     */
    public function useObjProjectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjProject', '\DB\ObjProjectQuery');
    }

    /**
     * Use the ObjProject relation ObjProject object
     *
     * @param callable(\DB\ObjProjectQuery):\DB\ObjProjectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjProjectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjProjectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjProject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjProjectQuery The inner query object of the EXISTS statement
     */
    public function useObjProjectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjProject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjProject table for a NOT EXISTS query.
     *
     * @see useObjProjectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjProjectQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjProjectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjProject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjSubproject object
     *
     * @param \DB\ObjSubproject|ObjectCollection $objSubproject the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjSubproject($objSubproject, ?string $comparison = null)
    {
        if ($objSubproject instanceof \DB\ObjSubproject) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objSubproject->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objSubproject instanceof ObjectCollection) {
            $this
                ->useObjSubprojectQuery()
                ->filterByPrimaryKeys($objSubproject->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjSubproject() only accepts arguments of type \DB\ObjSubproject or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjSubproject relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjSubproject(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjSubproject');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjSubproject');
        }

        return $this;
    }

    /**
     * Use the ObjSubproject relation ObjSubproject object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjSubprojectQuery A secondary query class using the current class as primary query
     */
    public function useObjSubprojectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjSubproject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjSubproject', '\DB\ObjSubprojectQuery');
    }

    /**
     * Use the ObjSubproject relation ObjSubproject object
     *
     * @param callable(\DB\ObjSubprojectQuery):\DB\ObjSubprojectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjSubprojectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjSubprojectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjSubproject table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjSubprojectQuery The inner query object of the EXISTS statement
     */
    public function useObjSubprojectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjSubproject', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjSubproject table for a NOT EXISTS query.
     *
     * @see useObjSubprojectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjSubprojectQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjSubprojectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjSubproject', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjGroup object
     *
     * @param \DB\ObjGroup|ObjectCollection $objGroup the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjGroup($objGroup, ?string $comparison = null)
    {
        if ($objGroup instanceof \DB\ObjGroup) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objGroup->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objGroup instanceof ObjectCollection) {
            $this
                ->useObjGroupQuery()
                ->filterByPrimaryKeys($objGroup->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjGroup() only accepts arguments of type \DB\ObjGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjGroup');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjGroup');
        }

        return $this;
    }

    /**
     * Use the ObjGroup relation ObjGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjGroupQuery A secondary query class using the current class as primary query
     */
    public function useObjGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjGroup', '\DB\ObjGroupQuery');
    }

    /**
     * Use the ObjGroup relation ObjGroup object
     *
     * @param callable(\DB\ObjGroupQuery):\DB\ObjGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjGroupQuery The inner query object of the EXISTS statement
     */
    public function useObjGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjGroup', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjGroup table for a NOT EXISTS query.
     *
     * @see useObjGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjGroup', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjHouse object
     *
     * @param \DB\ObjHouse|ObjectCollection $objHouse the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjHouse($objHouse, ?string $comparison = null)
    {
        if ($objHouse instanceof \DB\ObjHouse) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objHouse->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objHouse instanceof ObjectCollection) {
            $this
                ->useObjHouseQuery()
                ->filterByPrimaryKeys($objHouse->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjHouse() only accepts arguments of type \DB\ObjHouse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjHouse relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjHouse(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjHouse');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjHouse');
        }

        return $this;
    }

    /**
     * Use the ObjHouse relation ObjHouse object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjHouseQuery A secondary query class using the current class as primary query
     */
    public function useObjHouseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjHouse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjHouse', '\DB\ObjHouseQuery');
    }

    /**
     * Use the ObjHouse relation ObjHouse object
     *
     * @param callable(\DB\ObjHouseQuery):\DB\ObjHouseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjHouseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjHouseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjHouse table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjHouseQuery The inner query object of the EXISTS statement
     */
    public function useObjHouseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjHouse', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjHouse table for a NOT EXISTS query.
     *
     * @see useObjHouseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjHouseQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjHouseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjHouse', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStage object
     *
     * @param \DB\ObjStage|ObjectCollection $objStage the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStage($objStage, ?string $comparison = null)
    {
        if ($objStage instanceof \DB\ObjStage) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objStage->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objStage instanceof ObjectCollection) {
            $this
                ->useObjStageQuery()
                ->filterByPrimaryKeys($objStage->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStage() only accepts arguments of type \DB\ObjStage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStage(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjStage');
        }

        return $this;
    }

    /**
     * Use the ObjStage relation ObjStage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageQuery A secondary query class using the current class as primary query
     */
    public function useObjStageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStage', '\DB\ObjStageQuery');
    }

    /**
     * Use the ObjStage relation ObjStage object
     *
     * @param callable(\DB\ObjStageQuery):\DB\ObjStageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageQuery The inner query object of the EXISTS statement
     */
    public function useObjStageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStage', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStage table for a NOT EXISTS query.
     *
     * @see useObjStageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStage', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageWork object
     *
     * @param \DB\ObjStageWork|ObjectCollection $objStageWork the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageWork($objStageWork, ?string $comparison = null)
    {
        if ($objStageWork instanceof \DB\ObjStageWork) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objStageWork->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objStageWork instanceof ObjectCollection) {
            $this
                ->useObjStageWorkQuery()
                ->filterByPrimaryKeys($objStageWork->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageWork() only accepts arguments of type \DB\ObjStageWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageWork');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjStageWork');
        }

        return $this;
    }

    /**
     * Use the ObjStageWork relation ObjStageWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageWorkQuery A secondary query class using the current class as primary query
     */
    public function useObjStageWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageWork', '\DB\ObjStageWorkQuery');
    }

    /**
     * Use the ObjStageWork relation ObjStageWork object
     *
     * @param callable(\DB\ObjStageWorkQuery):\DB\ObjStageWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageWorkQuery The inner query object of the EXISTS statement
     */
    public function useObjStageWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageWork table for a NOT EXISTS query.
     *
     * @see useObjStageWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageWork', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageMaterial object
     *
     * @param \DB\ObjStageMaterial|ObjectCollection $objStageMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageMaterial($objStageMaterial, ?string $comparison = null)
    {
        if ($objStageMaterial instanceof \DB\ObjStageMaterial) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objStageMaterial->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objStageMaterial instanceof ObjectCollection) {
            $this
                ->useObjStageMaterialQuery()
                ->filterByPrimaryKeys($objStageMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageMaterial() only accepts arguments of type \DB\ObjStageMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageMaterial');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjStageMaterial');
        }

        return $this;
    }

    /**
     * Use the ObjStageMaterial relation ObjStageMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageMaterialQuery A secondary query class using the current class as primary query
     */
    public function useObjStageMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageMaterial', '\DB\ObjStageMaterialQuery');
    }

    /**
     * Use the ObjStageMaterial relation ObjStageMaterial object
     *
     * @param callable(\DB\ObjStageMaterialQuery):\DB\ObjStageMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageMaterialQuery The inner query object of the EXISTS statement
     */
    public function useObjStageMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageMaterial table for a NOT EXISTS query.
     *
     * @see useObjStageMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\ObjStageTechnic object
     *
     * @param \DB\ObjStageTechnic|ObjectCollection $objStageTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByObjStageTechnic($objStageTechnic, ?string $comparison = null)
    {
        if ($objStageTechnic instanceof \DB\ObjStageTechnic) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $objStageTechnic->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($objStageTechnic instanceof ObjectCollection) {
            $this
                ->useObjStageTechnicQuery()
                ->filterByPrimaryKeys($objStageTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByObjStageTechnic() only accepts arguments of type \DB\ObjStageTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ObjStageTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinObjStageTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ObjStageTechnic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ObjStageTechnic');
        }

        return $this;
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\ObjStageTechnicQuery A secondary query class using the current class as primary query
     */
    public function useObjStageTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinObjStageTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ObjStageTechnic', '\DB\ObjStageTechnicQuery');
    }

    /**
     * Use the ObjStageTechnic relation ObjStageTechnic object
     *
     * @param callable(\DB\ObjStageTechnicQuery):\DB\ObjStageTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withObjStageTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useObjStageTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ObjStageTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the EXISTS statement
     */
    public function useObjStageTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ObjStageTechnic table for a NOT EXISTS query.
     *
     * @see useObjStageTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\ObjStageTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useObjStageTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ObjStageTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolMaterial object
     *
     * @param \DB\VolMaterial|ObjectCollection $volMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolMaterial($volMaterial, ?string $comparison = null)
    {
        if ($volMaterial instanceof \DB\VolMaterial) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $volMaterial->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($volMaterial instanceof ObjectCollection) {
            $this
                ->useVolMaterialQuery()
                ->filterByPrimaryKeys($volMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolMaterial() only accepts arguments of type \DB\VolMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolMaterial');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolMaterial');
        }

        return $this;
    }

    /**
     * Use the VolMaterial relation VolMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolMaterialQuery A secondary query class using the current class as primary query
     */
    public function useVolMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolMaterial', '\DB\VolMaterialQuery');
    }

    /**
     * Use the VolMaterial relation VolMaterial object
     *
     * @param callable(\DB\VolMaterialQuery):\DB\VolMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolMaterialQuery The inner query object of the EXISTS statement
     */
    public function useVolMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolMaterial table for a NOT EXISTS query.
     *
     * @see useVolMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolTechnic object
     *
     * @param \DB\VolTechnic|ObjectCollection $volTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolTechnic($volTechnic, ?string $comparison = null)
    {
        if ($volTechnic instanceof \DB\VolTechnic) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $volTechnic->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($volTechnic instanceof ObjectCollection) {
            $this
                ->useVolTechnicQuery()
                ->filterByPrimaryKeys($volTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolTechnic() only accepts arguments of type \DB\VolTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolTechnic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolTechnic');
        }

        return $this;
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolTechnic', '\DB\VolTechnicQuery');
    }

    /**
     * Use the VolTechnic relation VolTechnic object
     *
     * @param callable(\DB\VolTechnicQuery):\DB\VolTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolTechnic table for a NOT EXISTS query.
     *
     * @see useVolTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWork object
     *
     * @param \DB\VolWork|ObjectCollection $volWork the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWork($volWork, ?string $comparison = null)
    {
        if ($volWork instanceof \DB\VolWork) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $volWork->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($volWork instanceof ObjectCollection) {
            $this
                ->useVolWorkQuery()
                ->filterByPrimaryKeys($volWork->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWork() only accepts arguments of type \DB\VolWork or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWork relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWork(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWork');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolWork');
        }

        return $this;
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWork($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWork', '\DB\VolWorkQuery');
    }

    /**
     * Use the VolWork relation VolWork object
     *
     * @param callable(\DB\VolWorkQuery):\DB\VolWorkQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWork table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWork table for a NOT EXISTS query.
     *
     * @see useVolWorkExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWork', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWorkMaterial object
     *
     * @param \DB\VolWorkMaterial|ObjectCollection $volWorkMaterial the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkMaterial($volWorkMaterial, ?string $comparison = null)
    {
        if ($volWorkMaterial instanceof \DB\VolWorkMaterial) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $volWorkMaterial->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($volWorkMaterial instanceof ObjectCollection) {
            $this
                ->useVolWorkMaterialQuery()
                ->filterByPrimaryKeys($volWorkMaterial->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkMaterial() only accepts arguments of type \DB\VolWorkMaterial or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkMaterial relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkMaterial(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkMaterial');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolWorkMaterial');
        }

        return $this;
    }

    /**
     * Use the VolWorkMaterial relation VolWorkMaterial object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkMaterialQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkMaterialQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkMaterial($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkMaterial', '\DB\VolWorkMaterialQuery');
    }

    /**
     * Use the VolWorkMaterial relation VolWorkMaterial object
     *
     * @param callable(\DB\VolWorkMaterialQuery):\DB\VolWorkMaterialQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkMaterialQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkMaterialQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkMaterial table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkMaterialQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkMaterialExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkMaterial', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkMaterial table for a NOT EXISTS query.
     *
     * @see useVolWorkMaterialExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkMaterialQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkMaterialNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkMaterial', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \DB\VolWorkTechnic object
     *
     * @param \DB\VolWorkTechnic|ObjectCollection $volWorkTechnic the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVolWorkTechnic($volWorkTechnic, ?string $comparison = null)
    {
        if ($volWorkTechnic instanceof \DB\VolWorkTechnic) {
            $this
                ->addUsingAlias(UsersTableMap::COL_ID, $volWorkTechnic->getVersionCreatedBy(), $comparison);

            return $this;
        } elseif ($volWorkTechnic instanceof ObjectCollection) {
            $this
                ->useVolWorkTechnicQuery()
                ->filterByPrimaryKeys($volWorkTechnic->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByVolWorkTechnic() only accepts arguments of type \DB\VolWorkTechnic or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VolWorkTechnic relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVolWorkTechnic(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VolWorkTechnic');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'VolWorkTechnic');
        }

        return $this;
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DB\VolWorkTechnicQuery A secondary query class using the current class as primary query
     */
    public function useVolWorkTechnicQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVolWorkTechnic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VolWorkTechnic', '\DB\VolWorkTechnicQuery');
    }

    /**
     * Use the VolWorkTechnic relation VolWorkTechnic object
     *
     * @param callable(\DB\VolWorkTechnicQuery):\DB\VolWorkTechnicQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVolWorkTechnicQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useVolWorkTechnicQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to VolWorkTechnic table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the EXISTS statement
     */
    public function useVolWorkTechnicExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to VolWorkTechnic table for a NOT EXISTS query.
     *
     * @see useVolWorkTechnicExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DB\VolWorkTechnicQuery The inner query object of the NOT EXISTS statement
     */
    public function useVolWorkTechnicNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('VolWorkTechnic', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param ChildUsers $users Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
