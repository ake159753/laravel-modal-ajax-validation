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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'UserPageController@index')->name('welcome');
Route::post('/', 'UserPageController@store')->name('store');
Route::post('/update', 'UserPageController@update')->name('update');
Route::get('pagination/fetch_data', 'UserPageController@fetch_data');
Route::get('search', 'UserPageController@search')->name('search');

Route::post('/storeDynamicly', 'UserPageController@storeDynamicly')->name('storeDynamicly');

Route::post('/livestore', 'UserPageController@livestore')->name('livestore');
Route::post('/deleteRecord', 'UserPageController@deleteRecord')->name('deleteRecord');
//datatables
Route::get('/datatables', 'DataTablesController@datatables')->name('datatables');
Route::get('/getData', 'DataTablesController@getData')->name('getData');

//form
Route::get('/form', 'FormController@form')->name('form');
Route::post('/addField', 'FormController@addField')->name('addField');
Route::post('/addRecord', 'FormController@addRecord')->name('addRecord');
Route::post('/delField', 'FormController@delField')->name('delField');

