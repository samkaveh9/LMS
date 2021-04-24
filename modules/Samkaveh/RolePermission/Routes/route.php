<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\RolePermission\Http\Controllers\RolePermissionController;


Route::group(
    [
        'prefix' => 'panel',
        'middleware' => ['web', 'auth', 'verified']
    ],
    function () {
        Route::resource('role-permissions',RolePermissionController::class)->middleware('permission:manage role_permissions');
    }
);  