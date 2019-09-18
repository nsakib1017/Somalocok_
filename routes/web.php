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

//user defined routes
Route::get('/','PagesController@cover' );
Route::get('/settings','PagesController@settings');
Route::get('/admin','PagesController@admin')->name('admin');
Route::get('/about','PagesController@about')->name('about');


//resource routes
Route::resource('movies','MoviesController');
Route::resource('comment','CommentsController');
Route::resource('rating','RatingController');

//Authentication
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
