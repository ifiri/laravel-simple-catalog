<?php

use App\Jobs;

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

/**
 * Root route, main page
 */
Route::get('/', 'ProductsController@showMostPopular')->name('root');

/**
 * Category route. Showing concrete category
 */
Route::get('/category/{category}', 'CategoriesController@showCategory')->name('category');

/**
 * Route for search results
 */
Route::get('/search', 'SearchController@search')->name('search');