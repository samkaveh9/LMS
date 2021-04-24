<?php

namespace Samkaveh\User\Providers;

use DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Samkaveh\User\Database\Seeds\UserSeeder;
use Samkaveh\User\Models\User;
use Samkaveh\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'UserRoutes.php');
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadFactoriesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'factories');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','User');
       
        config()->set('auth.providers.users.model',User::class);
        Gate::policy(User::class, UserPolicy::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class; 
    }
 
    public function boot()
    {
       config()->set('sidebar.items.users',[
        "icon" => "i-users",
        "url" => route('users.index'),
        "title" => "کاربران"
        ]);

    
   
    }
    

}