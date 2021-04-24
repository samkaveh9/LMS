<?php

use Illuminate\Support\Facades\Route;


Route::group(
    [
        'namespace' => 'Samkaveh\Category\Http\Controllers',
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {

        Route::resource('categories','CategoryController');
    }
);  