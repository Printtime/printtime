<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
	Route::get('image/{image_name}', function ($image_name) {

			$image = File::get(public_path().'/images/uploads/'.$image_name);
			#$contents = Storage::get(public_path().'/images/uploads/'.$image_name);
			#return dd($contents);

			$img = Image::cache(function($image) {
			   return $image->make('public/images/uploads_cache/'.$image_name)->resize(300, 200)->greyscale();
			});
		
	});
	*/
	

Route::group(['middleware' => 'web'], function () {

	#Route::get('cache-medium/{?/?/?.jpg}', 'ImgController@getCache');

	#Route::get('cache/{templates}/{path?}', array('as' => 'cache', 'uses' => 'ImgController@getCache'))->where('path', '.+');


	Route::get('/', 'CatalogController@index');

	Route::resource('catalog', 'CatalogController', ['only' => ['show']]);
	Route::get('portfolio', 'CatalogController@portfolio')->name('catalog.portfolio');

	Route::resource('page', 'PageController', ['only' => ['show']]);
	Route::resource('post', 'PostController', ['only' => ['index', 'show']]);


	Route::get('printfile/upload', 'PrintFileController@form')->name('printfile.form');
	Route::post('printfile/upload', 'PrintFileController@upload')->name('printfile.upload');
	Route::resource('printfile', 'PrintFileController');


	Route::resource('catalog.product', 'ProductController', ['only' => ['show']]);
	#Route::resource('product', 'ProductController', ['only' => ['show']]);
	Route::get('product/{product}/order', 'ProductController@order')->name('product.order');
	Route::post('product/{product}/orderSend', 'ProductController@orderSend')->name('product.orderSend');




/*	Route::get('/', function () {
	    return view('home');
	});*/
	

    #Route::get('/', 'HomeController@index');
    
	});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
});
