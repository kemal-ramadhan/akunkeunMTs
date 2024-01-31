<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Orangtuawali;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\HubCicilan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiLangsungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        return view('admin.transaksi.offline.index', [
            'title' => 'Transaksi Langsung Siswa',
            'active' => 'offline',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'total' => Siswa::count(),
            'totalKelas' => Kelas::count(),
        ]);
    }
    
    public function indexCicilan()
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        return view('admin.transaksi.offline.cicilan', [
            'title' => 'Transaksi Cicilan Siswa',
            'active' => 'offline',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'total' => Siswa::count(),
            'totalKelas' => Kelas::count(),
        ]);
    }
    
    public function indexTransaksiSiswa($id)
    {
        $siswa = DB::table('siswas')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $id)
                ->get();
        $keranjang = DB::table('keranjangs')
                ->join('produk_langsungs', 'keranjangs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('keranjangs.id', 'produk_langsungs.id as idProduk', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal')
                ->where('keranjangs.id_siswa', $id)
                ->where('keranjangs.status', 'Keranjang')
                ->get();
        $sumkeranjang = DB::table('keranjangs')
                ->where('keranjangs.id_siswa', $id)
                ->where('keranjangs.status', 'Keranjang')
                ->sum('nominal');
        $produkLangsung = DB::table('hub_produk_langsungs')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'hub_produk_langsungs.id_kelas', '=', 'siswas.id_kelas')
                ->select('produk_langsungs.id as IdProdukLangsung', 'produk_langsungs.versi', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'produk_langsungs.keterangan', 'produk_langsungs.priode_awal', 'produk_langsungs.priode_akhir', 'produk_langsungs.status', 'hub_produk_langsungs.id_kelas', 'siswas.nama')
                ->where('siswas.id', $id)
                ->get();
        $kelas = DB::table('hub_produk_langsungs')
                ->join('kelas', 'hub_produk_langsungs.id_kelas', '=', 'kelas.id')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'produk_langsungs.id as IdProduk', 'hub_produk_langsungs.id_kelas as IdKelas')
                ->get();
        $riwayat = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->select('detail_pesanans.id_produk_langsung', 'detail_pesanans.id as idDetailPesanan', 'siswas.id as IdSiswa', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'pesanans.updated_at as tanggalBayar', 'pesanans.status')
                ->where('siswas.id', $id)
                ->get();
        return view('admin.transaksi.offline.transaksi', [
            'title' => 'Transaksi Siswa | Transkasi Langsung',
            'active' => 'offline',
            'siswa' => $siswa,
            'kelass' => $kelas,
            'produklangsungs' => $produkLangsung,
            'keranjangs' => $keranjang,
            'sumkeranjang' => $sumkeranjang,
            'riwayats' => $riwayat
        ]);
    }
    
    public function indexCicilanSiswa($id)
    {
        $siswa = DB::table('siswas')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $id)
                ->get();
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_siswa', $id)
                ->get();
        return view('admin.transaksi.offline.transaksi_cicilan', [
            'title' => 'Transaksi Cicilan Siswa',
            'active' => 'offline',
            'siswa' => $siswa,
            'cicilans' => $produkCicilan
        ]);
    }
    
    public function indexCicilanDaftarSiswa($id)
    {
        $hubSiswa = HubCicilan::find($id);
        $siswa = DB::table('siswas')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $hubSiswa->id_siswa)
                ->get();
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_produk_cicilan', $hubSiswa->id_produk_cicilan)
                ->get();
        $riwayat = DB::table('cicilans')
                ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'cicilans.id_siswa', 'cicilans.nominal', 'cicilans.keterangan', 'cicilans.tanggal_bayar', 'cicilans.status')
                ->where('cicilans.id_produk_cicilan', $hubSiswa->id_produk_cicilan)
                ->where('cicilans.id_siswa', $hubSiswa->id_siswa)
                ->get();
        $totalBayar = DB::table('cicilans')
                ->where('cicilans.id_produk_cicilan', $hubSiswa->id_produk_cicilan)
                ->where('cicilans.id_siswa', $hubSiswa->id_siswa)
                ->sum('nominal');
        return view('admin.transaksi.offline.daftar_cicilan_siswa', [
            'title' => 'Transaksi Cicilan Siswa',
            'active' => 'offline',
            'siswa' => $siswa,
            'cicilan' => $produkCicilan,
            'riwayats' => $riwayat,
            'totalBayar' => $totalBayar
        ]);
    }
    
    public function indexCheckoutSiswa($id)
    {
        $siswa = DB::table('siswas')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $id)
                ->get();
        $keranjang = DB::table('keranjangs')
                ->join('produk_langsungs', 'keranjangs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('keranjangs.id', 'produk_langsungs.id as idProduk', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal')
                ->where('keranjangs.id_siswa', $id)
                ->get();
        $sumkeranjang = DB::table('keranjangs')
                ->where('keranjangs.id_siswa', $id)
                ->sum('nominal');
        return view('admin.transaksi.offline.checkout', [
            'title' => 'Checkout Pembayaran | Transkasi Langsung',
            'active' => 'offline',
            'siswa' => $siswa,
            'keranjangs' => $keranjang,
            'sumkeranjang' => $sumkeranjang
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
    
    public function storeKeranjang(Request $request, $id)
    {
        DB::table('keranjangs')->insertOrIgnore([
            'id_produk_langsung' => $id,
            'id_siswa' => $request->idSiswa,
            'nominal' => $request->nominal,
            'status' => 'Keranjang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('transaksi-siswa', ['id' => $request->idSiswa])->with('success', 'Pembayaran Telah dimasukan kedalam Keranjang!');

    }
    
    public function storeCicilan(Request $request)
    {
        DB::table('cicilans')->insertOrIgnore([
            'id_produk_cicilan' => $request->idProduk,
            'id_siswa' => $request->idSiswa,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal_bayar' => $request->tglBayar,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hub_cicilans')
        ->where('id', $request->IdCicilan)
        ->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);
        return redirect()->route('transaksi-siswa-cicilan', ['id' => $request->IdCicilan])->with('success', 'Pembayaran Cicilan Telah Diproses dan Disimpan!');

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
    
    public function updateKeranjang(Request $request)
    {
        
        DB::table('keranjangs')
        ->where('id_siswa', $request->idSiswa)
        ->update([
            'status' => 'Checkout',
            'updated_at' => now(),
        ]);
        return redirect()->route('transaksi-checkout-siswa', ['id' => $request->idSiswa])->with('success', 'Pembayaran Telah diproses, Silahkan konfirmasi dan lakukan pembayaran!');
    }
    
    public function updateKeranjangCheckout(Request $request)
    {
        DB::table('pesanans')->insertOrIgnore([
            'id_siswa' => $request->idSiswa,
            'nominal' => $request->nominal,
            'status' => 'Telah Dibayarkan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastPesanan = Pesanan::max('id');

        $num = $request->totalProduk;
        for ($i=0; $i < $num; $i++) { 
            $idProduk = 'idProduk_' . $i;
            $nominal = 'nominal_' . $i;
            $idKeranjang = 'idKeranjang_' . $i;
            DB::table('detail_pesanans')->insertOrIgnore([
                'id_pesanan' => $lastPesanan,
                'id_produk_langsung' => $request->$idProduk,
                'nominal' => $request->$nominal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Keranjang::destroy($idKeranjang);
        }
        return redirect()->route('pilih-siswa')->with('success', 'Pembayaran Telah diproses!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function destroyKeranjang(Request $request, $id)
    {
        Keranjang::destroy($id);
        return redirect()->route('transaksi-siswa', ['id' => $request->idSiswa])->with('success', 'Data Telah Dihapus');
    }
}
