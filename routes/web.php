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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ProductController@index');
Route::get('/about', 'SiteController@about');
Route::get('/delivery', 'SiteController@delivery');
Route::get('/catalog', 'ProductController@catalog');
Route::post('/catalog', 'ProductController@catalog');
Route::get('/catalog/{product}', 'ProductController@single_product');
Route::get('/library', 'ArticleController@index');
Route::get('/library/{article}', 'ArticleController@single_article');
Route::get('/home/orders', 'HomeController@user_orders');
Route::get('/home/edit', 'HomeController@edit_index');
Route::post('/home/edit/data', 'HomeController@edit_data');
Route::post('/home/edit/passwords', 'HomeController@edit_passwords');
Route::get('/home/userCard', 'HomeController@card_index');
Route::post('/home/userCard/safe', 'HomeController@card_safe');
Route::post('/cart/add/{product}', 'OrderController@store');
Route::get('/cart', 'OrderController@cart');
Route::post('/cart/{orderItems}/dec', 'OrderController@decrease_item_cart');
Route::post('/cart/{orderItems}/inc', 'OrderController@increase_item_cart');
Route::post('/cart/del/{orderItems}', 'OrderController@delete_item_cart');
Route::post('/cart/order', 'OrderController@order');

Route::middleware('admin')->group(function() {
    Route::get('/admin', 'AdminController@index');

    Route::get('/admin/tea', 'AdminController@tea');
    Route::get('/admin/tea/hide/{product}', 'AdminController@hide_tea');
    Route::get('/admin/tea/edit/{product}', 'AdminController@open_edit_tea');
    Route::post('/admin/tea/edit/{product}', 'AdminController@edit_tea');
    Route::get('/admin/tea/add', 'AdminController@open_add_tea');
    Route::post('/admin/tea/add', 'AdminController@add_tea');

    Route::get('/admin/articles', 'AdminController@articles');
    Route::get('/admin/articles/del/{article}', 'AdminController@delete_article');
    Route::get('/admin/articles/add', 'AdminController@open_add_article');
    Route::post('/admin/articles/add', 'AdminController@add_article');
    Route::get('/admin/articles/edit/{article}', 'AdminController@open_edit_article');
    Route::post('/admin/articles/edit/{article}', 'AdminController@edit_article');

    Route::get('/admin/news', 'AdminController@news');
    Route::get('/admin/news/hide/{news}', 'AdminController@hide_news');
    Route::get('/admin/news/add', 'AdminController@open_add_news');
    Route::post('/admin/news/add', 'AdminController@add_news');

    Route::get('/admin/staff', 'AdminController@staff');
    Route::get('/admin/staff/disband/{user}', 'AdminController@disband_user');
    Route::get('/admin/staff/add', 'AdminController@open_add_staff');
    Route::post('/admin/staff/add', 'AdminController@add_staff');

});
