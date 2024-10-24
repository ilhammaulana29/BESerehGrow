<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalisisLahanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/analisis-lahan', [AnalisisLahanController::class, 'index']); 
Route::post('/analisis-lahan', [AnalisisLahanController::class, 'store']);
Route::put('/analisis-lahan/{id}', [AnalisisLahanController::class, 'update']); // Mengupdate data
Route::delete('/analisis-lahan/{id}', [AnalisisLahanController::class, 'destroy']);