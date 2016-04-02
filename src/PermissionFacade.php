<?php
/**
 * Created by Hoang Nham.
 * Email: hoangnham01@gmail.com
 */

namespace NhamHV\Permission;


use Illuminate\Support\Facades\Facade;

class PermissionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'NhamHVPermission';
    }
}