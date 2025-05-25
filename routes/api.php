<?php

use App\Http\Controllers\LanguageApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Ova ruta je samo primjer, no možeš je zadržati ako ti treba autentifikacija
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, API!']);
});

// Rute za Category resurs
Route::get('/categories', [App\Http\Controllers\CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [App\Http\Controllers\CategoryApiController::class, 'show']);
Route::post('/categories', [App\Http\Controllers\CategoryApiController::class, 'store']);
Route::put('/categories/{id}', [App\Http\Controllers\CategoryApiController::class, 'update']);
Route::delete('/categories/{id}', [App\Http\Controllers\CategoryApiController::class, 'destroy']);

// Rute za Country resurs
Route::get('/countries', [App\Http\Controllers\CountryApiController::class, 'index']);
Route::get('/countries/{id}', [App\Http\Controllers\CountryApiController::class, 'show']);
Route::post('/countries', [App\Http\Controllers\CountryApiController::class, 'store']);
Route::put('/countries/{id}', [App\Http\Controllers\CountryApiController::class, 'update']);
Route::delete('/countries/{id}', [App\Http\Controllers\CountryApiController::class, 'destroy']);

// Rute za Language resurs
Route::get('/languages', [App\Http\Controllers\LanguageApiController::class, 'index']);
Route::get('/languages/{id}', [App\Http\Controllers\LanguageApiController::class, 'show']);
Route::post('/languages', [App\Http\Controllers\LanguageApiController::class, 'store']);
Route::put('/languages/{id}', [App\Http\Controllers\LanguageApiController::class, 'update']);
Route::delete('/languages/{id}', [App\Http\Controllers\LanguageApiController::class, 'destroy']);



