<?php

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'visitors'], function() {
	Route::get('/register', 'RegisterController@register');
	Route::post('/register', 'RegisterController@postRegister')->name('register');
	Route::get('/login', 'LoginController@login');
	Route::post('/login', 'LoginController@postLogin')->name('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logout', 'LoginController@logout')->name('logout');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');
Route::get('/forgot-password', 'ForgotPasswordController@forgotPassword')->name('forgot-password');
Route::post('/forgot-password', 'ForgotPasswordController@postForgotPassword');
Route::get('/reset/{email}/{resetCode}', 'ForgotPasswordController@resetPassword');
Route::post('/reset/{email}/{resetCode}', 'ForgotPasswordController@postResetPassword')->name('update-password');

