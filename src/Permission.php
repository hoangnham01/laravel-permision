<?php
/**
 * Created by Hoang Nham.
 * Email: hoangnham01@gmail.com
 */

namespace NhamHV\Permission;


class Permission implements PermissionInterface
{
    private $allPermission, $allRoter;

    public function __construct()
    {
        $config = config('permissions');
        echo '<pre>';
        print_r($config);
    }

    public function hello(){

    }

}