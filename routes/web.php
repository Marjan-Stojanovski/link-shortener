<?php

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

Route::middleware('web')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('/add-new-link', [App\Http\Controllers\HomeController::class, 'add_link'])->name('home.add.link');
    Route::get('/view/{short_url}', [App\Http\Controllers\HomeController::class, 'view'])->name('home.view');
    Route::post('/store-link', [App\Http\Controllers\LinkController::class, 'store'])->name('store.link');
});
