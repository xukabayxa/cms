<?php
namespace Modules\User\Entities\Helper;

class UserHelper
{
    public static function hasPermission($permissions)
    {
        if (auth('web')->hasPermissionTo($permissions)) {
           return true;
        }

        return false;
    }
}
