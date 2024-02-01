<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function akses()
    {
        return view('akses', [
        ]);
    }

    // logic login bawaan laravel
    public function authenticate(Request $request)
    {
        $credit = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('wali')->attempt($credit)) {
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }
 
        return back()->with('LoginError', 'Akses Masuk Salah, Periksa lagi akses masuknya!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function index()
    {
        $produkLangsung = DB::table('hub_produk_langsungs')
            ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
            ->join('siswas', 'hub_produk_langsungs.id_kelas', '=', 'siswas.id_kelas')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('produk_langsungs.id as IdProdukLangsung', 'produk_langsungs.versi', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'produk_langsungs.keterangan', 'produk_langsungs.priode_awal', 'produk_langsungs.priode_akhir', 'produk_langsungs.status', 'hub_produk_langsungs.id_kelas', 'siswas.nama', 'siswas.id as IdSiswa', 'orangtuawalis.nama as wali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $riwayatLangsung = DB::table('pesanans')
            ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
            ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
            ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('detail_pesanans.id_produk_langsung', 'detail_pesanans.id as idDetailPesanan', 'siswas.id as IdSiswa', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'pesanans.updated_at as tanggalBayar', 'pesanans.status', 'orangtuawalis.nama as namaOrangTuaWali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $produkCicilan = DB::table('hub_cicilans')
            ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
            ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan', 'siswas.nama', 'orangtuawalis.nama as wali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        
        return view('public.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
            'produks' => $produkLangsung,
            'cicilans' => $produkCicilan,
            'riwayats' => $riwayatLangsung
        ]);
    }
    
    public function indexProduk()
    {
        return view('public.produk', [
            'title' => 'Pembayaran',
            'active' => 'pembayaran',
        ]);
    }
    
    public function indexDetail()
    {
        return view('public.detail', [
            'title' => 'Detail Pembayaran',
            'active' => 'pembayaran',
        ]);
    }
    
    public function indexKeranjang()
    {
        return view('public.keranjang', [
            'title' => 'Keranjang',
            'active' => 'keranjang',
        ]);
    }
    
    public function indexPembayaran()
    {
        return view('public.pembayaran', [
            'title' => 'Pembayaran',
            'active' => 'keranjang',
        ]);
    }
    
    public function indexRiwayat()
    {
        return view('public.riwayat', [
            'title' => 'Riwayat',
            'active' => 'riwayat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
