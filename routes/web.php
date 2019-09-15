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
/*

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('layouts.index');
})->name('index');

*/

// Front End Site -----------------------

Route::get('/', 'HomeController@index')->name('index');

Route::get('category/{id}', 'HomeController@category_product')->name('category.product');








// Back End Site ------------------------

Route::get('/logout', 'SuperAdminController@logout')->name('logout');
Route::get('/admin', 'AdminController@index')->name('login');
Route::post('/admin-dashboard', 'AdminController@dashboard')->name('admin_dashboard');
Route::get('/dashboard', 'SuperAdminController@index')->name('dashboard');

// Slider Route
Route::resource('slider', 'SliderController');
Route::get('slider/publish/{id}', 'SliderController@publish')->name('slider.publish');
Route::get('slider/unpublish/{id}', 'SliderController@unpublish')->name('slider.unpublish');

// Category route
Route::resource('category', 'CategoryController');
Route::get('category/publish/{id}', 'CategoryController@publish')->name('category.publish');
Route::get('category/unpublish/{id}', 'CategoryController@unpublish')->name('category.unpublish');

// Manufacture route
Route::resource('manufacture', 'ManufactureController');
Route::get('manufacture/publish/{id}', 'ManufactureController@publish')->name('manufacture.publish');
Route::get('manufacture/unpublish/{id}', 'ManufactureController@unpublish')->name('manufacture.unpublish');

// Product route
Route::resource('product', 'ProductController');
Route::get('product/publish/{id}', 'ProductController@publish')->name('product.publish');
Route::get('product/unpublish/{id}', 'ProductController@unpublish')->name('product.unpublish');
