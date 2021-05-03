<?php

namespace  Samkaveh\User\Repositories;

use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Models\User;

class UserRepository 
{

    public function paginate()
    {
       return User::latest()->paginate(20);
    }

    public function findByEmail($email)
    {
       return User::query()->where('email',$email)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function updateProfile($request)
    {
        auth()->user()->name = $request->name;
        if (auth()->user()->email != $request->email) {
            auth()->user()->email = $request->email;
            auth()->user()->email_verified_at = null;
        }

        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACH)) {
            auth()->user()->card_number = $request->card_number;
            auth()->user()->shaba = $request->shaba;
            auth()->user()->headline = $request->headline;
            auth()->user()->bio = $request->bio;
            auth()->user()->username = $request->username;
        }

        if ($request->password) {
            auth()->user()->password = bcrypt($request->password);
        }

        auth()->user()->save();
    }


}