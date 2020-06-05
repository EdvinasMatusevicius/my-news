<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','homeController')->name('index');

Auth::routes(['verify'=>true]);

Route::middleware('verified')->group(function(){
    Route::get('account', 'AccountController@index')->name('account.index');
    Route::get('account/edit','AccountController@edit')->name('account.edit');
    Route::put('account/update','AccountController@update')->name('account.update');

});


//-------------------------------------
//ADMIN SIDE ROUTES
//-------------------------------------
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->group(function(){
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login.post');
        Route::post('logout','LoginController@logout')->name('logout');
        Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')
        ->name('password.request');
        Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');

        Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset','ResetPasswordController@reset')
        ->name('password.update');
    });

    Route::middleware('auth:admin')->group(function(){
        Route::get('/','AdminHomeController')->name('home');

        Route::resource('employee', 'EmployeeController');
        Route::resource('article', 'ArticleController');
    });
});
