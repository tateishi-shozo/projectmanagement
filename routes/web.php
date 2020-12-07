<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('verified')->group(function() {
    // 一般ユーザ用
    Route::prefix('user')->group(function(){
        
    });
    // 管理ユーザ用
    Route::prefix('admin')->middleware('can:admin')->group(function(){
        Route::get('project/create', 'Admin\ProjectController@add');
    });
});
