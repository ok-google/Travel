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

Route::GET('/hotel', 'HotelController@index')->name('hotel.index');
Route::GET('/hotel/getall', 'HotelController@all');
Route::GET('/hotel/getbyid', 'HotelController@getById');
Route::GET('/hotel/browse', 'HotelController@selectAktif');
Route::POST('/hotel/insert', 'HotelController@insert');
Route::POST('/hotel/update', 'HotelController@update');
Route::POST('/hotel/delete', 'HotelController@delete');

Route::GET('/kamar', 'KamarController@index')->name('kamar.index');
Route::GET('/kamar/getall', 'KamarController@all');
Route::GET('/kamar/getbyid', 'KamarController@getById');
Route::GET('/kamar/browse', 'KamarController@all');
Route::POST('/kamar/insert', 'KamarController@insert');
Route::POST('/kamar/update', 'KamarController@update');
Route::POST('/kamar/delete', 'KamarController@delete');

Route::GET('/keberangkatan', 'KeberangkatanController@index')->name('keberangkatan.index');
Route::GET('/keberangkatan/getall', 'KeberangkatanController@all');
Route::GET('/keberangkatan/getbyid', 'KeberangkatanController@getById');
Route::GET('/keberangkatan/browse', 'KeberangkatanController@all');
Route::POST('/keberangkatan/insert', 'KeberangkatanController@insert');
Route::POST('/keberangkatan/update', 'KeberangkatanController@update');
Route::POST('/keberangkatan/delete', 'KeberangkatanController@delete');

Route::GET('/customer', 'CustomerController@index')->name('customer.index');
Route::GET('/customer/getall', 'CustomerController@all');
Route::GET('/customer/getbyid', 'CustomerController@getById');
Route::GET('/customer/browse', 'CustomerController@all');
Route::POST('/customer/insert', 'CustomerController@insert');
Route::POST('/customer/update', 'CustomerController@update');
Route::POST('/customer/delete', 'CustomerController@delete');

Route::GET('/paket', 'PaketController@index')->name('paket.index');
Route::GET('/paket/getall', 'PaketController@all');
Route::GET('/paket/getbyid', 'PaketController@getById');
Route::GET('/paket/browse', 'PaketController@all');
Route::POST('/paket/insert', 'PaketController@insert');
Route::POST('/paket/update', 'PaketController@update');
Route::POST('/paket/delete', 'PaketController@delete');

Route::GET('/booking', 'BookingController@index')->name('booking.index');
Route::GET('/booking/getall', 'BookingController@all');
Route::GET('/booking/getbyid', 'BookingController@getById');
Route::GET('/booking/browse', 'BookingController@all');
Route::POST('/booking/insert', 'BookingController@insert');
Route::POST('/booking/update', 'BookingController@update');
Route::POST('/booking/delete', 'BookingController@delete');

Route::GET('/pembayaran', 'PembayaranController@index')->name('pembayaran.index');
Route::GET('/pembayaran/getall', 'PembayaranController@all');
Route::GET('/pembayaran/getbyid', 'PembayaranController@getById');
Route::GET('/pembayaran/browse', 'PembayaranController@all');
Route::POST('/pembayaran/insert', 'PembayaranController@insert');
Route::POST('/pembayaran/update', 'PembayaranController@update');
Route::POST('/pembayaran/delete', 'PembayaranController@delete');
