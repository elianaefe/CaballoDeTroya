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

#Route::get('/', function () {
#    return view('welcome');
#});

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//********************************************************************************************************
//vista de un producto
Route::get('/products/{id}', 'ProductController@show');

//********************************************************************************************************
//vista carrito de compras
Route::post('/cart', 'CartDetailController@store');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

//********************************************************************************************************
//grupo de rutas de admin con middleware
Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
	//productos
	Route::get('/products', 'ProductController@index'); //listado de productos
	Route::get('/products/create', 'ProductController@create'); //crear producto
	Route::post('/products', 'ProductController@store');

	Route::get('/products/{id}/edit', 'ProductController@edit'); //edicion
	Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar

	//Route::post('admin/products/{id}/delete', 'ProductController@destroy'); //form de eleminacion
	Route::delete('/products/{id}', 'ProductController@destroy'); //form de eliminacion

	Route::get('/products/{id}/images', 'ImageController@index'); //listado de imagenes
	Route::post('/products/{id}/images', 'ImageController@store');
	Route::delete('/products/{id}/images', 'ImageController@destroy');
	
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //listado de imagenes

});
