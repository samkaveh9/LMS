<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/home', 'HomeController@index');
