<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', "HomeController@index");
Route::get('/carrito','ShoppingCartsController@index');
Route::post('/carrito','ShoppingCartsController@checkout');
Route::get('/payments/store','PaymentsController@store');
Route::resource('products','ProductsController');
Route::get('products/image/{nameFile}','ProductsController@image');
Route::resource('in_shopping_carts','InShoppingCartsController',[
  'only'=>['store','destroy']]);
Route::resource('/compras','ShoppingCartsController',[
	'only'=>['show']]);
Route::resource('/orders','OrdersController',['only'=>['index','update']]);
/*
  get/pruducts
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
