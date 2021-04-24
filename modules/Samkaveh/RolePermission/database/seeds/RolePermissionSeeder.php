<?php

namespace Samkaveh\RolePermission\Database\Seeds;

use Illuminate\Database\Seeder;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\RolePermission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void 
     */
    public function run()
    {
        foreach(Permission::$permissions as $permission)
        {
            Permission::findOrCreate($permission);
        }

        foreach (Role::$roles as $name => $permissions) {
            Role::findOrCreate($name)->givePermissionTo($permissions);
        }


    }
}
