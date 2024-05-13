<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('geojson')->group(function () {
	Route::get('/points', [ApiController::class, 'points'])->name('geojson.points');
});