<?php

namespace Samkaveh\RolePermission\Models;

use Spatie\Permission\Models\Role as ModelsRole;
use Samkaveh\RolePermission\Models\Permission;

class Role extends ModelsRole
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_TEACHER = 'teacher';
    const ROLE_STUDENT = 'student';


    public static $roles = [
        self::ROLE_ADMIN => [
            Permission::PERMISSION_ADMIN
        ],
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ],
        self::ROLE_USER => [
            Permission::PERMISSION_USER
        ],
    ];

}
