<?php

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
