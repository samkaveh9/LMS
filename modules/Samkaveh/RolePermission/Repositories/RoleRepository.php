<?php

namespace Samkaveh\RolePermission\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{

    public static function all()
    {
        return Role::all();
    }

    public static function latest()
    {
        return Role::latest()->get();
    }

    public static function store($request)
    {
        return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
    }

    public static function update($request,$id)
    {
        $role = Role::findOrFail($id);
        return $role->syncPermissions($request->permissions)->update(['name' => $request->name]);
    }

    public static function destory($id)
    {
        return Role::whereId($id)->delete();
    }
}
