<?php

use App\Http\Controllers\HostController;

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
});

// user public
Route::get('/beranda', [HostController::class, 'index']);
Route::get('/produk-pembayaran', [HostController::class, 'indexProduk']);
Route::get('/detail-pembayaran', [HostController::class, 'indexDetail']);
