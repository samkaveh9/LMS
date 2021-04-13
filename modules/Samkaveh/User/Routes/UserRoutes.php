<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Samkaveh\User\Http\Controllers',
    'middleware' => 'web'
],function($router){
 
Auth::routes(['verify' => true]);
    


});