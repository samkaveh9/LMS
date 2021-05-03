<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Course\Http\Controllers\CourseController;


/** Course Routes  */

Route::group(
    [
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {

        Route::resource('courses',CourseController::class);

        Route::get('approved/courses',[CourseController::class, 'approvedCourse'])->name('courses.approvedCourse');
        Route::get('unapproved/courses',[CourseController::class, 'unapprovedCourse'])->name('courses.unapprovedCourse');
        Route::put('courses/{course}/accept',[CourseController::class, 'accept'])->name('courses.accept');
        Route::put('courses/{course}/reject',[CourseController::class, 'reject'])->name('courses.reject');
        Route::put('courses/{course}/lock',[CourseController::class, 'lock'])->name('courses.lock');
        Route::get('courses/{course}/detail',[CourseController::class, 'detail'])->name('courses.detail');
    }
);  