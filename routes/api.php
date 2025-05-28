<?php

use App\Http\Controllers\LanguageApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\CountryApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Ova ruta je samo primjer, no možeš je zadržati ako ti treba autentifikacija
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, API!']);
});

Route::middleware('auth.basic')->group(function () {
    // Zaštita REST API ruta
    Route::get('/categories', [CategoryApiController::class, 'index']);
    Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
    Route::post('/categories', [CategoryApiController::class, 'store']);
    Route::put('/categories/{id}', [CategoryApiController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy']);
});
Route::middleware('auth.basic')->group(function () {
    Route::get('/countries', [CountryApiController::class, 'index']);
    Route::get('/countries/{id}', [CountryApiController::class, 'show']);
    Route::post('/countries', [CountryApiController::class, 'store']);
    Route::put('/countries/{id}', [CountryApiController::class, 'update']);
    Route::delete('/countries/{id}', [CountryApiController::class, 'destroy']);
});
Route::middleware('auth.basic')->group(function () {
    Route::get('/languages', [LanguageApiController::class, 'index']);
    Route::get('/languages/{id}', [LanguageApiController::class, 'show']);
    Route::post('/languages', [LanguageApiController::class, 'store']);
    Route::put('/languages/{id}', [LanguageApiController::class, 'update']);
    Route::delete('/languages/{id}', [LanguageApiController::class, 'destroy']);
});


