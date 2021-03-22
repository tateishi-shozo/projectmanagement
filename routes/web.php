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
Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']],function() {
    
    Route::get('user/dialy/create', 'User\DialyController@add');
       Route::post('user/dialy/create','User\DialyController@create');
       Route::get('user/dialy/index', 'User\DialyController@index');
       Route::get('user/dialy/edit', 'User\DialyController@edit');
       Route::post('user/dialy/edit', 'User\DialyController@update');
       Route::get('user/dialy/delete', 'User\DialyController@delete');
       
       Route::get('user/profile/create', 'User\ProfileController@add');
       Route::post('user/profile/create','User\ProfileController@create');
       Route::get('user/profile/','User\ProfileController@index');
       Route::get('user/profile/edit','User\ProfileController@edit');
       Route::post('user/profile/edit','User\ProfileController@update');
    
    Route::group(['middleware' =>['auth','can:user']],function() {
           
           Route::get('user/project/{user}','User\ProjectController@index')->name('user.index');
    });
        // 管理ユーザ用
    Route::group(['middleware' =>['auth','can:admin']],function() {
        
            Route::get('admin/project/create', 'Admin\ProjectController@add');
            Route::post('admin/project/create','Admin\ProjectController@create');
            Route::get('admin/project/index', 'Admin\ProjectController@index');
            Route::get('admin/project/edit','Admin\ProjectController@edit');
            Route::post('admin/project/edit','Admin\ProjectController@update');
            Route::get('admin/project/delete','Admin\ProjectController@delete');
            
            Route::get('admin/project/assign','Admin\ProjectController@assign');
            Route::post('admin/project/assign','Admin\ProjectController@record');
            Route::post('admin/project/adding','Admin\ProjectController@remove');
            
            Route::get('admin/license/index', 'Admin\LicenseController@index');
            Route::post('admin/license/index','Admin\LicenseController@create');
            Route::get('admin/license/delete', 'Admin\LicenseController@delete');
            
            Route::get('admin/fee/index', 'Admin\FeeController@index');
            Route::post('admin/fee/index','Admin\FeeController@create');
            Route::get('admin/fee/delete', 'Admin\FeeController@delete');
            
            Route::get('admin/profile/index', 'Admin\ProfileController@index');
            
    });
});