<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Models\User;

class RolePermissionPolicy
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

    public function HasPermission()
    {
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANGAE_ROLE_PERMISSIONS))
            return  true;
        
         return null;   
    }

}
