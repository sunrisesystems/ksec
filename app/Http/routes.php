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


Route::get('/','AdminController@getLogin');
Route::get('/admin','AdminController@getLogin');

Route::post('drawings/getMoldTradeName','DrawingController@getMoldTradeName');
Route::any('drawing/export','DrawingController@getExportToExcel');
Route::any('mold/export','MoldController@getExportToExcel');
Route::any('machineModel/export','MachineModelController@getExportToExcel');
Route::any('machine/export','MachineController@getExportToExcel');
Route::any('downtime/export','DowntimeController@getExportToExcel');
Route::any('defect/export','DefectController@getExportToExcel');
Route::any('product/export','ProductController@getExportToExcel');
Route::any('packing/export','PackingController@getExportToExcel');
Route::any('item/export','ItemController@getExportToExcel');
Route::post('loadAllMachine','DailyEntryController@postLoadAllMachines');
Route::get('showDailyEntry','DailyEntryController@getShowDailyEntry');
Route::post('getDailyEntryDetails','DailyEntryController@postShowDailyEntry');
Route::post('saveDailyEntry','DailyEntryController@postSaveDailyEntry');
Route::post('getRejection','DailyEntryController@postGetRejection');
Route::post('getDowntime','DailyEntryController@postGetDowntime');
Route::post('saveRejection','DailyEntryController@postSaveRejection');
Route::post('saveDowntime','DailyEntryController@postSaveDowntime');
Route::get('users/reset-password/{id}','UserController@getResetPassword');
Route::post('users/update-password','UserController@postUpdatePassword');

Route::resource('shapes','ShapesController');
Route::resource('stores', 'StoresController');
Route::resource('groups', 'GroupController');
Route::resource('types', 'TypeController');
Route::resource('neckSize', 'NeckSizeController');
Route::resource('drawings', 'DrawingController');
Route::resource('mold', 'MoldController');
Route::resource('accounts', 'AccountController');
Route::resource('machineModel', 'MachineModelController');
Route::resource('machine', 'MachineController');
Route::resource('product', 'ProductController');
Route::resource('colors', 'ColorController');
Route::resource('moldModel', 'MoldModelController');
Route::resource('users', 'UserController');
Route::resource('codeValue', 'CodevalueController');
Route::resource('downtime', 'DowntimeController');
Route::resource('defect', 'DefectController');
Route::controller('admin','AdminController');
Route::controller('planning','PlanningController');
Route::controller('invert','InvertController');
Route::controller('rejection','RejectionController');
Route::controller('hourlyEntry','HourlyEntryController');
Route::resource('dashboard','DashboardController');
Route::resource('dailyEntry','DailyEntryController');
Route::resource('item','ItemController');
Route::resource('packing','PackingController');
Route::resource('roles','RoleController');
Route::controller('report','ReportController');
