<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Course\Http\Controllers\SeasonController;


/** Season Routes  */

Route::group(
    [
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {
        
        Route::post('seasons/{course}',[SeasonController::class, 'store'])->name('seasons.store');
        Route::get('seasons/{season}/edit',[SeasonController::class, 'edit'])->name('seasons.edit');
        Route::put('seasons/{season}',[SeasonController::class, 'update'])->name('seasons.update');
        Route::delete('seasons/{season}',[SeasonController::class, 'destroy'])->name('seasons.destroy');
        Route::put('seasons/{season}/reject',[SeasonController::class, 'reject'])->name('seasons.reject');
        Route::put('seasons/{season}/accept',[SeasonController::class, 'accept'])->name('seasons.accept');
        Route::put('seasons/{season}/lock',[SeasonController::class, 'lock'])->name('seasons.lock');
        Route::put('seasons/{season}/unlock',[SeasonController::class, 'unlock'])->name('seasons.unlock');
        Route::get('seasons/{course}/detail',[SeasonController::class, 'detail'])->name('seasons.detail');
    }
);  