<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Versi;
use App\Models\Orangtuawali;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.based.siswa.index', [
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'kelass' =>  Kelas::where('id_versi', session('versi'))->get(),
            'walis' => Orangtuawali::all(),
            'siswas' => Siswa::all(),
            'total' => Siswa::count(),
        ]);
    }
    
    
    public function indexKelas()
    {
        $kelas = DB::table('kelas')
                ->join('gurus', 'gurus.id', '=', 'kelas.id_guru')
                ->select('kelas.id', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'kelas.keterangan', 'gurus.nama')
                ->where('id_versi', session('versi'))
                ->get();

        return view('admin.based.siswa.kelas', [
            'title' => 'Data Kelas',
            'active' => 'siswa',
            'kelass' => $kelas,
            'gurus' => Guru::all(),
            'total' => Kelas::where('id_versi', session('versi'))->count(),
        ]);
    }
    
    public function indexDetailKelas($id)
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->where('kelas.id', $id)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->get();
        $kelas = DB::table('kelas')
                ->join('gurus', 'gurus.id', '=', 'kelas.id_guru')
                ->select('kelas.id', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'kelas.keterangan', 'gurus.nama')
                ->where('kelas.id', $id)
                ->get();
        return view('admin.based.siswa.detailkelas', [
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'details' => $kelas
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
    
    public function storeSiswa(Request $request)
    {
        DB::table('siswas')->insertOrIgnore([
            'id_ortu' => $request->orangTua,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempat,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telepon' => $request->noTlp,
            'tahun_masuk' => $request->tahunMasuk,
            'tahun_keluar' => $request->tahunKeluar,
            'tahun_keluar' => $request->tahunKeluar,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastsiswa = Siswa::max('id');
        
        DB::table('hub_kelas_siswas')->insertOrIgnore([
            'id_siswa' => $lastsiswa,
            'id_kelas' => $request->kelas,
            'id_versi' => session('versi'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ref-siswa')->with('success', 'Data Telah Ditambahkan!');
    }

    public function storeKelas(Request $request)
    {
        DB::table('kelas')->insertOrIgnore([
            'id_guru' => $request->guru,
            'id_versi' => session('versi'),
            'nama_kelas' => $request->nama,
            'kelas_romawi_angka_abjad' => $request->kelas,
            'keterangan' => $request->Keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kelas')->with('success', 'Data Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->select('siswas.id', 'siswas.nisn', 'siswas.alamat', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.id as IdWali', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->where('siswas.id', $id)
                ->get();
        
        $RiwayatKelas = DB::table('hub_kelas_siswas')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->join('gurus', 'kelas.id_guru', '=', 'gurus.id')
                ->join('versis', 'hub_kelas_siswas.id_versi', '=', 'versis.id')
                ->select('kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'gurus.nama', 'hub_kelas_siswas.id', 'hub_kelas_siswas.id_versi', 'versis.nama_versi')
                ->where('hub_kelas_siswas.id_siswa', $id)
                ->get();
        
        $kelasSelect = DB::table('hub_kelas_siswas')
                ->select('hub_kelas_siswas.id', 'hub_kelas_siswas.id_kelas', 'hub_kelas_siswas.id_versi')
                ->where('hub_kelas_siswas.id_siswa', $id)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->first();
        
        $Riwayat = DB::table('pesanans')
                ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('produk_langsungs.nama_produk_pembayaran', 'pesanans.updated_at', 'pesanans.status', 'detail_pesanans.id_produk_langsung')
                ->where('pesanans.status', 'Telah Dibayarkan')
                ->where('pesanans.id_siswa', $id)
                ->get();
        $produkLangsung = DB::table('hub_produk_langsungs')
                ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('hub_kelas_siswas', 'hub_produk_langsungs.id_kelas', '=', 'hub_kelas_siswas.id_kelas')
                ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->select('produk_langsungs.id AS IdProdukLangsung', 
                        'produk_langsungs.versi', 
                        'produk_langsungs.nama_produk_pembayaran', 
                        'produk_langsungs.nominal', 
                        'produk_langsungs.status', 
                        'hub_produk_langsungs.id_kelas', 
                        'siswas.id as IdSiswa',
                        'siswas.nama')
                ->where('siswas.id', $id)
                ->where('produk_langsungs.versi', session('versi'))
                ->get();
        return view('admin.based.siswa.detail', [
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'siswa' => $siswa,
            'kelass' =>  Kelas::where('id_versi', session('versi'))->get(),
            'riwayatkelass' => $RiwayatKelas,
            'kelasselect' => $kelasSelect,
            'walis' => Orangtuawali::all(),
            'riwayats' => $Riwayat,
            'tagihans' => $produkLangsung,
            'versi' => Versi::find(session('versi')),
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
    
    public function updateSiswa(Request $request)
    {
        $kelasSelect = DB::table('hub_kelas_siswas')
                ->select('hub_kelas_siswas.id', 'hub_kelas_siswas.id_kelas', 'hub_kelas_siswas.id_versi')
                ->where('hub_kelas_siswas.id_siswa', $request->idSiswa)
                ->where('hub_kelas_siswas.id_versi', session('versi'))
                ->first();

        DB::table('siswas')
        ->where('id', $request->idSiswa)
        ->update([
            'id_ortu' => $request->orangTua,
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggalLahir,
            'tempat_lahir' => $request->tempat,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telepon' => $request->noTlp,
            'tahun_masuk' => $request->tahunMasuk,
            'tahun_keluar' => $request->tahunKeluar,
            'tahun_keluar' => $request->tahunKeluar,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        if ($kelasSelect == null) {
            DB::table('hub_kelas_siswas')->insertOrIgnore([
                'id_siswa' => $request->idSiswa,
                'id_kelas' => $request->kelas,
                'id_versi' => session('versi'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        if ($kelasSelect != null) {
            DB::table('hub_kelas_siswas')
            ->where('id_versi', session('versi'))
            ->where('id_siswa', $request->idSiswa)
            ->update([
                'id_kelas' => $request->kelas,
                'updated_at' => now(),
            ]);
        }


        return redirect()->route('DetailSiswa', ['id' => $request->idSiswa])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
