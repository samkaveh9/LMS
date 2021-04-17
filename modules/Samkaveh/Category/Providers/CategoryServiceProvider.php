<?php

namespace Samkaveh\Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'database'.DIRECTORY_SEPARATOR.'migrations');
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'route.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Category');
    }



    public function boot()
    {
        config()->set('sidebar.items.categories',[
            "icon" => "i-categories",
            "url" => route('categories.index'),
            "title" => "دسته بندی ها"
        ]);
        
    }



}