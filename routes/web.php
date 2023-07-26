<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/language/{lang}', [LanguageController::class, 'changePreferredLanguage'])->name('language');

Route::resource('users', UserController::class)
    ->middleware([
        'auth',
        'admin',
    ]);

Route::prefix('users')
    ->controller(ProductController::class)
    ->name('user-products.')
    ->group(function () {
        Route::get('/{user}/products', 'index')->name('index');
        Route::post('/{user}/products', 'store')->name('store');
        Route::get('/{user}/products/create', 'create')->name('create');
        Route::get('/{user}/products/{product}', 'show')->name('show');
        Route::match(['PUT', 'PATCH'], '/{user}/products/{product}', 'update')->name('update');
        Route::delete('/{user}/products/{product}', 'destroy')->name('destroy');
        Route::get('/{user}/products/{product}/edit', 'edit')->name('edit');
    });

require __DIR__ . '/auth.php';
