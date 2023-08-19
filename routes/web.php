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


Route::match(['GET','POST'],'login',[\App\Http\Controllers\LoginController::class,'index'])->name('login');
Route::get('logout',[\App\Http\Controllers\LoginController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function (){

    Route::get(
        '/',
        function () {
            return view('admin.dashboard.index');
        }
    )->name('dashboard');
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
    Route::prefix('transaksi')->group(
        function () {
            Route::get('/datatable', [\App\Http\Controllers\TransaksiController::class, 'datatable'])->name('transaksi.datatable');
            Route::match(['POST', 'GET'], '/', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi');
            Route::get('detail/{id}',[\App\Http\Controllers\TransaksiController::class,'detail']);
            Route::post('detail/{id}/change-status',[\App\Http\Controllers\TransaksiController::class,'changeStatus'])->name('changeStatus');
            Route::post('detail/{id}/change-weight',[\App\Http\Controllers\TransaksiController::class,'changeBerat'])->name('changeWeight');
        }
    );

    Route::prefix('laporan')->group(function (){
        Route::get('',[\App\Http\Controllers\LaporanController::class,'index'])->name('laporan');
        Route::get('datatable',[\App\Http\Controllers\LaporanController::class,'datatable'])->name('laporan.datatable');
        Route::get('cetak',[\App\Http\Controllers\LaporanController::class,'cetakLaporan'])->name('laporan.cetak');
    });
});
