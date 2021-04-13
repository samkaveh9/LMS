<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('index');
})->name('main');


Route::get('/home', 'HomeController@index')->name('home');
