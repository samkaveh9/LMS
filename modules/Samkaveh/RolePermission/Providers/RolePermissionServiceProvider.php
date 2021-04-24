<?php

namespace Samkaveh\RolePermission\Providers;

use DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Samkaveh\RolePermission\Database\Seeds\RolePermissionSeeder;
use Samkaveh\RolePermission\Models\Permission;

class RolePermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'route.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','RolePermission');
        $this->loadJsonTranslationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'lang');
       
        DatabaseSeeder::$seeders[] = RolePermissionSeeder::class;
        Gate::before(function ($user){
            return $user->hasPermissionTo(Permission::PERMISSION_ADMIN) ? true : null;
        });
    }



    public function boot()
    {
        config()->set('sidebar.items.role-permissions',[
            "icon" => "i-role-permissions",
            "url" => route('role-permissions.index'),
            "title" => "نقش های کاربری"
        ]);
    }



}