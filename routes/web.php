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

Route::resource('invoice-attachments', 'InvoicesAttachmentsController');

Route::get('/section/{id}', 'InvoiceController@getProducts');

Route::get('/invoices-details/{id}', 'InvoicesDetailsController@edit');

Route::get('/download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('/view-file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('/delete-file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit-invoice/{id}', 'InvoiceController@edit');

Route::get('/status-show/{id}', 'InvoiceController@show')->name('status-show');

Route::post('/status-update/{id}', 'InvoiceController@statusUpdate')->name('status-update');

Route::resource('archive', 'InvoicesArchiveController');

Route::get('paid-invoices', 'InvoiceController@paidInvoices');

Route::get('unpaid-invoices', 'InvoiceController@unpaidInvoices');

Route::get('partial-paid-invoices', 'InvoiceController@partialPaidInvoices');

Route::get('print-invoice/{id}','InvoiceController@printInvoice');


Route::get('export-invoices/', 'InvoiceController@export');



Route::get('/{page}', 'AdminController@index');
