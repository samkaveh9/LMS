<?php

namespace Samkaveh\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routes.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Dashboard');
        $this->mergeConfigFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'sidebar.php','sidebar');
    }



    public function boot()
    {
        $this->app->booted(function (){
            config()->set('sidebar.items.dashboard',[
                "icon" => "i-dashboard",
                "url" => route('dashboard'),
                "title" => "پیشخوان"
            ]);
        });
    }



}