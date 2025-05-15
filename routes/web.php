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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
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

Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/create', [ActorController::class, 'create'])->name('actors.create');
Route::post('/actors/store', [ActorController::class, 'store'])->name('actors.store');
Route::get('/actors/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
Route::delete('/actors/{id}', [ActorController::class, 'destroy'])->name('actors.destroy');
Route::patch('/actors/{id}', [ActorController::class, 'update'])->name('actors.update');

Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
Route::post('/countries/store', [CountryController::class, 'store'])->name('countries.store');
Route::get('/countries/{id}/edit', [CountryController::class, 'edit'])->name('countries.edit');
Route::delete('/countries/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');
Route::patch('/countries/{id}', [CountryController::class, 'update'])->name('countries.update');

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::post('/cities/store', [CityController::class, 'store'])->name('cities.store');
Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');
Route::patch('/cities/{id}', [CityController::class, 'update'])->name('cities.update');

Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
Route::get('/addresses/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('/addresses/store', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/addresses/{id}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('addresses.destroy');
Route::patch('/addresses/{id}', [AddressController::class, 'update'])->name('addresses.update');

Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/create', [StoreController::class, 'create'])->name('stores.create');
Route::post('/stores/store', [StoreController::class, 'store'])->name('stores.store');
Route::get('/stores/{id}/edit', [StoreController::class, 'edit'])->name('stores.edit');
Route::delete('/stores/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');
Route::patch('/stores/{id}', [StoreController::class, 'update'])->name('stores.update');

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::patch('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');

Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
Route::post('/inventories/store', [InventoryController::class, 'store'])->name('inventories.store');
Route::get('/inventories/{id}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
Route::delete('/inventories/{id}', [InventoryController::class, 'destroy'])->name('inventories.destroy');
Route::patch('/inventories/{id}', [InventoryController::class, 'update'])->name('inventories.update');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
Route::patch('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update');

Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
Route::post('/rentals/store', [RentalController::class, 'store'])->name('rentals.store');
Route::get('/rentals/{id}/edit', [RentalController::class, 'edit'])->name('rentals.edit');
Route::delete('/rentals/{id}', [RentalController::class, 'destroy'])->name('rentals.destroy');
Route::patch('/rentals/{id}', [RentalController::class, 'update'])->name('rentals.update');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
Route::patch('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');

Route::get('/films/dohvati/{id}', [FilmController::class, 'dohvati']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
