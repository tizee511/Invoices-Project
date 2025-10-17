<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;




Route::get('/', function () {
    return view('auth.login');
});
//*'طريقة كتابة الcomments
/**
 * * KKKKKKKKKKKKKKK
 * ? KKKKKKKKKKKKKKK
 * ! KKKKKKKKKKKKKKK
 * TODOs KKKKKKKKKKKKKKK
 *  KKKKKKKKKKKKKKK
 */
//*Auth::routes();
//? Auth::routes();
//! Auth::routes();
//TODOs Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ---------------------
Route::resource('invoices', InvoicesController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);


Route::get('section/{id}',[InvoicesController::class,'getproducts']);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::get('InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);

Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'get_file']);

Route::get('View_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);

Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');

//*=======================================
Route::get('edit_invoice/{id}',[InvoicesController::class,'edit']);

Route::get('Status_show/{id}',[InvoicesController::class,'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [InvoicesController::class,'Status_Update'])->name('Status_Update');
// ---------------------------
Route::resource('Archive', InvoiceAchiveController::class);
// ---------------------------
Route::get('invoices_paid',[InvoicesController::class ,'invoices_paid'])->name('invoices_paid');

Route::get('invoices_unpaid',[InvoicesController::class ,'invoices_unpaid'])->name('invoices_unpaid');

Route::get('invoices_Partial',[InvoicesController::class ,'invoices_Partial'])->name('invoices_Partial');

Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);

// ---------------------
Route::get('/{page}', [AdminController::class, 'index']);
// Route::get('page/one', function(){
//     return " mmmmmmmmmmmmmmmmmmmmmm";
// });
// php artisan ui bootstrap --auth

