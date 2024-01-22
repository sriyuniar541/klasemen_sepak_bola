<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlubController;
use App\Http\Controllers\SkorController;
use App\Http\Controllers\KlasemenController;

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


Route::get('/', [KlasemenController::class, 'index']);

// klub
Route::prefix('klub')->group(function () {
    Route::get('/', [KlubController::class, 'index']);
    Route::post('store', [KlubController::class, 'store']);
});

// skor
Route::prefix('skor')->group(function () {
    Route::get('/', [SkorController::class, 'index']);
    Route::get('create', [SkorController::class, 'create']);
    Route::post('store', [SkorController::class, 'store']);
});