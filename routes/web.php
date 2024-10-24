<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalisisLahanController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/analisis-lahan', [AnalisisLahanController::class, 'store']);