<?php

namespace Samkaveh\Front\Providers;


use Illuminate\Support\ServiceProvider;
use Samkaveh\Category\Repository\CategoryRepository;
use Samkaveh\Course\Repository\CourseRepository;

class FrontServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routes.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Front');
        
        view()->composer('Front::layouts.header', function($view) {
            $categories = resolve(CategoryRepository::class)->treeGruph();
            $view->with(compact('categories'));
        });

        view()->composer('Front::layouts.latestCourses', function($view) {
            $latestCourses = resolve(CourseRepository::class)->latest();
            $view->with(compact('latestCourses'));
        });

    }

}