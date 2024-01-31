<?php

namespace App\Http\Controllers;

use App\Models\Versi;
use App\Models\ProdukLangsung;
use App\Models\PembayaranCicilan;
use App\Models\Kelas;
use App\Models\HubProdukLangsung;
use App\Models\HubCicilan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = DB::table('produk_langsungs')
                ->join('versis', 'produk_langsungs.versi', '=', 'versis.id')
                ->select('produk_langsungs.id as IdProdukPem', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'produk_langsungs.keterangan', 'produk_langsungs.priode_awal', 'produk_langsungs.priode_akhir', 'versis.nama_versi', 'produk_langsungs.status')
                ->get();
        $kelas = DB::table('hub_produk_langsungs')
                ->join('kelas', 'hub_produk_langsungs.id_kelas', '=', 'kelas.id')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'produk_langsungs.id as IdProduk', 'hub_produk_langsungs.id_kelas as IdKelas')
                ->get();
        return view('admin.based.produk.index', [
            'title' => 'Data Produk Pembayaran',
            'active' => 'produk',
            'pembayarans' => $produk,
            'kelass' => $kelas,
            'total' => ProdukLangsung::count()
        ]);
    }
    
    public function indexCicilan()
    {
        return view('admin.based.cicilan.index', [
            'title' => 'Data Produk Cicilan Pembayaran',
            'active' => 'produk',
            'cicilans' => PembayaranCicilan::all(),
            'total' => PembayaranCicilan::count()
        ]);
    }
    
    public function indexTambah()
    {
        return view('admin.based.produk.tambah', [
            'title' => 'Tambah Produk Pembayaran',
            'active' => 'produk',
            'versis' => Versi::all(),
        ]);
    }
    
    public function indexTambahCicilan()
    {
        return view('admin.based.cicilan.tambah', [
            'title' => 'Tambah Produk Cicilan Pembayaran',
            'active' => 'produk',
            'versis' => Versi::all(),
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
    
    public function storeProdukLangsung(Request $request)
    {
        DB::table('produk_langsungs')->insertOrIgnore([
            'versi' => $request->versi,
            'nama_produk_pembayaran' => $request->pembayaran,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'priode_awal' => $request->priodeAwal,
            'priode_akhir' => $request->priodeAkhir,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastProduk = ProdukLangsung::max('id');
        return redirect()->route('set-kelas', ['id' => $lastProduk])->with('success', 'Pembayaran Baru telah dibuat!, Atur Kelas Mana saja yang harus membayar!');
    }
    
    public function storeProdukCicilan(Request $request)
    {
        DB::table('pembayaran_cicilans')->insertOrIgnore([
            'versi' => $request->versi,
            'nama_cicilan' => $request->cicilan,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'priode_awal' => $request->priodeAwal,
            'priode_akhir' => $request->priodeAkhir,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastProduk = PembayaranCicilan::max('id');
        return redirect()->route('set-siswa', ['id' => $lastProduk])->with('success', 'Pembayaran Cicilan Baru telah dibuat!, Atur Siswa Mana saja yang harus membayar!');
    }
    
    public function storeHubKelas(Request $request)
    {
        DB::table('hub_produk_langsungs')->insertOrIgnore([
            'id_produk_langsung' => $request->idPembayaran,
            'id_kelas' => $request->kelas,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('set-kelas', ['id' => $request->idPembayaran])->with('success', 'Kelas Telah Ditambahkan!');
    }
    
    public function storeHubKelasDetail(Request $request)
    {
        DB::table('hub_produk_langsungs')->insertOrIgnore([
            'id_produk_langsung' => $request->idPembayaran,
            'id_kelas' => $request->kelas,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('d-produk-pembayaran', ['id' => $request->idPembayaran])->with('success', 'Kelas Telah Ditambahkan!');
    }
    
    public function storeHubSiswa(Request $request)
    {
        $num = $request->TotalSiswa;
        for ($i=0; $i < $num; $i++) { 
            $idSiswa = 'siswa_' . $i;
            if ($request->$idSiswa != null) {
                DB::table('hub_cicilans')->insertOrIgnore([
                    'id_produk_cicilan' => $request->IdCicilanProduk,
                    'id_siswa' => $request->$idSiswa,
                    'status' => 'Cicilan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        DB::table('pembayaran_cicilans')
        ->where('id', $request->IdCicilanProduk)
        ->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('produkCicilanAll')->with('success', 'Siswa Telah Di Set dan Telah Ditambahkan!');
    }
    
    public function storeHubSiswaDetail(Request $request)
    {
        $num = $request->TotalSiswa;
        for ($i=0; $i < $num; $i++) { 
            $idSiswa = 'siswa_' . $i;
            if ($request->$idSiswa != null) {
                DB::table('hub_cicilans')->insertOrIgnore([
                    'id_produk_cicilan' => $request->IdCicilanProduk,
                    'id_siswa' => $request->$idSiswa,
                    'status' => 'Cicilan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('Detail-cicilan', ['id' => $request->IdCicilanProduk])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    public function showSetKelas($id)
    {
        $hubKelas = DB::table('hub_produk_langsungs')
                ->join('kelas', 'hub_produk_langsungs.id_kelas', '=', 'kelas.id')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('hub_produk_langsungs.id', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'produk_langsungs.nama_produk_pembayaran')
                ->where('hub_produk_langsungs.id_produk_langsung', $id)
                ->get();
        return view('admin.based.produk.hubKelas', [
            'title' => 'Set Pembayaran Siswa',
            'active' => 'produk',
            'pembayaran' => ProdukLangsung::find($id),
            'kelass' => Kelas::all(),
            'hubKelass' => $hubKelas
        ]);
    }
    
    public function showSetSiswa($id)
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        return view('admin.based.cicilan.hubsiswa', [
            'title' => 'Set Pembayaran Siswa',
            'active' => 'produk',
            'cicilan' => PembayaranCicilan::find($id),
            'siswas' => $siswa,
        ]);
    }
    
    public function showDetailCicilanSiswa($id)
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();  
        $hubsiswa = DB::table('hub_cicilans')
                ->select('hub_cicilans.id', 'hub_cicilans.id_produk_cicilan', 'hub_cicilans.id_siswa')
                ->where('hub_cicilans.id_produk_cicilan', $id)
                ->get();
        return view('admin.based.cicilan.tambah_siswa', [
            'title' => 'Set Pembayaran Siswa Baru',
            'active' => 'produk',
            'cicilan' => PembayaranCicilan::find($id),
            'siswas' => $siswa,
            'hubsiswas' => $hubsiswa
        ]);
    }
    
    public function showDetailKelas($id)
    {
        $hubKelas = DB::table('hub_produk_langsungs')
                ->join('kelas', 'hub_produk_langsungs.id_kelas', '=', 'kelas.id')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('hub_produk_langsungs.id', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'produk_langsungs.nama_produk_pembayaran')
                ->where('hub_produk_langsungs.id_produk_langsung', $id)
                ->get();
        return view('admin.based.produk.detail', [
            'title' => 'Detail Pembayaran Siswa',
            'active' => 'produk',
            'pembayaran' => ProdukLangsung::find($id),
            'kelass' => Kelas::all(),
            'hubKelass' => $hubKelas,
            'versis' => Versi::all(),
        ]);
    }
    
    public function showDetailRincian($id)
    {
        $riwayat = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->select('detail_pesanans.id as idDetailPesanan', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'pesanans.updated_at as tanggalBayar', 'pesanans.status')
                ->where('detail_pesanans.id_produk_langsung', $id)
                ->get();
        return view('admin.based.produk.riwayat', [
            'title' => 'Riwayat Pembayaran Siswa',
            'active' => 'produk',
            'pembayaran' => ProdukLangsung::find($id),
            'riwayats' => $riwayat
        ]);
    }
    
    public function showDetailCicilan($id)
    {
        $siswa = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('pembayaran_cicilans.id', 'siswas.nisn', 'siswas.nis', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tahun_masuk', 'siswas.status', 'hub_cicilans.status as statusCicilan', 'hub_cicilans.id as idcheck')
                ->where('pembayaran_cicilans.id', $id)
                ->get();
        $newsiswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        return view('admin.based.cicilan.detail', [
            'title' => 'Detail Cicilan Pembayaran Siswa',
            'active' => 'produk',
            'cicilan' => PembayaranCicilan::find($id),
            'versis' => Versi::all(),
            'siswas' => $siswa,
            'newsiswas' => $newsiswa,
        ]);
    }
    
    public function showRiwayatCicilan($id)
    {
        $siswa = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('pembayaran_cicilans.id', 'siswas.nisn', 'siswas.nis', 'siswas.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tahun_masuk', 'siswas.status', 'hub_cicilans.status as statusCicilan', 'hub_cicilans.id as idcheck')
                ->where('pembayaran_cicilans.id', $id)
                ->get();
        $totalAllCicilan = DB::table('cicilans')
                ->where('id_produk_cicilan', $id)
                ->sum('nominal');
        return view('admin.based.cicilan.riwayat', [
            'title' => 'Detail Riwayat Cicilan Pembayaran Siswa',
            'active' => 'produk',
            'cicilan' => PembayaranCicilan::find($id),
            'versis' => Versi::all(),
            'siswas' => $siswa,
            'totalCicilan' => $totalAllCicilan
        ]);
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
    
    public function updateHubKelas(Request $request)
    {
        DB::table('produk_langsungs')
        ->where('id', $request->idProduk)
        ->update([
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('produkLangsungAll')->with('success', 'Data Telah Ditambahkan!');
    }
    
    public function updateProdukLangsung(Request $request)
    {
        DB::table('produk_langsungs')
        ->where('id', $request->idProduk)
        ->update([
            'versi' => $request->versi,
            'nama_produk_pembayaran' => $request->pembayaran,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'priode_awal' => $request->priodeAwal,
            'priode_akhir' => $request->priodeAkhir,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('produkLangsungAll')->with('success', 'Data Telah Ditambahkan!');
    }
    
    public function UpdateDetailCicilan(Request $request)
    {
        DB::table('pembayaran_cicilans')
        ->where('id', $request->idProdukCicilan)
        ->update([
            'versi' => $request->versi,
            'nama_cicilan' => $request->cicilan,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'priode_awal' => $request->priodeAwal,
            'priode_akhir' => $request->priodeAkhir,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        $num = $request->TotalSiswa;
        for ($i=0; $i < $num; $i++) { 
            $idSiswa = 'siswa_' . $i;
            $nilai = $request->$idSiswa;
            HubCicilan::destroy($nilai);
        }

        return redirect()->route('Detail-cicilan', ['id' => $request->idProdukCicilan])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function destroyHub(Request $request, $id)
    {
        HubProdukLangsung::destroy($id);
        return redirect()->route('set-kelas', ['id' => $request->IdPembayaran])->with('success', 'Data Telah DiHapus!');
    }
    
    public function destroyHubDetail(Request $request, $id)
    {
        HubProdukLangsung::destroy($id);
        return redirect()->route('d-produk-pembayaran', ['id' => $request->IdPembayaran])->with('success', 'Data Telah DiHapus!');
    }
}
