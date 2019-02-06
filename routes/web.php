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

Route::get('/admin', 'AdminController@index')->name('login');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
