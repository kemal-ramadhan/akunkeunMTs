<?php

use App\Http\Controllers\HostController;
use App\Http\Controllers\AdminHostController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\WaliController;

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
    return view('akses');
})->name('akses');
Route::post('/akses', [AdminHostController::class, 'authenticate']);
Route::post('/logout', [AdminHostController::class, 'logout']);

// user public
Route::get('/beranda', [HostController::class, 'index']);
Route::get('/produk-pembayaran', [HostController::class, 'indexProduk']);
Route::get('/detail-pembayaran', [HostController::class, 'indexDetail']);
Route::get('/keranjang', [HostController::class, 'indexKeranjang']);
Route::get('/pembayaran', [HostController::class, 'indexPembayaran']);
Route::get('/riwayat', [HostController::class, 'indexRiwayat']);


// user admin

// get
Route::get('/administrator', [AdminHostController::class, 'akses']);
Route::get('/dashboard', [AdminHostController::class, 'index'])->middleware('auth:guru');;

Route::get('/ref-guru', [ReferensiController::class, 'index'])->middleware('auth:guru');;

// wali
Route::get('/ref-wali', [WaliController::class, 'index'])->name('waliIndex')->middleware('auth:guru');;
Route::get('/d_wali/{id}', [WaliController::class, 'show'])->name('Detailwali')->middleware('auth:guru');;

Route::post('/c_wali', [WaliController::class, 'storeWali']);
Route::post('/u_wali', [WaliController::class, 'updateWali']);