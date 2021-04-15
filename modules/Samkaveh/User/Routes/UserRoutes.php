<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group([
  'namespace' => 'Samkaveh\User\Http\Controllers\Auth',
  'middleware' => 'web'
], function ($router) {

  // Verification Code
  Route::post('email/verify', 'VerificationController@verify')->name('verification.verify');
  Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
  Route::get('email/verify', 'VerificationController@show')->name('verification.notice');

  // Login
  Route::get('login', 'LoginController@showLoginForm')->name('login');
  Route::post('login', 'LoginController@login');

  // Logout
  Route::post('logout', 'LoginController@logout')->name('logout');

  //Register
  Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'RegisterController@register');

  // Reset Password
  Route::get('password/reset', 'ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
  Route::get('password/reset/verify-code/send', 'ForgotPasswordController@sendVerifyCodeEmail')->name('password.sendVerifyCodeEmail');
  Route::post('password/reset/verify-code/check-verify-code', 'ForgotPasswordController@checkVerifyCode')
    ->name('password.checkVerifyCode')
    ->middleware('throttle:5,1');

  Route::get('password/change', 'ResetPasswordController@showResetForm')
    ->name('password.showResetForm')
    ->middleware('auth');

  Route::post('password/change', 'ResetPasswordController@reset')->name('password.update');
});
