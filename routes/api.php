<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthAdminOwner;
use App\Http\Middleware\AuthAdminKasir;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::middleware([AuthAdmin::class])->prefix('user')->group(function(){
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::middleware([AuthAdminKasir::class])->prefix('member')->group(function () {
    Route::post('/', [MemberController::class, 'store']);
    Route::get('/', [MemberController::class, 'index']);
    Route::get('/{id}', [MemberController::class, 'show']);
    Route::put('/{id}', [MemberController::class, 'update']);
    Route::delete('/{id}', [MemberController::class, 'destroy']);
});

Route::middleware([AuthAdmin::class])->prefix('paket')->group(function () {
    Route::post('/', [PaketController::class, 'store']);
    Route::get('/', [PaketController::class, 'index']);
    Route::put('/{id}', [PaketController::class, 'update']);
    Route::delete('/{id}', [PaketController::class, 'destroy']);
});

Route::middleware([AuthAdmin::class])->prefix('outlet')->group(function () {
    Route::post('/', [OutletController::class, 'store']);
    Route::get('/', [OutletController::class, 'index']);
    Route::put('/{id}', [OutletController::class, 'update']);
    Route::delete('/{id}', [OutletController::class, 'destroy']);
});

Route::middleware([AuthAdminOwner::class])->prefix('outlet')->group(function () {
    Route::get('/owner/{id}', [OutletController::class, 'information']);
});

Route::middleware([AuthAdminKasir::class])->prefix('transaksi')->group(function () {
    Route::post('/', [TransaksiController::class, 'store']);
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/{id}', [TransaksiController::class, 'show']);
    Route::put('/bayar/{id}', [TransaksiController::class, 'updateBayar']);
    Route::put('/status/{id}', [TransaksiController::class, 'updateStatus']);
});