<?php

use Illuminate\Support\Facades\Route;

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

Route::GET('/penerbangan', 'PenerbanganController@index')->name('penerbangan.index');
Route::GET('/penerbangan/getall', 'PenerbanganController@all');
Route::GET('/penerbangan/getbyid', 'PenerbanganController@getById');
Route::POST('/penerbangan/insert', 'PenerbanganController@insert');
Route::POST('/penerbangan/update', 'PenerbanganController@update');
Route::POST('/penerbangan/delete', 'PenerbanganController@delete');
