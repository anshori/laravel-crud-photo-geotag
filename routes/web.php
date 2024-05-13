<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeotagController;

Route::get('/', [GeotagController::class, 'index'])->name('index');
Route::get('/upload', [GeotagController::class, 'create'])->name('upload');
Route::post('/store', [GeotagController::class, 'store'])->name('store');
Route::delete('/destroy/{id}', [GeotagController::class, 'destroy'])->name('destroy');

