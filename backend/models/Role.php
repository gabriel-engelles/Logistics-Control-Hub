<?php

namespace app\models;

use amnah\yii2\user\models\Role as AmnahRole;

class Role extends AmnahRole
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;
    const ROLE_DELIVERY_MAN = 3;

    public static function getValidRoleIds()
    {
        return [self::ROLE_ADMIN, self::ROLE_USER, self::ROLE_DELIVERY_MAN];
    }
}
