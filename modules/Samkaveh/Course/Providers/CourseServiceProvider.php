<?php

namespace Samkaveh\Course\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Policies\CoursePolicy;

class CourseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'route.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Course');
        $this->loadJsonTranslationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'lang');   
        Gate::policy(Course::class, CoursePolicy::class);
    }

    public function boot()
    {
        config()->set('sidebar.items.courses',[
            "icon" => "i-courses",
            "url" => route('courses.index'),
            "title" => "دورها"
        ]);
        
    }
}