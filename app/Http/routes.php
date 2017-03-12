<?php


Route::group(['middleware' => 'web'], function () {

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('home'));
});

Breadcrumbs::register('printers', function($breadcrumbs)
{
    $breadcrumbs->push('Оборудование', route('page.show', 3));
});

	Route::get('/', 'CatalogController@index')->name('home');

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

	Route::get('cleaner', [
		'uses'=>'Controller@cleaner',
		'as'=> 'system.cleaner',
		]);
	
	Route::get('tiff/{filename?}', [
		'uses'=>'Controller@tiff',
		'as'=> 'system.tiff',
		]);

	Route::get('tiff/tiff2jpg/{filename}', [
		'uses'=>'Controller@tiff2jpg',
		'as'=> 'system.tiff2jpg',
		]);

		Route::get('/user/pay/redirect', [
		'uses'=>'PayController@redirect',
		'as'=> 'pay.redirect',
		]);

	Route::get('novaposhta/{name}/{properties}', [
		'uses'=>'DeliveryController@novaposhta',
		'as'=> 'system.novaposhta',
		]);

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
	});

Route::group(['middleware' => ['web', 'roles']], function () {


//All Management
Route::group(['prefix' => 'management'], function () {


//Manager Start
	Route::group(['prefix' => 'manager'], function () {

		Route::get('/', [
			'uses'=>'ManagerController@index',
			'as'=> 'manager.index',
			'roles'=> ['admin', 'manager'],
			]);

		Route::get('orders', [
			'uses'=>'ManagerController@orders',
			'as'=> 'manager.orders',
			'roles'=> ['admin', 'manager'],
			]);

		Route::get('users', [
			'uses'=>'ManagerController@users',
			'as'=> 'manager.users',
			'roles'=> ['admin', 'manager'],
			]);

		Route::get('users/edit', [
			'uses'=>'ManagerController@edit',
			'as'=> 'manager.users.edit',
			'roles'=> ['admin', 'manager'],
			]);

		Route::post('users/edit', [
			'uses'=>'ManagerController@edit_update',
			'as'=> 'manager.users.edit_update',
			'roles'=> ['admin', 'manager'],
			]);

		Route::get('pays', [
			'uses'=>'ManagerController@pays',
			'as'=> 'manager.pays',
			'roles'=> ['admin', 'manager'],
			]);

		Route::get('users/pay', [
			'uses'=>'ManagerController@pay_form',
			'as'=> 'manager.pay.create',
			'roles'=> ['admin', 'manager'],
			]);

		Route::post('users/pay', [
			'uses'=>'ManagerController@pay_create',
			'as'=> 'manager.pay.create',
			'roles'=> ['admin', 'manager'],
			]);


	});
//Manager End


//Designer Start
	Route::get('designer/{status?}', [
		'uses'=>'DesignerController@index',
		'as'=> 'designer.index',
		'roles'=> ['admin', 'designer'],
		]);
	Route::get('designer/show/{id}', [
		'uses'=>'DesignerController@show',
		'as'=> 'designer.show',
		'roles'=> ['admin', 'designer'],
		]);

	Route::post('designer/show/{id}', [
		'uses'=>'DesignerController@update',
		'as'=> 'designer.update',
		'roles'=> ['admin', 'designer'],
		]);
//Designer End

//printer Start
	Route::get('printer/users', [
		'uses'=>'PrinterController@users',
		'as'=> 'printer.users',
		'roles'=> ['admin', 'printer'],
		]);

	Route::get('printer/{status?}', [
		'uses'=>'PrinterController@index',
		'as'=> 'printer.index',
		'roles'=> ['admin', 'printer'],
		]);

	Route::get('printer/user/{user_id}/orders', [
		'uses'=>'PrinterController@user_orders',
		'as'=> 'printer.user.orders',
		'roles'=> ['admin', 'printer'],
		]);




			/*
	Route::get('printer/{id}', [
		'uses'=>'PrinterController@show',
		'as'=> 'printer.show',
		'roles'=> ['admin', 'printer'],
		]);
	*/
//printer End

	Route::get('download/{id}/{server}', [
		'uses'=>'PrintFileController@download',
		'as'=> 'printfile.download',
		'roles'=> ['admin', 'designer', 'printer'],
		]);
	Route::get('order/{id}/{status}', [
		'uses'=>'OrderController@setStatus',
		'as'=> 'order.status',
		'roles'=> ['admin', 'manager', 'designer', 'printer'],
		]);
	Route::get('send2server/{id}', [
		'uses'=>'PrintFileController@send2server',
		'as'=> 'printfile.send2server',
		'roles'=> ['admin', 'designer'],
		]);
});
//All Management


	
	Route::get('printfile/upload', [
		'uses'=>'PrintFileController@form',
		'as'=> 'printfile.form',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);

	Route::post('printfile/upload', [
		'uses'=>'PrintFileController@upload',
		'as'=> 'printfile.upload',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);

	Route::get('/user', [
		'uses'=>'UserController@index',
		'as'=> 'user.index',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);

	Route::post('user/profile', [
		'uses'=>'UserController@profileUpdate',
		'as'=> 'user.profileUpdate',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);

	Route::get('user/profile', [
		'uses'=>'UserController@profile',
		'as'=> 'user.profile',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);

	Route::get('/user/transfer', [
		'uses'=>'UserController@transfer',
		'as'=> 'user.transfer',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	
	//Order
	Route::get('order', [
		'uses'=>'OrderController@index',
		'as'=> 'order.index',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::get('order/create/{id}', [
		'uses'=>'OrderController@create',
		'as'=> 'order.create',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::post('order/create/{id}', [
		'uses'=>'OrderController@save',
		'as'=> 'order.save',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::post('order/update/{id}', [
		'uses'=>'OrderController@update',
		'as'=> 'order.update',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::get('order/show/{id}', [
		'uses'=>'OrderController@show',
		'as'=> 'order.show',
		'roles'=> ['admin','user'],
		]);

	Route::get('order/edit/{id}', [
		'uses'=>'OrderController@edit',
		'as'=> 'order.edit',
		'roles'=> ['admin','user'],
		]);

	Route::get('order/delete/{id}', [
		'uses'=>'OrderController@delete',
		'as'=> 'order.delete',
		'roles'=> ['admin','user'],
		]);

	Route::get('order/trash/{id}/{confirm?}', [
		'uses'=>'OrderController@trash',
		'as'=> 'order.trash',
		'roles'=> ['admin', 'manager', 'user', 'designer', 'printer'],
		]);

	Route::get('/order/pay/{order_id}/{confirm?}', [
		'uses'=>'PayController@orderPay',
		'as'=> 'pay.orderPay',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);



	/*LiqPay Route*/
	Route::post('/user/pay/create', [
		'uses'=>'PayController@create',
		'as'=> 'pay.create',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::get('/user/pay/product_url', [
		'uses'=>'PayController@product_url',
		'as'=> 'pay.product_url',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);
	Route::get('/user/pay/result_url', [
		'uses'=>'PayController@result_url',
		'as'=> 'pay.result_url',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);


	Route::get('pays', [
		'uses'=>'PayController@index',
		'as'=> 'pays',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);	

	Route::get('products', [
		'uses'=>'ProductController@products',
		'as'=> 'products',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);	

	Route::get('products/{product}', [
		'uses'=>'ProductController@product',
		'as'=> 'products.product',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);	

	Route::get('product_all/{catalog}', [
		'uses'=>'ProductController@product_all',
		'as'=> 'products.product_all',
		'roles'=> ['admin', 'user', 'designer', 'printer'],
		]);	

});
