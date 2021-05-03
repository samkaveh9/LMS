<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\Category\Models\Category;
use Samkaveh\Course\Models\Episode;
use Samkaveh\RolePermission\Models\Permission;
use Samkaveh\RolePermission\Models\Role;
use Samkaveh\User\Mail\VerifyCodeMail;

Route::get('/', function () {
    return view('index');
})->name('main');

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/test', function () {
    // \Spatie\Permission\Models\Permission::create(['name' => 'manage role_permissions']);
    // auth()->user()->givePermissionTo('');
    // return auth()->user()->permisions;
    // auth()->user()->givePermissionTo(Permission::PERMISSION_TEACH);
    // auth()->user()->permissons;   
    // dd(auth()->user()->permissions); 
    // auth()->user()->assignRole(Role::ROLE_TEACHER);


    
});

