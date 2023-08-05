<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [\App\Http\Controllers\Api\ProfilController::class, 'index']);
    });

    Route::group(['prefix' => 'paket'], function () {
        Route::get('/', [\App\Http\Controllers\Api\PaketController::class, 'index']);
        Route::get('/{id}', [\App\Http\Controllers\Api\PaketController::class, 'detail']);
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::match(['post', 'get'], '/', [\App\Http\Controllers\Api\TransaksiController::class, 'cart']);
        Route::post('/checkout', [\App\Http\Controllers\Api\TransaksiController::class, 'checkout']);
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::get('/', [\App\Http\Controllers\Api\TransaksiController::class, 'transactions']);
        Route::get('/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'transactionsDetail']);
        Route::post('/bayar/{id}', [\App\Http\Controllers\Api\TransaksiController::class, 'pembayaran']);
    });
});
