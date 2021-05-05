<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices', 'InvoiceController');

Route::resource('sections', 'SectionController');

Route::resource('products', 'ProductController');

Route::resource('invoice-attachment', 'InvoicesAttachmentsController');

Route::get('/section/{id}', 'InvoiceController@getProducts');

Route::get('/{page}', 'AdminController@index');

Route::get('/invoices-details/{id}', 'InvoicesDetailsController@edit');

Route::get('/download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('/view-file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('/delete-file', 'InvoicesDetailsController@destroy')->name('delete_file');
