<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(
    '/',
    function () {
        return view('admin.dashboard.index');
    }
);

Route::prefix('paket')->group(
    function () {
        Route::get('/datatable', [\App\Http\Controllers\PaketController::class, 'datatable'])->name('paket.datatable');
        Route::match(['POST', 'GET'], '/', [\App\Http\Controllers\PaketController::class, 'index'])->name('paket');

    }
);

Route::prefix('user')->group(
    function () {
        Route::get('/datatable', [\App\Http\Controllers\UserController::class, 'datatable'])->name('user.datatable');
        Route::match(['POST', 'GET'], '/', [\App\Http\Controllers\UserController::class, 'index'])->name('user');
    }
);


Route::prefix('admin')->group(
    function () {
        Route::get('/datatable', [\App\Http\Controllers\AdminController::class, 'datatable'])->name('admin.datatable');
        Route::match(['POST', 'GET'], '/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    }
);
