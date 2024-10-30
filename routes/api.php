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
use App\Http\Controllers\BudidayaController;

Route::get('/budidaya', [BudidayaController::class, 'index']);
Route::get('/budidaya/{id}', [BudidayaController::class, 'show']);
Route::post('/budidaya', [BudidayaController::class, 'store']);
Route::put('/budidaya/{id}', [BudidayaController::class, 'update']);
Route::delete('/budidaya/{id}', [BudidayaController::class, 'destroy']);


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
Route::put('proseduranalisis/update/{id}', [ProsedurAnalisisController::class, 'update']);


//Cultivate Management
use App\Http\Controllers\LandController;


Route::post('/bloklahan', [LandController::class, 'store']);
Route::get('/bloklahan', [LandController::class, 'index']); 
Route::put('/bloklahan/{id}', [LandController::class, 'update']); // Mengupdate data
Route::delete('/bloklahan/{id}', [LandController::class, 'destroy']);

//Procesing Management


//Koperasi


//Konten
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/showgallery/{id_galeri}', [GalleryController::class, 'showData']);
Route::get('/categories', [GalleryController::class, 'getCategories']);
Route::post('/upload-gallery', [GalleryController::class, 'uploadGallery']);
Route::put('/gallery/{id_galeri}', [GalleryController::class, 'updateGallery']);
Route::delete('/gallery/{id_galeri}', [GalleryController::class, 'deleteGallery']);
