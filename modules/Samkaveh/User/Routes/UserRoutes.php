<?php

use Illuminate\Support\Facades\Route;
use Samkaveh\User\Http\Controllers\UserController;

Route::group(['prefix' => 'panel', 'middleware' => ['web','auth'] ], function() {
  Route::resource('users', UserController::class);
  Route::post('users/{user}/add-role', [UserController::class,'addRole'])->name('users.addRole');
  Route::delete('users/{user}/remove/{role}/role', [UserController::class,'removeRole'])->name('users.removeRole');
  Route::put('users/{user}/manualVerify', [UserController::class,'manualVerify'])->name('users.manualVerify');
  Route::post('users/profilePhoto', [UserController::class,'profilePhoto'])->name('users.profilePhoto');
  Route::get('user/profile', [UserController::class,'profile'])->name('users.profile');
  Route::post('user/profile', [UserController::class,'updateProfile'])->name('users.updateProfile');
});

Route::group([
  'namespace' => 'Samkaveh\User\Http\Controllers\Auth',
  'middleware' => 'web'
], function ($router) {

  // Verification Code
  $router->post('email/verify', 'VerificationController@verify')->name('verification.verify');
  $router->post('email/resend', 'VerificationController@resend')->name('verification.resend');
  $router->get('email/verify', 'VerificationController@show')->name('verification.notice');

  // Login
  $router->get('login', 'LoginController@showLoginForm')->name('login');
  $router->post('login', 'LoginController@login');

  // Logout
  $router->any('logout', 'LoginController@logout')->name('logout');

  //Register
  $router->get('register', 'RegisterController@showRegistrationForm')->name('register');
  $router->post('register', 'RegisterController@register');

  // Reset Password
  $router->get('password/reset', 'ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
  $router->get('password/reset/verify-code/send', 'ForgotPasswordController@sendVerifyCodeEmail')->name('password.sendVerifyCodeEmail');
  $router->post('password/reset/verify-code/check-verify-code', 'ForgotPasswordController@checkVerifyCode')
    ->name('password.checkVerifyCode')
    ->middleware('throttle:5,1');

  $router->get('password/change', 'ResetPasswordController@showResetForm')
    ->name('password.showResetForm')
    ->middleware('auth');

  $router->post('password/change', 'ResetPasswordController@reset')->name('password.update');
});
