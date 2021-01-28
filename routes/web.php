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

Route::middleware('auth')->group(function() {
    // 一般ユーザ用
    Route::prefix('user')->group(function(){
       Route::get('dialy/create', 'User\DialyController@add');
       Route::post('dialy/create','User\DialyController@create');
       Route::get('dialy/index', 'User\DialyController@index');
       Route::get('dialy/edit', 'User\DialyController@edit');
       Route::post('dialy/edit', 'User\DialyController@update');
       Route::get('dialy/delete', 'User\DialyController@delete');
       
       Route::get('profile/create', 'User\ProfileController@add');
       Route::post('profile/create','User\ProfileController@create');
       Route::get('profile/','User\ProfileController@index');
       Route::get('profile/edit','User\ProfileController@edit');
       Route::post('profile/edit','User\ProfileController@update');
       
    });
    // 管理ユーザ用
    Route::prefix('admin')->middleware('can:admin')->group(function(){
        Route::get('project/create', 'Admin\ProjectController@add');
        Route::post('project/create','Admin\ProjectController@create');
        Route::get('project/index', 'Admin\ProjectController@index');
        Route::get('project/edit','Admin\ProjectController@edit');
        Route::post('project/edit','Admin\ProjectController@update');
        Route::get('project/delete','Admin\ProjectController@delete');
        
        Route::get('license/index', 'Admin\LicenseController@index');
        Route::post('license/index','Admin\LicenseController@create');
        Route::get('license/delete', 'Admin\LicenseController@delete');
        
        Route::get('fee/index', 'Admin\FeeController@index');
        Route::post('fee/index','Admin\FeeController@create');
        Route::get('fee/delete', 'Admin\FeeController@delete');
        
        Route::get('profile/index', 'Admin\ProfileController@index');
    });
});
