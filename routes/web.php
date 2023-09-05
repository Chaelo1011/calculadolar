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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/registrar-negocio', 'BusinessController@create')->name('business.create');
Route::post('/guardar-negocio', 'BusinessController@save')->name('business.save');

Route::group(['middleware' => 'hasBusiness'], function () {
    #Productos
    Route::get('/productos', 'ProductsController@index')->name('products.index');
    Route::get('/productos/get', 'ProductsController@getAll')->name('products.all');
    Route::get('/productos/registrar', 'ProductsController@create')->name('products.create');
    Route::post('/productos/guardar', 'ProductsController@save')->name('products.save');
    Route::get('/productos/ver/{id}', 'ProductsController@show')->name('products.show');
    Route::get('/productos/editar/{id}', 'ProductsController@edit')->name('products.edit');
    Route::put('/productos/actualizar/{id}', 'ProductsController@update')->name('products.update');
    Route::get('productos/catalogo/{filename}', 'ProductsController@getCatalogImage')->name('products.image');
    Route::delete('/productos/eliminar/{id}', 'ProductsController@delete')->name('products.delete');

    #Ventas
    Route::get('/ventas', 'InvoiceController@index')->name('invoice.index');

    #Clientes
    Route::get('/clientes', 'CustomersController@index')->name('customers.index');
    Route::get('/clientes/get', 'CustomersController@getAll')->name('customers.all');
    Route::get('/clientes/registrar', 'CustomersController@create')->name('customers.create');
    Route::post('/clientes/guardar', 'CustomersController@store')->name('customers.store');
    Route::get('/clientes/ver/{id}', 'CustomersController@show')->name('customers.show');
    Route::get('/clientes/editar/{id}', 'CustomersController@edit')->name('customers.edit');
    Route::put('/clientes/actualizar/{id}', 'CustomersController@update')->name('customers.update');
    Route::delete('/clientes/eliminar/{id}', 'CustomersController@destroy')->name('customers.delete');

    #Negocio
    Route::post('/registrar-tasa-dia', 'DollarUserController@save')->name('dollarUser.save');
    
    Route::get('/editar-negocio/{id}', 'BusinessController@edit')->name('business.edit');
    Route::put('/actualizar-negocio/{id}', 'BusinessController@update')->name('business.update');
    Route::get('/negocio/logo/{filename}', 'BusinessController@getLogo')->name('business.logo');
    
});

