<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Media\Http\Controllers\MediaController;

Route::group(
    [
        'middleware' => ['web']
    ],
    function () {

        Route::get('/media/{media}/download',[MediaController::class,'download'])->name('media.download');        
    }
);  