<?php

namespace Samkaveh\RolePermission\Providers;

use Illuminate\Support\ServiceProvider;

class RolePermissionServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'route.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','RolePermission');
        $this->loadJsonTranslationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'lang');
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