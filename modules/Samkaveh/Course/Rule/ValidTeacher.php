<?php

namespace Samkaveh\Course\Rule;

use Illuminate\Contracts\Validation\Rule;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Repositories\UserRepository;

class ValidTeacher implements Rule
{

    public function passes($attribute, $value)
    {
       $user = resolve(UserRepository::class)->findById($value);
       return $user->hasPermissionTo(Permission::PERMISSION_TEACH);
    }

    public function message()
    {
        return "کاربر انتخاب شده یک مدرس معتبر نیست.";
    }
 
}

