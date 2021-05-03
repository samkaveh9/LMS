<?php

namespace Samkaveh\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function manageRole($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }
    }


    public function userProfile()
    {
        return auth()->check() ? true : false;
    }

}
