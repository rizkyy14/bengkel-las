<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\BahanBakuController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\ProgresProyekController;

// Endpoint Publik (Login API)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Terproteksi (Butuh Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/pesanan', [PesananController::class, 'index']);
    Route::post('/pesanan', [PesananController::class, 'store']);

    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::post('/pelanggan', [PelangganController::class, 'store']);

    Route::get('/bahan-baku', [BahanBakuController::class, 'index']);
    Route::post('/bahan-baku', [BahanBakuController::class, 'store']);

    Route::post('/pembayaran', [PembayaranController::class, 'store']);
    Route::get('/pembayaran/{id_pesanan}', [PembayaranController::class, 'show']);

    Route::post('/progres', [ProgresProyekController::class, 'store']);
    Route::get('/progres/{id_pesanan}', [ProgresProyekController::class, 'show']);
});