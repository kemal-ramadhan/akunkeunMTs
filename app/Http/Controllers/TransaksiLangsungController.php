<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Orangtuawali;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\HubCicilan;
use App\Models\Cicilan;

use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransaksiLangsungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        $selectKelas = DB::table('hub_kelas_siswas')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'hub_kelas_siswas.id_siswa')
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->get();
        return view('admin.transaksi.offline.index', [
            'title' => 'Transaksi Langsung Siswa',
            'active' => 'offline',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'total' => Siswa::count(),
            'totalKelas' => Kelas::where('id_versi', session('versi'))->count(),
            'selectkelas' => $selectKelas,
        ]);
    }
    
    public function indexCicilan()
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->get();
        return view('admin.transaksi.offline.cicilan', [
            'title' => 'Transaksi Cicilan Siswa',
            'active' => 'offline',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'total' => Siswa::count(),
            'totalKelas' => Kelas::where('id_versi', session('versi'))->count(),
        ]);
    }
    
    public function indexTransaksiSiswa($id)
    {
        $siswa = DB::table('hub_kelas_siswas')
                ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas')
                ->where('siswas.id', $id)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->first();
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
                ->join('hub_kelas_siswas', 'hub_produk_langsungs.id_kelas', '=', 'hub_kelas_siswas.id_kelas')
                ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->select('produk_langsungs.id AS IdProdukLangsung', 
                        'produk_langsungs.versi', 
                        'produk_langsungs.nama_produk_pembayaran', 
                        'produk_langsungs.nominal', 
                        'produk_langsungs.keterangan', 
                        'produk_langsungs.priode_awal', 
                        'produk_langsungs.priode_akhir', 
                        'produk_langsungs.status', 
                        'hub_produk_langsungs.id_kelas', 
                        'siswas.nama')
                ->where('siswas.id', $id)
                ->where('produk_langsungs.versi', session('versi'))
                ->get();
        $kelas = DB::table('hub_produk_langsungs')
                ->join('kelas', 'hub_produk_langsungs.id_kelas', '=', 'kelas.id')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'produk_langsungs.id as IdProduk', 'hub_produk_langsungs.id_kelas as IdKelas')
                ->get();
        $riwayat = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->select('detail_pesanans.id_produk_langsung', 'detail_pesanans.id as idDetailPesanan', 'siswas.id as IdSiswa', 'siswas.nama', 'pesanans.updated_at as tanggalBayar', 'pesanans.status')
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
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $id)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
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
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id', $hubSiswa->id_siswa)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->get();
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_produk_cicilan', $hubSiswa->id_produk_cicilan)
                ->where('hub_cicilans.id_siswa', $hubSiswa->id_siswa)
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
            'totalBayar' => $totalBayar,
            'idCheck' => $hubSiswa
        ]);
    }
    
    public function invoiceCicilan($id)
    {
        $hubSiswa = HubCicilan::find($id);
        $siswa = DB::table('hub_kelas_siswas')
                ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas')
                ->where('siswas.id', $hubSiswa->id_siswa)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->first();
        // $siswa = DB::table('siswas')
        //         ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        //         ->select('siswas.id', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
        //         ->where('siswas.id', $hubSiswa->id_siswa)
        //         ->first();
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_produk_cicilan', $hubSiswa->id_produk_cicilan)
                ->where('hub_cicilans.id_siswa', $hubSiswa->id_siswa)
                ->first();
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

        // Buat objek Dompdf baru
        $dompdf = new Dompdf();

        // Kemungkinan konfigurasi tambahan
        $options = new Options();
        $options->set('defaultPaperSize', 'A4'); // Atur ukuran kertas menjadi A4
        $dompdf = new Dompdf($options);

        // Render view menjadi HTML dengan data pengguna
        $html = view('templateExport.invoiceCicilan', [
            'siswa' => $siswa,
            'cicilan' => $produkCicilan,
            'riwayats' => $riwayat,
            'totalBayar' => $totalBayar,
            'idCheck' => $hubSiswa
        ]);

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // // Simpan PDF ke penyimpanan sementara
        $namaFile = 'Invoice Cicilan - ' . time() . '.pdf'; // Nama file unik
        Storage::put('public/struk/' . $namaFile, $dompdf->output());

        // Logika bisnis atau operasi lainnya
        return $dompdf->stream($namaFile);
    }
    
    public function indexCheckoutSiswa($id)
    {
        $siswa = DB::table('hub_kelas_siswas')
                ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas')
                ->where('siswas.id', $id)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->first();
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
            Keranjang::destroy($request->$idKeranjang);
        }

        $this->unduhStruk($lastPesanan);

        return redirect()->route('invoice', ['id' => $lastPesanan])->with('success', 'Pembayaran Telah diproses!');

    }

    public function unduhStruk($lastPesanan)
    {
        $siswa = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('pesanans.id AS IdPesanan', 
                        'siswas.nama', 
                        'kelas.nama_kelas', 
                        'kelas.kelas_romawi_angka_abjad', 
                        'pesanans.updated_at AS tglBayar')
                ->where('pesanans.id', $lastPesanan)
                ->first();

        // $siswa = DB::table('pesanans')
        //         ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
        //         ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
        //         ->select('pesanans.id as IdPesanan', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'pesanans.updated_at as tglBayar')
        //         ->where('pesanans.id', $lastPesanan)
        //         ->first();
        $keranjang = DB::table('detail_pesanans')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('produk_langsungs.nama_produk_pembayaran', 'detail_pesanans.nominal')
                ->where('detail_pesanans.id_pesanan', $lastPesanan)
                ->get();
        $sumkeranjang = DB::table('detail_pesanans')
                ->where('detail_pesanans.id_pesanan', $lastPesanan)
                ->sum('detail_pesanans.nominal');


        // Buat objek Dompdf baru
        $dompdf = new Dompdf();

        // Kemungkinan konfigurasi tambahan
        $options = new Options();
        $options->set('defaultPaperWidth', 50); // lebar dalam mm
        $options->set('defaultPaperHeight', 162); // panjang dalam mm
        $options->set('defaultPaperOrientation', 'portrait'); // orientasi potret
        $dompdf->setOptions($options);

        // Render view menjadi HTML dengan data pengguna
        $html = view('templateExport.struk', [
            'siswa' => $siswa,
            'keranjangs' => $keranjang,
            'sumkeranjang' => $sumkeranjang
        ]);

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // // Simpan PDF ke penyimpanan sementara
        $namaFile = 'struk_' . time() . '.pdf'; // Nama file unik
        Storage::put('public/struk/' . $namaFile, $dompdf->output());
        DB::table('pesanans')
        ->where('id', $lastPesanan)
        ->update([
            'invoice' => $namaFile,
        ]);

        // Logika bisnis atau operasi lainnya
        return $dompdf->stream($namaFile);
    }

    public function invoice($id)
    {
        return view('admin.transaksi.offline.printStruk', [
            'title' => 'Invoice',
            'active' => 'offline',
            'invoice' => Pesanan::find($id)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function destroyCicilan($idCicilan, $idSiswa)
    {
        Cicilan::destroy($idCicilan);
        return redirect()->route('transaksi-siswa-cicilan', ['id' => $idSiswa])->with('success', 'Data Telah Dihapus');
    }
    
    public function destroyKeranjang(Request $request, $id)
    {
        Keranjang::destroy($id);
        return redirect()->route('transaksi-siswa', ['id' => $request->idSiswa])->with('success', 'Data Telah Dihapus');
    }
}
