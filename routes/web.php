<?php

use App\Http\Controllers\HostController;
use App\Http\Controllers\AdminHostController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\RefSiswaController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\RefProdukController;
use App\Http\Controllers\TransaksiLangsungController;

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
Route::get('/dashboard', [AdminHostController::class, 'index'])->middleware('auth:guru');

// guru
Route::get('/ref-guru', [ReferensiController::class, 'index'])->name('ref-guru')->middleware('auth:guru');
Route::post('/c_guru', [ReferensiController::class, 'storeGuru']);
Route::get('/d_guru/{id}', [ReferensiController::class, 'show'])->name('DetailGuru')->middleware('auth:guru');
Route::post('/u_guru', [ReferensiController::class, 'updateGuru']);

// siswa
Route::get('/ref-siswa', [RefSiswaController::class, 'index'])->name('ref-siswa')->middleware('auth:guru');
Route::post('/c_siswa', [RefSiswaController::class, 'storeSiswa']);
Route::get('/d_siswa/{id}', [RefSiswaController::class, 'show'])->name('DetailSiswa')->middleware('auth:guru');
Route::post('/u_siswa', [RefSiswaController::class, 'updateSiswa']);

// kelas
Route::get('/ref-kelas', [RefSiswaController::class, 'indexKelas'])->name('kelas')->middleware('auth:guru');
Route::get('/d-kelas/{id}', [RefSiswaController::class, 'indexDetailKelas'])->name('DetailKelas')->middleware('auth:guru');
Route::post('/c_kelas', [RefSiswaController::class, 'storeKelas']);

// wali
Route::get('/ref-wali', [WaliController::class, 'index'])->name('waliIndex')->middleware('auth:guru');
Route::get('/d_wali/{id}', [WaliController::class, 'show'])->name('Detailwali')->middleware('auth:guru');
Route::post('/c_wali', [WaliController::class, 'storeWali']);
Route::post('/u_wali', [WaliController::class, 'updateWali']);

// Produk Langsung
Route::get('/ref-produk-langsung', [RefProdukController::class, 'index'])->name('produkLangsungAll')->middleware('auth:guru');
Route::get('/ad_produk_langsung', [RefProdukController::class, 'indexTambah'])->name('produkLangsung')->middleware('auth:guru');
Route::post('/c_produk_langsung', [RefProdukController::class, 'storeProdukLangsung']);
Route::get('/set-kelas/{id}', [RefProdukController::class, 'showSetKelas'])->name('set-kelas')->middleware('auth:guru');
Route::post('/c_hub_kelas', [RefProdukController::class, 'storeHubKelas']);
Route::post('/c_hub_kelas_detail', [RefProdukController::class, 'storeHubKelasDetail']);
Route::post('/u_pembayaran', [RefProdukController::class, 'updateHubKelas']);
Route::post('/u_produk_langsung', [RefProdukController::class, 'updateProdukLangsung']);
Route::delete('/h_hubKelas/{HKelas:id}', [RefProdukController::class, 'destroyHub'])->middleware('auth:guru');
Route::delete('/h_hubKelasDetail/{HKelas:id}', [RefProdukController::class, 'destroyHubDetail'])->middleware('auth:guru');
Route::get('/d-produk-pembayaran/{id}', [RefProdukController::class, 'showDetailKelas'])->name('d-produk-pembayaran')->middleware('auth:guru');
Route::get('/d-rincian-pembayaran/{id}', [RefProdukController::class, 'showDetailRincian'])->name('d-rincian-pembayaran')->middleware('auth:guru');

// produk cicilan
Route::get('/ref-produk-cicilan', [RefProdukController::class, 'indexCicilan'])->name('produkCicilanAll')->middleware('auth:guru');
Route::get('/ad_produk_cicilan', [RefProdukController::class, 'indexTambahCicilan'])->name('produkCicilan')->middleware('auth:guru');
Route::post('/c_produk_cicilan', [RefProdukController::class, 'storeProdukCicilan']);
Route::get('/set-siswa/{id}', [RefProdukController::class, 'showSetSiswa'])->name('set-siswa')->middleware('auth:guru');
Route::post('/c_setSiswa', [RefProdukController::class, 'storeHubSiswa']);
Route::post('/c_setSiswaDetail', [RefProdukController::class, 'storeHubSiswaDetail']);
Route::get('/d_produk_cicilan/{id}', [RefProdukController::class, 'showDetailCicilan'])->name('Detail-cicilan')->middleware('auth:guru');
Route::post('/u_detail_cicilan', [RefProdukController::class, 'UpdateDetailCicilan'])->middleware('auth:guru');
Route::get('/add_hub_siswa/{id}', [RefProdukController::class, 'showDetailCicilanSiswa'])->name('add-Detail-cicilan')->middleware('auth:guru');

// transaksi

// offline
Route::get('/transaksi-offline', [TransaksiLangsungController::class, 'index'])->name('pilih-siswa')->middleware('auth:guru');
Route::get('/transaksi-siswa/{id}', [TransaksiLangsungController::class, 'indexTransaksiSiswa'])->name('transaksi-siswa')->middleware('auth:guru');
Route::post('/c_keranjang/{id}', [TransaksiLangsungController::class, 'storeKeranjang'])->middleware('auth:guru');
Route::delete('/h_keranjang/{HKelas:id}', [TransaksiLangsungController::class, 'destroyKeranjang'])->middleware('auth:guru');
Route::post('/u_set_keranjang', [TransaksiLangsungController::class, 'updateKeranjang'])->middleware('auth:guru');
Route::post('/u_end_keranjang', [TransaksiLangsungController::class, 'updateKeranjangCheckout'])->middleware('auth:guru');

Route::get('/transaksi-checkout-siswa/{id}', [TransaksiLangsungController::class, 'indexCheckoutSiswa'])->name('transaksi-checkout-siswa')->middleware('auth:guru');

// cicilan
Route::get('/transaksi-cicilan', [TransaksiLangsungController::class, 'indexCicilan'])->name('pilih-siswa-cicilan')->middleware('auth:guru');
Route::get('/transaksi-cicilan-siswa/{id}', [TransaksiLangsungController::class, 'indexCicilanSiswa'])->name('transaksi-siswa-cicilan')->middleware('auth:guru');
Route::get('/daftar-cicilan-siswa/{id}', [TransaksiLangsungController::class, 'indexCicilanDaftarSiswa'])->name('transaksi-siswa-cicilan')->middleware('auth:guru');
Route::post('/c_cicilans', [TransaksiLangsungController::class, 'storeCicilan'])->middleware('auth:guru');