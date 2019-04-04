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










// Back End Site ------------------------

Route::get('/logout', 'SuperAdminController@logout')->name('logout');
Route::get('/admin', 'AdminController@index')->name('login');
Route::get('/dashboard', 'AdminController@show_dashboard')->name('dashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard')->name('admin_dashboard');

// Category route
Route::resource('category', 'CategoryController');
Route::get('category/publish/{id}', 'CategoryController@publish')->name('publish');
Route::get('category/unpublish/{id}', 'CategoryController@unpublish')->name('unpublish');
