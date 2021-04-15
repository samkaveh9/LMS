<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'namespace' => 'Samkaveh\Dashboard\Http\Controllers',
        'prefix' => 'dashboard',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {

        Route::get('/', 'HomeController@home')->name('dashboard.index');
    }
);
