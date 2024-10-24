<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/gallery", [GalleryController::class, "index"]);
Route::get('/gallery/{category}', [GalleryController::class, 'filterByCategory']);