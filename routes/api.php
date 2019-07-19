<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1','namespace'=>'Api'],function (){

    //============================register============================//
    Route::post('register','AuthController@register');
    //============================login============================//
    Route::post('login','AuthController@login');
    //============================reset password============================//
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('new-password', 'AuthController@newPassword');


    //=======================list of governorates===============================//
    Route::get('governorates','MainController@governorates');
    //==========================list of cities==============================//
    Route::get('cities','MainController@cities');
    //========================settings===============================//
    Route::get('settings','Maincontroller@settings');


    Route::group(['middleware'=>'auth:api'],function (){

        //============================edit-profile============================//
        Route::post('edit-profile','AuthController@profile');
        //============================profile============================//
        Route::get('profile','AuthController@profileById');





        //========================posts===============================//
        //========================list of all Categories =======================//
        Route::get('categories','Maincontroller@categories');
        //==========================getPost============================//
        Route::post('get-posts','Maincontroller@getPosts');
        //========================all posts===============================//
        Route::get('posts','Maincontroller@posts');
        //========================specific post===============================//
        Route::get('post/{id}','Maincontroller@post');



        //=========================fav posts for client=============================//
        //==========================make post fiv or not====================//
        Route::post('clientfavPost','Maincontroller@clientfavPost');
        //==========================all fav posts for client====================//
        Route::post('list-of-favourites','Maincontroller@listOfFavourites');

        //============================contactUs============================//
        Route::post('contact-us','MainController@contactUS');

        //==========================list of blood types===========================//
        Route::get('blood-types','Maincontroller@bloodTypes');


        //==========================registerToken===========================//
        Route::post('register-token','AuthController@registerToken');
        //==========================removeToken===========================//
        Route::post('remove-token','AuthController@removeToken');
        //==========================notificationSettings===========================//
        Route::post('notification-settings','AuthController@notificationSettings');

        //==========================createOrderRequest===========================//
        Route::post('create-order-request','MainController@createOrderRequest');
        //==========================notifications===========================//
        Route::post('notifications','MainController@notifications');
        //============================notificationsCount=====================//
        Route::post('notifications-count','MainController@notificationsCount');
        //============================updateNotification=====================//
        Route::post('update_notifications','MainController@updateNotification');


        //==========================allOrdersBySpecific===========================//
        Route::post('all-orders-by-specific','MainController@allOrdersBySpecific');
        //==========================specific-order===========================//
        Route::get('order/{id}','MainController@specificOrder');
    });
});
