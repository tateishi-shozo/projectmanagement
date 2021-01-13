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
//第一引数は文字列（URL)　第二引数はコールバック関数→①コントローラーで定義　②直接ここで定義（クロージャ）
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

//Route::middleware('verified')->group(function() {
Route::middleware('auth')->group(function() {
    // 一般ユーザ用
    Route::prefix('user')->group(function(){
        
    });
    // 管理ユーザ用
    Route::prefix('admin')->middleware('can:admin')->group(function(){
        Route::get('project/create', 'Admin\ProjectController@add');
        Route::post('project/create','Admin\ProjectController@create');
        
        Route::get('license/index', 'Admin\LicenseController@index');
        Route::post('license/index','Admin\LicenseController@create');
        Route::get('license/delete', 'Admin\LicenseController@delete');
    });
});
