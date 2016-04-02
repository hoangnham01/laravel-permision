<?php
/**
 * Created by Hoang Nham.
 * Email: hoangnham01@gmail.com
 */

namespace NhamHV\Permission;
use Log;

class Permission implements PermissionInterface
{
    /**
     * @var array All roles
     */
    private $allRoles = array();
    /**
     * @var array all routers
     */
    private $allRouters = array();

    private $currentRoles;

    public function __construct()
    {
        $config = config('permissions.groups');
        if (is_array($config)) {
            foreach ($config as $group => $routers) {
                foreach ($routers as $key => $val) {
                    array_push($this->allRoles, $group . '.' . $key);
                    foreach ($val as $item) {
                        if (isset($this->allRouters[$item])) {
                            array_push($this->allRouters[$item], $group . '.' . $key);
                        } else {
                            $this->allRouters[$item] = [$group . '.' . $key];
                        }
                    }
                }
            }
        };
    }

    /**
     * @param $groupId
     * @param array | string $currentPermissions
     * @return mixed
     */
    public function setData($groupId, $currentPermissions = array())
    {
        if (is_array($this->currentRoles)) {
            return;
        }
        $currentPermissions = is_array($currentPermissions) ? $currentPermissions : json_decode($currentPermissions, true);
        $currentPermissions = is_array($currentPermissions) ? $currentPermissions : [];
        $group = config('permissions.config.model');
        $group = new $group;
        $group = $group->find($groupId);
        $permission = isset($group->permissions) ? json_decode($group->permissions, true) : [];
        $permission = is_array($permission) ? $permission : [];
        $this->currentRoles = array_merge($permission, $currentPermissions);
    }

    /**
     * @param array|string $name
     * @return boolean
     */
    public function checkRole($name)
    {
        $check = false;
        if (is_array($this->currentRoles)) {
            if (is_array($name)) {
                foreach ($name as $item) {
                    $check = $check || $this->checkRole($item);
                }
            } else {
                $check = !isset($this->currentRoles[$name]) || (isset($this->currentRoles[$name]) && $this->currentRoles[$name] == 1);
            }
        } else {
            Log::error('Laravel permission: data not set');
        }
        return $check;
    }

    /**
     * @param array|string $route
     * @return boolean
     */
    public function checkRoute($route)
    {
        $check = false;
        if (is_array($this->currentRoles)) {
            if (is_array($route)) {
                foreach ($route as $item) {
                    $check = $check || $this->checkRoute($item);
                }
            } else {
                if (isset($this->allRouters[$route])) {
                    foreach ($this->allRouters[$route] as $item) {
                        $check = $check || $this->currentRoles[$item] == 1;
                    }
                } else {
                    $check = true;
                }
            }
        } else {
            Log::error('Laravel permission: data not set');
        }
        return $check;
    }

    /**
     * @param array|string $name
     * @return mixed
     */
    public function hasRole($name)
    {
        if (!$this->checkRole($name)) {
            abort(403);
        }
    }

    /**
     * @param array|string $route
     * @return mixed
     */
    public function hasRoute($route)
    {
        if (!$this->checkRoute($route)) {
            abort(403);
        }
    }

}