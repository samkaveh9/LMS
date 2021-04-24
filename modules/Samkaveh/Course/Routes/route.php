<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Course\Http\Controllers\CourseController;


Route::group(
    [
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {

        Route::resource('courses',CourseController::class);

        Route::put('courses/{course}/accept',[CourseController::class, 'accept'])->name('courses.accept');
        Route::put('courses/{course}/reject',[CourseController::class, 'reject'])->name('courses.reject');
        Route::put('courses/{course}/lock',[CourseController::class, 'lock'])->name('courses.lock');
    }
);  