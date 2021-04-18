<?php

namespace Samkaveh\RolePermission\Repositories;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{

    public static function all()
    {
        return Permission::all();
    }

    public static function latest()
    {
        return Permission::latest()->get();
    }

    public static function store($values)
    {
        return Permission::create($values->only('title', 'parent_id'));
    }

    public static function update($item, $values)
    {
        return $item->update($values->only('title', 'parent_id'));
    }

    public static function destory($item)
    {
        return $item->delete();
    }
}
