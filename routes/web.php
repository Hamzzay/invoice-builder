<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceTemplateController;
use App\Http\Controllers\PDFController;
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
    return view('app');
});

Route::group(['prefix' => 'invoice'], function () {
    Route::get('/templates', [InvoiceTemplateController::class, 'InvoiceTemplates']);
    Route::post('/generate', [InvoiceController::class, 'generateInvoice']);
    Route::post('/preview', [InvoiceController::class, 'preview']);
});
Route::get('/invoice-pdf', [PDFController::class, 'generatePdf']);
Route::get('/invoice-pdf2', function () {
    return view('pdf.invoice-2');
});
Route::get('/invoice-pdf3', function () {
    return view('pdf.invoice-3');
});
