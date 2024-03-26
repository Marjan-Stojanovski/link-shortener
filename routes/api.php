<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/view/{short_url}', [App\Http\Controllers\ApiController::class, 'view']);
Route::post('/store-link', [App\Http\Controllers\ApiController::class, 'store']);

