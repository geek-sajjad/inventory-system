<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
//oller@index');| routes are loaded by the RouteServiceProvider within a group which
////| is assigned the "api" middleware group. Enjoy building your API!
////|
////*/
////
////Route::middleware('auth:api')->get('/user', function (Request $request) {
////    return $request->user();
////});
////
//////Route::group(['prefix' => 'auth'], function () {
//////    Route::post('register','AuthController@signUp');
//////    Route::post('login', 'AuthController@login');
//////    Route::post('signup', 'AuthController@signup');
//////
//////    Route::group(['middleware' => 'auth:api'], function () {
//////        Route::get('logout', 'AuthController@logout');
//////        Route::get('user', 'AuthController@user');
//////    });
//////});
////
////
////Route::get('categories', 'api\CategoriesContr
///


Route::group([

    //'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'api\AuthController@login');
    Route::post('register', 'api\AuthController@register');
    Route::post('logout', 'api\AuthController@logout');
//    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'api\AuthController@me');

});


Route::get('/categories', 'api\CategoriesController@index');
Route::get('/orders', 'api\OrdersController@index');
Route::post('/orders/create', 'api\OrdersController@create');

Route::get('/profile', 'api\UserProfileImage@getImage');
Route::post('/profile/upload', 'api\UserProfileImage@uploadImage');
