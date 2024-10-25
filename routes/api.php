<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Admin Acces Management


//LandAnalis
use App\Http\Controllers\AnalisisLahanController;
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