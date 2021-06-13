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
Route::resource('roles', 'RoleController');
Route::resource('users', 'UserController');
Route::resource('invoice-attachments', 'InvoicesAttachmentsController');
Route::resource('archive', 'InvoicesArchiveController');

Route::get('section/{id}', 'InvoiceController@getProducts');

Route::get('status-show/{id}', 'InvoiceController@show')->name('status-show');
Route::post('status-update/{id}', 'InvoiceController@statusUpdate')->name('status-update');

Route::get('invoices-details/{id}', 'InvoicesDetailsController@edit');
Route::get('edit-invoice/{id}', 'InvoiceController@edit');
Route::get('paid-invoices', 'InvoiceController@paidInvoices');
Route::get('unpaid-invoices', 'InvoiceController@unpaidInvoices');
Route::get('partial-paid-invoices', 'InvoiceController@partialPaidInvoices');
Route::get('print-invoice/{id}', 'InvoiceController@printInvoice');
Route::get('export-invoices/', 'InvoiceController@export');

Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');
Route::get('view-file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
Route::post('delete-file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('invoices-report', 'InvoicesReportController@index');
Route::post('search-invoices', 'InvoicesReportController@searchInvoices');

Route::get('customers-report', 'CustomersReportController@index')->name("customers-report");
Route::post('search-customers', 'CustomersReportController@searchCustomers');

Route::get('mark-as-read-all', 'InvoiceController@markAsReadAll')->name('mark-as-read-all');

Route::post('contact-us', 'UserController@contactUs');

Route::get('/{page}', 'AdminController@index');
