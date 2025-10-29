<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//? Auth::routes();
//! Auth::routes();
//TODOs Auth::routes();
// !-----------------------------------------------------------
//*  الروتر الخــــاص بالمصـــداقـــة
Auth::routes();
// * الروتر الخاصــــــــــــــــــــة بالصفحة الرئيسيــــــــــة
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// ---------------------
//*  الروتر الخــــاص بالاقســــام
Route::resource('sections', SectionsController::class);
//*  الروتر الخــــاص بالمنتجـــات
Route::resource('products', ProductsController::class);

// * الروترات الخاصــــــــــــــــــــة بالفواتيــــــــــــــر
Route::resource('invoices', InvoicesController::class);
Route::get('section/{id}',[InvoicesController::class,'getproducts']);
//*  الروترات  الخــــاصـــــة  بالتوابع الفـــاتـــورة
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);
//*  الروترات  الخــــاصـــــة  بتفاصيل الفـــاتـــورة
Route::get('InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit']);
///TODOs--------------------- خــــاص تحميـــــــل المرفق
Route::get('download/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'get_file']);
///TODOs--------------------- خــــاص عــــرض المرفق
Route::get('View_file/{invoice_number}/{file_name}',[InvoicesDetailsController::class,'open_file']);
///TODOs--------------------- خــــاص بحــذف المرفق
Route::post('delete_file',[InvoicesDetailsController::class,'destroy'])->name('delete_file');
// !====================================
// * الروترات التــــابعــه بالفواتيــــــــــــــر
///TODOs--------------------- خــــاص تعـــديل
Route::get('edit_invoice/{id}',[InvoicesController::class,'edit']);
///TODOs--------------------- خــــاص العـــرض وتغييــــر حـــالة الفــاتــورة
Route::get('Status_show/{id}',[InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [InvoicesController::class,'Status_Update'])->name('Status_Update');
///TODOs--------------------- خــــاص الارشفـــــــــة
Route::resource('Archive', InvoiceAchiveController::class);
///TODOs--------------------- خــــاص وتغييــــر حـــالة الفــاتــورة
Route::get('invoices_paid',[InvoicesController::class ,'invoices_paid'])->name('invoices_paid');
Route::get('invoices_unpaid',[InvoicesController::class ,'invoices_unpaid'])->name('invoices_unpaid');
Route::get('invoices_Partial',[InvoicesController::class ,'invoices_Partial'])->name('invoices_Partial');
///TODOs--------------------- خــــاص بطباعات الفــاتــورة
Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
//TODOs--------------------- خــــاص بالتصدير
Route::get('/export_invoices', [InvoicesController::class, 'export'])->name('invoices.export');
//--------------------------------------
// * الــــــروتــــــــرات الخاصــــــــــــــــه بالصلاحيـــــــــات
// spatie/laravel-permission
// Route::group(['middleware' => ['auth']], function() {
// Route::resource('roles',RoleController::class);
// Route::resource('users',UserController::class);
// });
//TODOs---------------------
    Route::resource('users',UserController::class)->middleware('auth');
    Route::resource('roles',RoleController::class)->middleware('auth');
//!===============================================
// * الــــروتـــــــرات الخاصــــــــــه بالتقـــــــاريـــــر
Route::get('invoices_report',[Invoices_Report::class ,'index']);
Route::post('Search_invoices',[Invoices_Report::class ,'Search_invoices']);
Route::get('customers_report',[Customers_Report::class ,'index']);
Route::post('Search_customers',[Customers_Report::class ,'Search_customers']);
// !---------------------------------------
// * الــــروتـــــــرات الخاصــــــــــه بتعين قراءه الاشعارات ككل
Route::get('MarkAsread_all',[InvoicesController::class, 'MarkAsread_all'])->name('MarkAsread_all');
Route::get('/{page}', [AdminController::class, 'index']);


