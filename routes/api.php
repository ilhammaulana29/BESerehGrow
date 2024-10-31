<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Admin Acces Management


//LandAnalis
use App\Http\Controllers\AnalisisLahanController;
use App\Http\Controllers\helpController;
use App\Http\Controllers\ProsedurAnalisisController;

//Cultivate Management

//Procesing Management
use App\Http\Controllers\PenyulinganController;
use App\Http\Controllers\KeluhanController;

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
Route::delete('/analisis-lahan/{id_analisislahan}', [AnalisisLahanController::class, 'destroy']);
Route::get('/proseduranalisis', [ProsedurAnalisisController::class, 'index']);
Route::post('/proseduranalisis', [ProsedurAnalisisController::class, 'store']);
Route::get('proseduranalisis/{jenis_konten}', [ProsedurAnalisisController::class, 'getByJenisKonten']);
Route::put('proseduranalisis/{id}', [ProsedurAnalisisController::class, 'update']);
Route::get('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'show']);
Route::delete('/proseduranalisis/{id}', [ProsedurAnalisisController::class, 'destroy']);



//Cultivate Management
use App\Http\Controllers\LandController;


Route::post('/bloklahan', [LandController::class, 'store']);
Route::get('/bloklahan', [LandController::class, 'index']);
Route::put('/bloklahan/{id}', [LandController::class, 'update']); // Mengupdate data
Route::delete('/bloklahan/{id}', [LandController::class, 'destroy']);

//Procesing Management
Route::get('/penyulingan', [PenyulinganController::class, 'index']);
Route::post('/penyulingan', [PenyulinganController::class, 'store']);
Route::put('/penyulingan/{id_penyulingan}', [PenyulinganController::class, 'update']);





Route::get('/keluhan', [KeluhanController::class, 'index']);
Route::post('/keluhan', [KeluhanController::class, 'store']);
Route::delete('/keluhan/{id_keluhan}', [KeluhanController::class, 'delete']);
//Koperasi


//Konten
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/showgallery/{id_galeri}', [GalleryController::class, 'showData']);
Route::get('/categories', [GalleryController::class, 'getCategories']);
Route::post('/upload-gallery', [GalleryController::class, 'uploadGallery']);
Route::put('/gallery/{id_galeri}', [GalleryController::class, 'updateGallery']);
Route::delete('/gallery/{id_galeri}', [GalleryController::class, 'deleteGallery']);



//Help
Route::get('/help', [helpController::class, 'index']);
Route::post('/add-help', [helpController::class, 'addHelp']);
Route::put('/edit-help/{id}', [helpController::class, 'updateHelp']);
Route::delete('/delete-help/{id}', [helpController::class, 'deleteHelp']);
