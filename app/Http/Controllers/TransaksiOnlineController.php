<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status = 'Menunggu Konfirmasi')
    {
        $antrians = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.status', $status)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.updated_at as tglBayar', 'pesanans.id as idPesanan')
                ->get();
        $sumantrian = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.status', 'Menunggu Konfirmasi')
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.updated_at as tglBayar', 'pesanans.id as idPesanan')
                ->count();
        $sumselesai = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.status', 'Telah Dibayarkan')
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.updated_at as tglBayar', 'pesanans.id as idPesanan')
                ->count();
        return view('admin.transaksi.online.index', [
            'title' => 'Antiran Pembayaran Siswa',
            'active' => 'online',
            'antrians' => $antrians,
            'sumantrian' => $sumantrian,
            'sumselesai' => $sumselesai
        ]);
    }
    
    public function detail($id)
    {
        $detailPesanan = DB::table('pesanans')
                ->join('pembayarans', 'pembayarans.id_Pesanan', '=', 'pesanans.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->where('pesanans.id', $id)
                ->select('pesanans.id as idPesanan', 'pesanans.status', 'pembayarans.tanggal_bayar', 'siswas.nama')
                ->get();
        $bukti = Pembayaran::where('id_Pesanan', $id)->first();
        $riwayat = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.id', $id)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.id as idPesanan')
                ->get();
        return view('admin.transaksi.online.detail', [
            'title' => 'Pembayaran Siswa',
            'active' => 'online',
            'detail' => $detailPesanan,
            'bukti' => $bukti,
            'riwayats' => $riwayat
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
