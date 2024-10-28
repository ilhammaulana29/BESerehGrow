<?php

use App\Http\Controllers\Cpc_company_contactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Mitracontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Admin Acces Management


//LandAnalis
use App\Http\Controllers\AnalisisLahanController;
use App\Http\Controllers\Company_addressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Cpc_aboutController;
use App\Http\Controllers\Cpc_company_historyController;
use App\Http\Controllers\ProsedurAnalisisController;

//Cultivate Management

//Procesing Management


//Koperasi


//Konten


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Admin Acces Management


//LandAnalis
Route::get('/analisis-lahan', [AnalisisLahanController::class, 'index']); 
Route::post('/analisis-lahan', [AnalisisLahanController::class, 'store']);
Route::put('/analisis-lahan/{id}', [AnalisisLahanController::class, 'update']); // Mengupdate data
Route::delete('/analisis-lahan/{id}', [AnalisisLahanController::class, 'destroy']);
Route::get('/proseduranalisis', [ProsedurAnalisisController::class, 'index']);
Route::post('/proseduranalisis', [ProsedurAnalisisController::class, 'store']);
Route::get('proseduranalisis/{jenis_konten}', [ProsedurAnalisisController::class, 'getByJenisKonten']);


//Cultivate Management



//Procesing Management


//Koperasi


//Konten
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/{category}', [GalleryController::class, 'filterByCategory']);
Route::get('/categories', [GalleryController::class, 'getCategories']);
Route::post('/upload-gallery', [GalleryController::class, 'uploadGallery']);

//Company
Route::get('/companies', [CompanyController::class, 'index']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);
Route::put('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'destroy']);

//Company_address
Route::get('/company-address', [Company_addressController::class,'index']);
Route::post('/company-address', [Company_addressController::class, 'store']);
Route::get('/company-address/{id}', [Company_addressController::class. 'show']);
Route::put('/company-address/{id}', [Company_addressController::class,'update']);
Route::delete('/company-address/{id}', [Company_addressController::class, 'destroy']);

//Company_about
Route::get('/company-about', [Cpc_aboutController::class, 'index']);
Route::post('/company-about', [Cpc_aboutController::class, 'store']);
Route::get('/company-about/{id}', [Cpc_aboutController::class, 'show']);
Route::put('/company-about/{id}', [Cpc_aboutController::class, 'update']);
Route::delete('/company-about/{id}', [Cpc_aboutController::class, 'destroy']);

//Company_Contact
Route::get('/company-contact', [Cpc_company_contactController::class, 'index']);
Route::post('/company-contact', [Cpc_company_contactController::class, 'store']);
Route::get('/company-contact/{id}', [Cpc_company_contactController::class,'show']);
Route::put('/company-contact/{id}', [Cpc_company_contactController::class, 'update']);
Route::delete('/company-contact/{id}', [Cpc_company_contactController::class,  'destroy']);

//Company_History
Route::get('/company-history', [Cpc_company_historyController::class, 'index']);
Route::post('/company-history', [Cpc_company_historyController::class, 'store']);
Route::get('/company-history/{id}', [Cpc_company_historyController::class, 'show']);
Route::put('/company-history/{id}', [Cpc_company_historyController::class, 'update']);
Route::delete('/company-history/{id}', [Cpc_company_historyController::class, 'destroy']);

//mitra
Route::get('/mitra', [Mitracontroller::class, 'index']);        // GET semua mitra
Route::post('/mitra', [Mitracontroller::class, 'store']);       // POST buat mitra baru
Route::get('/mitra/{id}', [Mitracontroller::class, 'show']);     // GET satu mitra
Route::put('/mitra/{id}', [Mitracontroller::class, 'update']);   // PUT update mitra
Route::delete('/mitra/{id}', [Mitracontroller::class, 'destroy']); // DELETE hapus mitra
