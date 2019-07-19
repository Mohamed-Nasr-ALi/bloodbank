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

Route::group(['middleware'=>['auth','auto-check-permission'], 'prefix' => 'admin']
    ,function(){
    Route::get('admin', function () {return view('Admin.main');})->name('admin');
    Route::resource('blood-type','BloodTypesController');
    Route::resource('categories','CategoriesController');
    Route::resource('cities','CitiesController');
    Route::resource('governorates','GovernoratesController');
    Route::resource('posts','PostsController');
    Route::resource('settings','SettingsController');
    Route::resource('roles','RolesController');
    Route::resource('users','UsersController');
    ////////////////////////////////////////////////////////////////
    Route::get('contacts','PagesController@contacts')->name('contacts');
    Route::get('clients','PagesController@clients')->name('clients');
    Route::get('orders','PagesController@orders')->name('orders');
    Route::get('client-update/{id}','PagesController@clientUpdateStatus')->name('clientupdate');
    ////////////////////////////////////////////////////////////////

});

Route::get('/home', 'HomeController@index')->name('home');

