<?php

namespace Samkaveh\User\Providers;

use DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\User\Database\Seeds\UserSeeder;
use Samkaveh\User\Http\Middleware\StoreUserIP;
use Samkaveh\User\Models\User;
use Samkaveh\User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Routes' . DIRECTORY_SEPARATOR . 'UserRoutes.php');
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations');
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'Views', 'User');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIP::class);

        Factory::guessFactoryNamesUsing(function(string $modelName){
            return 'Samkaveh\User\Database\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('auth.providers.users.model', User::class);
        Gate::policy(User::class, UserPolicy::class);
        DatabaseSeeder::$seeders[] = UserSeeder::class;
    }

    public function boot()
    {
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "url" => route('users.index'),
            "title" => "کاربران",
            "permission" => Permission::PERMISSION_MANAGE_USERS
        ]);

        $this->app->booted(function (){
            config()->set('sidebar.items.user__inforamtion', [
                "icon" => "i-user__inforamtion",
                "url" => route('users.profile'),
                "title" => "اطلاعات کاربری"
            ]);
        });
        
    }
}
