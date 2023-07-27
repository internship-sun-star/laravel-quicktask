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

Route::prefix('users')
    ->middleware([
        'auth',
        'admin',
    ])
    ->group(function () {
        Route::name('users.')
            ->controller(UserController::class)
            ->group(function () {
                Route::get('', 'index')->name('index');
                Route::post('', 'store')->name('store');
                Route::get('/{id}', 'find')->name('find')->where('id', '\d+');
                Route::put('/{id}', 'update')->name('update')->where('id', '\d+');
                Route::delete('/{id}', 'destroy')->name('destroy')->where('id', '\d+');
            });

        Route::name('user-products.')
            ->controller(ProductController::class)
            ->group(function () {
                Route::get('/{user}/products', 'index')->name('index');
                Route::post('/{user}/products', 'store')->name('store');
                Route::get('/{user}/products/create', 'create')->name('create');
                Route::get('/{user}/products/{id}', 'find')->name('find')->where('id', '\d+');
                Route::put('/{user}/products/{id}', 'update')->name('update')->where('id', '\d+');
                Route::delete('/{user}/products/{id}', 'destroy')->name('destroy')->where('id', '\d+');
            });
    });

require __DIR__ . '/auth.php';
