<?php

namespace Samkaveh\RolePermission\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    const PERMISSION_ADMIN = 'admin';
    const PERMISSION_MANGAE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_MANAGE_CATEGORIES = 'manage categories';
    const PERMISSION_MANAGE_COURSES = 'manage courses';
    const PERMISSION_MANAGE_USERS = 'manage users';
    const PERMISSION_TEACH = 'teach';


    public static $permissions = [
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANGAE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_COURSES,
    ];

}
