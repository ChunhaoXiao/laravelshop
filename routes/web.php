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

Route::get('/', 'IndexController@index');
Route::get('category/{category}', 'ProductController@index')->name('product.list');
Route::get('product/{product}', 'ProductController@show')->name('product.show');
Route::post('addcart', 'CartController@store')->name('cart.add');
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('deletecart/{cart}', 'CartController@destroy')->name('cart.destroy');
Route::get('search', 'ProductController@search')->name('product.search');

Route::get('auth/weixin', 'Auth\WeixinController@redirectToProvider');
Route::get('auth/weixin/callback', 'Auth\WeixinController@handleProviderCallback');


Route::group(['prefix'=>'user','namespace'=>'User'], function(){
	Route::get('/', 'UserController@index') ;
	Route::get('setting', 'UserController@setting');
	Route::put('update', 'UserController@update')->name('user.update');
	Route::get('password','UserController@changePassword')->name('password.change');
	Route::put('password', 'UserController@savePass')->name('password.save');
	//Route::resource('users', 'UserController', ['only'=>['index', 'edit', 'update']]);
	Route::resource('address', 'AddressController');
	Route::get('favorite', 'FavoriteController@index')->name('user.favorite');
	Route::post('removefavorite/{product}','FavoriteController@remove')->name('favorite.remove');
	Route::post('addfavorite/{product}','FavoriteController@addFavorite')->name('favorite.add') ;
	Route::resource('orders','OrderController') ;
	Route::post('addcomment', 'CommentController@store')->name('comment.add');
	Route::get('foot', 'UserController@footprint')->name('user.footprint');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'],function(){
	
	Route::get('login', 'LoginController@showLoginForm')->name('admin.showloginform') ;
	Route::post('admin/login', 'LoginController@login')->name('admin.login');
	Route::get('index', 'AdminController@index')->name('admin.index');
	Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');
	Route::resource('categories', 'CategoryController');
	Route::resource('attributes','AttributeController');
	Route::any('upload', 'ProductController@upload')->name('image.upload');
	Route::get('getattribute', 'ProductController@getAttribute')->name('attribute.get');
	Route::resource('products', 'ProductController');
	Route::get('order', 'OrderController@index')->name('order.manage');
	Route::get('order/{order}', 'OrderController@show')->name('order.show');
	Route::put('order/{order}','OrderController@update')->name('order.update');
	Route::resource('users', 'UserController');
	Route::resource('systems', 'SystemController');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
