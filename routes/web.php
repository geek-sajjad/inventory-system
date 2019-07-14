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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('approval', 'HomeController@approval')->name('approval');


// -------------- Suppliant ~ Simple User --------------
Route::group(['middleware' => ['auth', 'approved', 'roles'], 'roles' => ['admin', 'simple user']], function () {
    Route::get('/suppliant', 'SuppliantController@index')->name('suppliant');

    Route::get('suppliant/orders', 'SuppliantController@orders')->name('suppliant.orders');

    Route::get('suppliant/orders/{order}', 'SuppliantController@order')->name('suppliant.order');

    Route::get('suppliant/order/new', 'SuppliantController@newOrder')->name('suppliant.order.new');
    Route::get('suppliant/products/{category}', 'SuppliantController@productPage')->name('suppliant.products');
    Route::post('suppliant/product/{product}', 'SuppliantController@addProduct')->name('suppliant.addProduct');
    Route::get('suppliant/deleteOrderItem/{orderItem}', 'SuppliantController@deleteOrderItem')->name('suppliant.delete.orderItem');


//    Route::get('/suppliant/new', 'SuppliantController@newOrder')->name('suppliant.newOrder');
//
//    Route::get('/suppliant/new/{product}', 'SuppliantController@productPage')->name('suppliant.orderProduct');
//
//    Route::post('/suppliant/new/{product}', 'SuppliantController@submitOrder')->name('suppliant.submitProduct');
//
//    Route::get('/suppliant/my-orders', 'SuppliantController@allOrders')->name('suppliant.allOrders');

});

// -------------- Stock Manager --------------

Route::group(['middleware' => ['auth', 'approved', 'roles'], 'roles' => ['admin', 'Stock Manager']], function () {
    Route::get('/stock', 'StockController@index')->name('stock');

    Route::get('stock/products', 'StockController@products')->name('stock.products');
    Route::post('stock/products', 'StockController@products')->name('stock.products.new');

    Route::get('stock/product/{product}', 'StockController@editProduct')->name('stock.editPage.product');
    Route::post('stock/product/{product}', 'StockController@editSaveProduct')->name('stock.edit.product');

    Route::get('stock/categories', 'StockController@categories')->name('stock.categories');
    Route::post('stock/categories', 'StockController@newCategory')->name('stock.new.category');

    Route::get('stock/category/{category}', 'StockController@editCategory')->name('stock.editPage.category');
    Route::post('stock/category/{category}', 'StockController@editCategory')->name('stock.edit.category');

    Route::get('stock/orders', 'StockController@orders')->name('stock.orders');
    Route::get('stock/orders/{order}', 'StockController@orderDetail')->name('stock.order.detail');

    Route::get('stock/orders/order/{orderItem}/confirm', 'StockController@confirm')->name('stock.order.confirm');
    Route::get('stock/orders/order/{orderItem}/cancel', 'StockController@cancel')->name('stock.order.cancel');
    Route::post('stock/orders/order/{orderItem}/comment', 'StockController@submitComment')->name('order.submit.comment');

    Route::get('stock/orders/order/{orderItem}/request', 'StockController@requestForBuying')->name('stock.order.request');


//    Route::get('/stock/order/{order}', 'StockController@showOrder')->name('showOrder');
//
//    Route::post('stock/order/{order}', 'StockController@confirm')->name('stock.confirm');
//
//    Route::get('stock/order/{order}/request', 'StockController@requestForBuying')->name('stock.requestForBuying');


    Route::get('products/{category}', 'StockController@product')->name('categories-product');
});


// -------------- Assistant ~ Deputy --------------
Route::group(['middleware' => ['auth', 'approved', 'roles'], 'roles' => ['admin', 'Assistant']], function () {
    Route::get('deputy', 'DeputyController@index')->name('deputy');

    Route::get('deputy/buyingList', 'DeputyController@buyingList')->name('deputy.buyingList');

    Route::get('deputy/buyingList/approve/{buyingList}', 'DeputyController@buyingListApprove')->name('deputy.buyingList.approve');
    Route::get('deputy/buyingList/cancel/{buyingList}', 'DeputyController@buyingListCancel')->name('deputy.buyingList.cancel');


});


// -------------- Logistic --------------
Route::group(['middleware' => ['auth', 'approved', 'roles'], 'roles' => ['admin', 'Logistic']], function () {

    Route::get('/logistic', 'LogisticController@index')->name('logistic.index');

    Route::post('/logistic/bought/{buyingList}', 'LogisticController@bought')->name('logistic.bought');

    Route::get('/logistic/cancel/{buyingList}', 'LogisticController@cancel')->name('logistic.cancel');

});


// -------------- Admin --------------
Route::group(['middleware' => ['auth', 'approved', 'roles'], 'roles' => ['admin']], function () {
    Route::get('admin/users', 'AdminController@users');

    Route::get('admin/users/{user}', 'AdminController@userDetail')->name('userDetail');

    Route::get('admin/users/approve/{user}', 'AdminController@approvingUser')->name('approveUser');
});


// -------------- All Users Profile --------------
Route::get('/profile', 'FileUploadController@index')->middleware('auth');
Route::post('/profile', 'FileUploadController@add')->name('image.upload')->middleware('auth');
Route::get('profile/delete-photo', 'FileUploadController@delete')->name('delete_photo')->middleware('auth');


//Route::get('test', function (Request $request) {
//    dd(auth()->validate($request->token));
//});