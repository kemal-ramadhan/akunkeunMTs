<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Kakeibo;
use App\Models\ProdukLangsung;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pengajuan.online.index', [
            'title' => 'Data Pengajuan',
            'active' => 'pengajuan',
        ]);
    }
    
    public function indexDaftarPengajuan($status)
    {
        $daftar = DB::table('pengajuans')
                ->where('id_guru', auth('guru')->user()->id)
                ->where('status_pengajuan', $status)
                ->get();
        return view('admin.pengajuan.online.daftar', [
            'title' => 'Daftar Pengajuan',
            'active' => 'pengajuan',
            'daftars' => $daftar,
            'activebutton' => $status
        ]);
    }
    
    public function indexDaftarPengajuanKeuangan($status)
    {
        $daftar = DB::table('pengajuans')
                ->where('status_bag_keuangan', $status)
                ->get();
        return view('admin.pengajuan.keuangan.index', [
            'title' => 'Daftar Pengajuan',
            'active' => 'verifikator',
            'daftars' => $daftar,
            'activebutton' => $status
        ]);
    }
    
    public function indexDaftarPengajuanKamad($status)
    {
        $daftar = DB::table('pengajuans')
                ->where('status_bag_kamad', $status)
                ->get();
        return view('admin.pengajuan.kamad.index', [
            'title' => 'Daftar Pengajuan',
            'active' => 'verifikator',
            'daftars' => $daftar,
            'activebutton' => $status
        ]);
    }
    
    public function indexDetailPengajuan($id)
    {
        $guru = DB::table('pengajuans')
                ->join('gurus', 'pengajuans.id_guru', '=', 'gurus.id')
                ->where('pengajuans.id', $id)
                ->select('gurus.nama', 'pengajuans.id')
                ->first();
        $detailPengeluaran = DB::table('detail_pengeluarans')
                ->where('id_pengajuan', $id)
                ->select('id', 'bukti_foto', 'bukti_pembelian')
                ->first();
        return view('admin.pengajuan.online.detail', [
            'title' => 'Daftar Pengajuan',
            'active' => 'pengajuan',
            'pengajuan' => Pengajuan::find($id),
            'guru' => $guru,
            'detailPengeluaran' => $detailPengeluaran
        ]);
    }
    
    public function indexDetailPengajuanKeuangan($id)
    {
        $guru = DB::table('pengajuans')
                ->join('gurus', 'pengajuans.id_guru', '=', 'gurus.id')
                ->where('pengajuans.id', $id)
                ->select('gurus.nama', 'pengajuans.id')
                ->first();
        $pengeluaran = DB::table('detail_pengeluarans')
                ->where('id_pengajuan', $id)
                ->select('*')
                ->first();
        return view('admin.pengajuan.keuangan.detail', [
            'title' => 'Daftar Pengajuan',
            'active' => 'verifikator',
            'pengajuan' => Pengajuan::find($id),
            'guru' => $guru,
            'kakeibos' => Kakeibo::all(),
            'dompets' => ProdukLangsung::all(),
            'pengeluaran' => $pengeluaran
        ]);
    }
    
    public function indexDetailPengajuanKamad($id)
    {
        $guru = DB::table('pengajuans')
                ->join('gurus', 'pengajuans.id_guru', '=', 'gurus.id')
                ->where('pengajuans.id', $id)
                ->select('gurus.nama', 'pengajuans.id')
                ->first();
        return view('admin.pengajuan.kamad.detail', [
            'title' => 'Daftar Pengajuan',
            'active' => 'verifikator',
            'pengajuan' => Pengajuan::find($id),
            'guru' => $guru
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
   
    public function storePengajuanGuru(Request $request)
    {
        DB::table('pengajuans')->insertOrIgnore([
            'id_guru' => $request->idPengaju,
            'nama_pengajuan' => $request->namaPengajuan,
            'jenis_pengajuan' => $request->jenis,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'tanggal_pengajuan' => now(),
            'status_pengajuan' => 'Pengajuan',
            'status_bag_keuangan' => 'Pengajuan',
            'status_bag_kamad' => 'Belum Diproses',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('daftarPengajuan', ['status' => 'Pengajuan'])->with('success', 'Pengajuan Telah Dibuat Tunggu hingga Bagian Keuangan Mengkonfirmasi Pengajuan!');
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
    
    public function updatePengajuanKeuangan(Request $request)
    {
        
        $IdPengeluaran = DB::table('pengeluarans')
                        ->where('id_versi', session('versi'))
                        ->select('id')
                        ->first();
                        
        if ($request->verifikasi == 'Ditolak') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_keuangan' => 'Ditolak',
                'status_bag_kamad' => 'Ditolak',
                'status_pengajuan' => 'Ditolak',
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);
        }

        if ($request->verifikasi == 'Disetujui') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_keuangan' => $request->verifikasi,
                'status_bag_kamad' => 'Pengajuan',
                'status_pengajuan' => 'Verifikasi',
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);
        }

        if ($request->verifikasi == 'Menunggu Laporan') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_keuangan' => $request->verifikasi,
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);
            DB::table('detail_pengeluarans')->insertOrIgnore([
                'id_pengeluaran' => $IdPengeluaran->id,
                'id_dompet' => $request->dompet,
                'id_guru' => $request->IdGuru,
                'id_pengajuan' => $request->IdPengajuan,
                'id_kakeibo' => $request->kakeibo,
                'nama_pengeluaran' => $request->NamaPengajuan,
                'atas_nama' => $request->AtasNama,
                'jumlah' => '1',
                'harga_satuan' => $request->nominalDisetujui,
                'total' => $request->nominalDisetujui,
                'tanggal_pengeluaran' => now(),
                'keterangan' => $request->keterangan,
                'status' => 'Pembelian',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        if ($request->verifikasi == 'Selesai') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_keuangan' => $request->verifikasi,
                'catatan' => $request->catatan,
                'status_pengajuan' => 'Selesai',
                'updated_at' => now(),
            ]);
            
            DB::table('detail_pengeluarans')
            ->where('id_pengajuan', $request->IdPengajuan)
            ->update([
                'status' => 'Selesai',
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('daftarPengajuanKeuangan', ['status' => $request->verifikasi])->with('success', 'Konfirmasi Selesai!');
    }
    
    public function updatePengajuanKamad(Request $request)
    {
        if ($request->verifikasi == 'Ditolak') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_kamad' => 'Ditolak',
                'status_pengajuan' => 'Ditolak',
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);
        }

        if ($request->verifikasi != 'Ditolak') {
            DB::table('pengajuans')
            ->where('id', $request->IdPengajuan)
            ->update([
                'nominal_diberi' => $request->nominalDisetujui,
                'status_bag_kamad' => $request->verifikasi,
                'status_pengajuan' => 'Pembelian',
                'catatan' => $request->catatan,
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('daftarPengajuanKamad', ['status' => $request->verifikasi])->with('success', 'Konfirmasi Selesai!');
    }
    
    public function UnggahLaporan(Request $request)
    {
        $validationData = $request->validate([
            'bukti_foto' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
            'bukti_pembelian' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
        ]);

        DB::table('detail_pengeluarans')
            ->where('id_pengajuan', $request->IdPengajuan)
            ->update([
                'bukti_foto' => $validationData['bukti_foto'] = $request->file('bukti_foto')->store('bukti-pengeluaran', 'public'),
                'bukti_pembelian' => $validationData['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti-pengeluaran', 'public'),
                'updated_at' => now(),
            ]);
        
        return redirect()->route('daftarPengajuan', ['status' => $request->status])->with('success', 'Laporan Telah Diunggah, Konfirmasi Ke Bagian Keuangan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
