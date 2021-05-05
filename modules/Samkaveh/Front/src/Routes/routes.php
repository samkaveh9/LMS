<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Front\Http\Controllers\FrontController;

Route::group(
    [
        'middleware' => ['web']
    ],
    function () {

        Route::get('/',[FrontController::class,'index'])->name('home');
        Route::get('courses/{course}',[FrontController::class,'single'])->name('front.single');
        Route::get('teachers/{teacher}',[FrontController::class,'teacher'])->name('front.teacher'); 
    }
);  