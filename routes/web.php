<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Laravel\Socialite\Facades\Socialite;


// Početna stranica
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
// Autentikacija
Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class,'login']);



Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');


    

// Rute za sve prijavljene korisnike (npr. role: reader, editor, admin)
Route::middleware(['auth', 'role:admin,user,editor'])->group(function () {
    // Index stranice - čitanje
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/languages', [LanguageController::class, 'index'])->name('languages.index');
    Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/films', [FilmController::class, 'index'])->name('films.index');
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

    // Ostale GET metode koje su potrebne svima
    Route::get('/films/dohvati/{id}', [FilmController::class, 'dohvati']);
});

// Rute za role editor i admin — stvaranje i uređivanje
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    // Categories
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

    // Languages
    Route::get('/languages/create', [LanguageController::class, 'create'])->name('languages.create');
    Route::post('/languages/store', [LanguageController::class, 'store'])->name('languages.store');

    // Films
    Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('/films/store', [FilmController::class, 'store'])->name('films.store');

    // Actors
    Route::get('/actors/create', [ActorController::class, 'create'])->name('actors.create');
    Route::post('/actors/store', [ActorController::class, 'store'])->name('actors.store');

    // Countries
    Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('/countries/store', [CountryController::class, 'store'])->name('countries.store');

    // Cities
    Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
    Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');

    // Addresses
    Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
    Route::post('/addresses/store', [AddressController::class, 'store'])->name('addresses.store');

    // Stores
    Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
    Route::post('/stores/store', [StoreController::class, 'store'])->name('stores.store');

    // Staff
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');

    // Inventories
    Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
    Route::post('/inventories/store', [InventoryController::class, 'store'])->name('inventories.store');

    // Customers
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');

    // Rentals
    Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals/store', [RentalController::class, 'store'])->name('rentals.store');

    // Payments
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
});

// Rute samo za admin - brisanje i dodatne funkcije
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/languages/{id}/edit', [LanguageController::class, 'edit'])->name('languages.edit');
    Route::patch('/languages/{id}', [LanguageController::class, 'update'])->name('languages.update');
    Route::delete('/languages/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');

    Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
    Route::patch('/films/{id}', [FilmController::class, 'update'])->name('films.update');
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
    
    Route::get('/actors/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
    Route::patch('/actors/{id}', [ActorController::class, 'update'])->name('actors.update');
    Route::delete('/actors/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');

    Route::get('/countries/{id}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::patch('/countries/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');

    Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::patch('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

    Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::patch('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');

    Route::get('/stores/{id}/edit', [StoreController::class, 'edit'])->name('stores.edit');
    Route::patch('/stores/{id}', [StoreController::class, 'update'])->name('stores.update');
    Route::delete('/stores/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');

    Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::patch('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    Route::get('/inventories/{id}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
    Route::patch('/inventories/{id}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::patch('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/rentals/{id}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
    Route::patch('/rentals/{id}', [RentalController::class, 'update'])->name('rentals.update');
    Route::delete('/rentals/{id}', [RentalController::class, 'destroy'])->name('rentals.destroy');

    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::patch('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});


