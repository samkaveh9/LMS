<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Course\Http\Controllers\EpisodeController;

/** Episode Routes  */

Route::group(
    [
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {
        Route::get('courses/{course}/episode/create', [EpisodeController::class, 'create'])->name('episodes.create');
        Route::post('courses/{course}/episode', [EpisodeController::class, 'store'])->name('episodes.store');
        Route::get('courses/{course}/episode/{episode}/edit', [EpisodeController::class, 'edit'])->name('episodes.edit');
        Route::put('courses/{course}/episode/{episode}/update', [EpisodeController::class, 'update'])->name('episodes.update');
        Route::delete('courses/{course}/episode/{episode}', [EpisodeController::class, 'destroy'])->name('episodes.destroy');
        Route::put('episode/{episode}/accept', [EpisodeController::class, 'accept'])->name('episodes.accept');
        Route::put('episode/{episode}/reject', [EpisodeController::class, 'reject'])->name('episodes.reject');
        Route::put('episode/{episode}/lock', [EpisodeController::class, 'lock'])->name('episodes.lock');
        Route::put('episode/{episode}/unlock', [EpisodeController::class, 'unlock'])->name('episodes.unlock');
        Route::delete('courses/{course}/episode', [EpisodeController::class, 'destroyMultiple'])->name('episodes.destroyMultiple');
        Route::put('courses/{course}/episodes/accept-all', [EpisodeController::class, 'acceptAll'])->name('episodes.acceptAll');
        Route::put('courses/{course}/episodes/accept-selected', [EpisodeController::class, 'acceptMultiple'])->name('episodes.acceptMultiple');
        Route::put('courses/{course}/episodes/reject-selected', [EpisodeController::class, 'rejectMultiple'])->name('episodes.rejectMultiple');
    }
);  