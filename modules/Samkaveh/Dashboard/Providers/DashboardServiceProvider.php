<?php

namespace Samkaveh\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{

    public function register()
    {

    }



    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Routes'.DIRECTORY_SEPARATOR.'routes.php');
        $this->loadViewsFrom(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'Views','Dashboard');
      
    }



}