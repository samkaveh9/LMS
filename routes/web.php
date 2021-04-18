<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\User\Mail\VerifyCodeMail;

Route::get('/', function () {
    return view('index');
})->name('main');

Route::get('/test', function () {
    // \Spatie\Permission\Models\Permission::create(['name' => 'manage categories']);
    // auth()->user()->givePermissionTo('manage categories');
    // return auth()->user()->permisions;
    auth()->user()->givePermissionTo('manage categories');
    auth()->user()->permissons;
});

