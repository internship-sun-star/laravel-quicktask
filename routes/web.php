<?php

use App\Http\Controllers\ProductController;
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

Route::resource('users', UserController::class)->middleware([
    'auth',
    'admin',
]);

Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/create', 'create')->name('create');
    Route::get('/{product}', 'show')->name('show');
    Route::match(['PUT', 'PATCH'], '/{product}', 'update')->name('update');
    Route::delete('/{product}', 'destroy')->name('destroy');
    Route::get('/{product}/edit', 'edit')->name('edit');
});
