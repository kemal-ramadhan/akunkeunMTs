<?php

namespace App\Http\Controllers;

use App\Models\Versi;
use App\Models\Guru;

use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengaturan.akun', [
            'title' => 'Pengaturan Akun',
            'active' => 'pengaturan',
            'guru' => Guru::find(auth('guru')->user()->id)
        ]);
    }

    public function struk()
    {
        $siswa = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'siswas.id_kelas', '=', 'kelas.id')
                ->select('pesanans.id as IdPesanan', 'siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad', 'pesanans.updated_at as tglBayar')
                ->where('pesanans.id', '1')
                ->first();
        $keranjang = DB::table('detail_pesanans')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('produk_langsungs.nama_produk_pembayaran', 'detail_pesanans.nominal')
                ->where('detail_pesanans.id_pesanan', '1')
                ->get();
        $sumkeranjang = DB::table('detail_pesanans')
                ->where('detail_pesanans.id_pesanan', '1')
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

        return $dompdf->stream('struk.pdf');

        // return view('templateExport.struk', [
        //             'siswa' => $siswa,
        //             'keranjangs' => $keranjang,
        //             'sumkeranjang' => $sumkeranjang
        //         ]);
    }
    
    public function indexDetailAkun($id)
    {
        return view('admin.pengaturan.editAkun', [
            'title' => 'Pengaturan Akun',
            'active' => 'pengaturan',
            'guru' => Guru::find($id)
        ]);
    }
    
    public function indexVersi()
    {
        return view('admin.pengaturan.versi', [
            'title' => 'Pengaturan Versi Aplikasi',
            'active' => 'versi',
            'versis' => Versi::all()
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
    public function storeVersi(Request $request)
    {
        DB::table('versis')->insertOrIgnore([
            'nama_versi' => $request->versi,
            'status' => 'Tidak Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastversi = Versi::max('id');

        DB::table('pengeluarans')->insertOrIgnore([
            'id_versi' => $lastversi,
            'nama_pengeluaran' => 'Pengeluaran Umum' . $request->versi,
            'keterangan' => 'Pengeluaran Umum' . $request->versi,
            'status' => 'Tidak Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastPengeluaran = Versi::max('id');
        
        DB::table('hub_pengeluarans')->insertOrIgnore([
            'id_pengeluaran' => $lastPengeluaran,
            'id_guru' => auth('guru')->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('versi')->with('success', 'Data Versi Baru Telah Ditambahkan!');
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
    
    public function updateProfile(Request $request)
    {
        if ($request->newPassword) {
            DB::table('gurus')
                ->where('id', $request->idGuru)
                ->update([
                    'nuptk' => $request->nuptk,
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'tanggal_lahir' => $request->tglLahir,
                    'tempat_lahir' => $request->tempat,
                    'email' => $request->email,
                    'password' => $request->newPassword,
                    'no_telepon' => $request->noTlp,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('gurus')
                ->where('id', $request->idGuru)
                ->update([
                    'nuptk' => $request->nuptk,
                    'nama' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'tanggal_lahir' => $request->tglLahir,
                    'tempat_lahir' => $request->tempat,
                    'email' => $request->email,
                    'no_telepon' => $request->noTlp,
                    'updated_at' => now(),
                ]);
        }
        return redirect()->route('akun')->with('success', 'Data Telah DIperbaharui!');
    }
    
    public function updateVersi(Request $request)
    {
        DB::table('versis')
            ->where('status', 'Aktif')
            ->update([
                'status' => 'Tidak Aktif',
                'updated_at' => now(),
            ]);
        
        DB::table('versis')
            ->where('id', $request->idVersi)
            ->update([
                'status' => 'Aktif',
                'updated_at' => now(),
            ]);
        return redirect()->route('versi')->with('success', 'KonfirmasiPerbaharuan Versi Telah Diaktifkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
