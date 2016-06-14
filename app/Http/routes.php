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
Route::group(['middleware' => 'web'], function () {

	Route::get('/', 'CatalogController@index');

	Route::resource('catalog', 'CatalogController', ['only' => ['show']]);
	Route::resource('page', 'PageController', ['only' => ['show']]);
	Route::resource('post', 'PostController', ['only' => ['index', 'show']]);

	Route::resource('product', 'ProductController', ['only' => ['index', 'show']]);

	Route::get('ajax', 'AjaxController@get');
	Route::post('ajax', 'AjaxController@post');


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
