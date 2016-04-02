<?php
/**
 * Created by Hoang Nham.
 * Email: hoangnham01@gmail.com
 */

namespace NhamHV\Permission;


interface PermissionInterface
{

    /**
     * @param $groupId
     * @param array | string $currentPermissions
     * @return mixed
     */
    public function setData($groupId, $currentPermissions = array());

    /**
     * @param string|array $name
     * @return boolean
     */
    public function checkRole($name);

    /**
     * @param string|array $route
     * @return boolean
     */
    public function checkRoute($route);

    /**
     * @param string|array $route
     * @return mixed
     */
    public function hasRoute($route);

    /**
     * @param string|array $name
     * @return mixed
     */
    public function hasRole($name);
}