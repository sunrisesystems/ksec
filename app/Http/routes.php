<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// new routes
Route::get('/','AdminController@getLogin');

// single routes
Route::get('/getCSubCallTypes','CalltypeController@getCallSubTypeByCallId');

// controller routes
Route::resource('dashboard','DashboardController');
Route::controller('admin','AdminController');
Route::resource('codeValue', 'CodevalueController');
Route::resource('employees', 'EmployeeController');
Route::resource('voice', 'VoiceController');
Route::resource('roles','RoleController');
Route::resource('calltype','CalltypeController');
Route::resource('subcalltype','SubcalltypeController');
Route::controller('audit','AuditController');


// to be remove
Route::resource('products', 'ProductController');
Route::resource('product-category', 'ProductCategoryController');
Route::resource('product-subcategory', 'ProductSubcategoryController');
Route::resource('offers', 'OffersController');
Route::controller('search', 'SearchController');

