<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'namespace' => 'Samkaveh\Category\Http\Controllers',
        'prefix' => 'dashboard',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {

        Route::resource('categories','CategoryController');
    }
);  