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

Route::get('/','WelcomeController@showWelcomePage')->name('name');

Route::get('authorization','Auth\LoginController@authorization')->name('authorization');

Route::get('products/{title}-{id}','ProductController@showProduct')->name('products.show');

Route::get('products/{title}-{id}/purchase','ProductController@purchaseProduct')->name('products.purchase');

Route::get('products/publish','ProductController@showPublishProductForm')->name('products.publish');

Route::post('products/publish','ProductController@publishProductForm');

Route::get('categories/{title}-{id}/products','CategoryController@showProduct')->name('categories.products.show');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/purchases', 'HomeController@showPurchases')->name('purchases');

Route::get('/home/products', 'HomeController@showProducts')->name('products');
