<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
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
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->get();
        return view('admin.based.siswa.index', [
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
            'siswas' => $siswa,
            'total' => Siswa::count(),
        ]);
    }
    
    
    public function indexKelas()
    {
        $kelas = DB::table('kelas')
                ->join('gurus', 'gurus.id', '=', 'kelas.id_guru')
                ->select('kelas.id', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'kelas.keterangan', 'gurus.nama')
                ->get();

        return view('admin.based.siswa.kelas', [
            'title' => 'Data Kelas',
            'active' => 'siswa',
            'kelass' => $kelas,
            'gurus' => Guru::all(),
            'total' => Kelas::count(),
        ]);
    }
    
    public function indexDetailKelas($id)
    {
        $siswa = DB::table('siswas')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id','siswas.nisn', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.nama', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->where('kelas.id', $id)
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
            'id_kelas' => $request->kelas,
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

        return redirect()->route('ref-siswa')->with('success', 'Data Telah Ditambahkan!');
    }

    public function storeKelas(Request $request)
    {
        DB::table('kelas')->insertOrIgnore([
            'id_guru' => $request->guru,
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
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.id', 'siswas.nisn', 'siswas.alamat', 'siswas.nis', 'siswas.nama as namaSiswa', 'orangtuawalis.id as IdWali', 'kelas.kelas_romawi_angka_abjad', 'kelas.id as IdKelas', 'siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.no_telepon', 'siswas.email', 'siswas.tahun_masuk', 'siswas.tahun_keluar', 'siswas.status')
                ->where('siswas.id', $id)
                ->get();
        return view('admin.based.siswa.detail', [
            'title' => 'Data Siswa',
            'active' => 'siswa',
            'siswa' => $siswa,
            'kelass' => Kelas::all(),
            'walis' => Orangtuawali::all(),
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
        DB::table('siswas')
        ->where('id', $request->idSiswa)
        ->update([
            'id_ortu' => $request->orangTua,
            'id_kelas' => $request->kelas,
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
