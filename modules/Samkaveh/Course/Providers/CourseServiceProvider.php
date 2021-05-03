<?php

namespace Samkaveh\Course\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Policies\CoursePolicy;
use Samkaveh\RolePermission\Models\Permission;

class CourseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routes.php');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'season_routes.php');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'episode_routes.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Course');
        $this->loadJsonTranslationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'lang');   
        Gate::policy(Course::class, CoursePolicy::class);
        // Gate::before(function($user) {
        //     dd($user->permissions);
        //     return $user->hasPermissionTo(Permission::PERMISSION_ADMIN) ? true : null;
        // });
    }

    public function boot()
    {
        config()->set('sidebar.items.courses',[
            "icon" => "i-courses",
            "url" => route('courses.index'),
            "title" => "دورها",
            "permission" => [
                Permission::PERMISSION_MANAGE_COURSES,
                Permission::PERMISSION_MANAGE_OWN_COURSES
                ]
        ]);
        
    }
}