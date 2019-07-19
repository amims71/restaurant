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

// Route::group(['middleware' => ['web']], function () {

	Route::get('/', function () {
	    return view('pages.index');
	})->name('index');

	Route::get('/menu', function () {
	    return view('pages.menu');
	})->name('menu');

	Route::get('/reservation', function () {
	    return view('pages.book');
	})->name('book');

	Route::get('/about', function () {
	    return view('pages.about');
	})->name('about');

	Route::get('/contact', function () {
	    return view('pages.contact');
	})->name('contact');

	Route::get('/admin', function () {
	    return view('admin.dashboard');
	})->name('admin');

	Route::get('/admin/users', function () {
	    return view('admin.users');
	})->name('users');

	Route::get('/admin/orders', function () {
	    return view('admin.orders');
	})->name('orders');

	Route::get('/admin/reservation', function () {
	    return view('admin.book');
	})->name('reservation');

	Route::get('/admin/foods', function () {
	    return view('admin.foods');
	})->name('foods');


	Route::get('/admin/process/{id}','HomeController@process');
	Route::get('/admin/complete/{id}','HomeController@complete');
	Route::get('/cart/{id}','HomeController@cart');
	Route::get('/cart/remove/{id}','HomeController@cartRemove');
	Route::post('/signup','HomeController@signup');
	Route::post('/login','HomeController@login');
	//Route::get('/test','HomeController@test');
	Route::get('/logout','HomeController@logout');
	Route::post('/order','HomeController@order');
	Route::post('/book','HomeController@book');
	Route::post('/admin/confirm','HomeController@confirm');
// });
