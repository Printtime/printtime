<?php

Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'CatalogController@index');

	Route::resource('catalog', 'CatalogController', ['only' => ['show']]);
	Route::get('portfolio', 'CatalogController@portfolio')->name('catalog.portfolio');

	Route::resource('page', 'PageController', ['only' => ['show']]);
	Route::resource('post', 'PostController', ['only' => ['index', 'show']]);

	Route::resource('catalog.product', 'ProductController', ['only' => ['show']]);

	Route::get('product/{product}/order', 'ProductController@order')->name('product.order');
	Route::post('product/{product}/orderSend', 'ProductController@orderSend')->name('product.orderSend');
    
	});


Route::group(['middleware' => ['api']], function () {
	Route::post('user/pay/api', 'PayController@api');

		Route::post('/user/pay/redirect', [
		'uses'=>'PayController@redirect',
		'as'=> 'pay.redirect',
		]);

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
	});

Route::group(['middleware' => ['web', 'roles']], function () {

	
	Route::get('printfile/upload', [
		'uses'=>'PrintFileController@form',
		'as'=> 'printfile.form',
		'roles'=> ['admin', 'user'],
		]);

	Route::post('printfile/upload', [
		'uses'=>'PrintFileController@upload',
		'as'=> 'printfile.upload',
		'roles'=> ['admin', 'user'],
		]);

	Route::get('/user', [
		'uses'=>'UserController@index',
		'as'=> 'user.index',
		'roles'=> ['admin', 'user'],
		]);

	Route::post('user/profile', [
		'uses'=>'UserController@profileUpdate',
		'as'=> 'user.profileUpdate',
		'roles'=> ['admin', 'user'],
		]);

	Route::get('user/profile', [
		'uses'=>'UserController@profile',
		'as'=> 'user.profile',
		'roles'=> ['admin', 'user'],
		]);

	Route::get('/user/transfer', [
		'uses'=>'UserController@transfer',
		'as'=> 'user.transfer',
		'roles'=> ['admin', 'user'],
		]);
	
	//Order
	Route::get('order', [
		'uses'=>'OrderController@index',
		'as'=> 'order.index',
		'roles'=> ['admin', 'user'],
		]);
	Route::get('order/create/{id}', [
		'uses'=>'OrderController@create',
		'as'=> 'order.create',
		'roles'=> ['admin', 'user'],
		]);
	Route::post('order/create/{id}', [
		'uses'=>'OrderController@save',
		'as'=> 'order.save',
		'roles'=> ['admin', 'user'],
		]);

	/*LiqPay Route*/
	Route::post('/user/pay/create', [
		'uses'=>'PayController@create',
		'as'=> 'pay.create',
		'roles'=> ['admin', 'user'],
		]);
	Route::get('/user/pay/product_url', [
		'uses'=>'PayController@product_url',
		'as'=> 'pay.product_url',
		'roles'=> ['admin', 'user'],
		]);
	Route::get('/user/pay/result_url', [
		'uses'=>'PayController@result_url',
		'as'=> 'pay.result_url',
		'roles'=> ['admin', 'user'],
		]);



	Route::get('pays', [
		'uses'=>'PayController@index',
		'as'=> 'pays',
		'roles'=> ['admin', 'user'],
		]);	

	Route::get('products', [
		'uses'=>'ProductController@products',
		'as'=> 'products',
		'roles'=> ['admin', 'user'],
		]);	

	Route::get('products/{product}', [
		'uses'=>'ProductController@product',
		'as'=> 'products.product',
		'roles'=> ['admin', 'user'],
		]);	
});
