<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index');
