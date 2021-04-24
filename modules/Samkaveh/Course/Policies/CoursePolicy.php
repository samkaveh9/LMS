<?php

namespace Samkaveh\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Samkaveh\RolePermission\Models\Permission;

class CoursePolicy
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


    public function view()
    {
        return auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
}
