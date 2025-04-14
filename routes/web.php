<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FilmController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Ruta za prikaz forme za kreiranje novog proizvoda
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

// Ruta za spremanje novog proizvoda u bazu
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');
Route::get('/languages/{id}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
Route::delete('/languages/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');
Route::patch('/languages/{id}', [LanguageController::class, 'update'])->name('languages.update');

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films/store', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
Route::patch('/films/{id}', [FilmController::class, 'update'])->name('films.update');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
