<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\User\Mail\VerifyCodeMail;

Route::get('/', function () {
    return view('index');
})->name('main');


Route::get('/home', 'HomeController@index')->name('home');
