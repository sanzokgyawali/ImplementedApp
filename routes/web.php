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
//frontend.........................................................................
Route::get('/','HomeController@index')->name('homepage');













//backend..................................................................
Route::get('/admin','AdminController@index');
Route::get('/admin/dashboard','AdminController@show_dashboard');
Route::get('/admin/logout','SuperAdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
//category section........................................................
Route::get('/admin/addcategory','CategoryController@index');
Route::get('/admin/allcategory','CategoryController@showcategory');
Route::post('/admin/add-category','CategoryController@add');
Route::get('/admin/category/inactive/{category_id}','CategoryController@inactive');
Route::get('/admin/category/active/{category_id}','CategoryController@active');
Route::get('/admin/category/edit/{category_id}','CategoryController@edit');
Route::post('/admin/category/edit-category/{category_id}','CategoryController@edit_category');
Route::get('/admin/category/delete/{category_id}','CategoryController@delete');
//brand section.................................................................
Route::get('/admin/brand/add_brand','BrandController@index');
Route::post('/admin/brand/add-brand','BrandController@add_brand');
Route::get('/admin/brand/show_brand','BrandController@show_brand');
Route::get('/admin/brand/inactive/{manufacture_id}','BrandController@inactive');
Route::get('/admin/brand/active/{manufacture_id}','BrandController@active');
Route::get('/admin/brand/edit/{manufacture_id}','BrandController@edit');
Route::post('/admin/brand/update-brand/{manufacture_id}','BrandController@update_brand');
Route::get('/admin/brand/delete/{manufacture_id}','BrandController@delete');
//product section...............................................................
Route::get('/admin/product/add_product','ProductController@add_product');
Route::post('/admin/product/ajaxfile','ProductController@ajax');
