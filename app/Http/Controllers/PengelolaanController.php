<?php

namespace App\Http\Controllers;

use App\Models\ProdukLangsung;
use App\Models\Versi;
use App\Models\Kakeibo;
use App\Models\Guru;
use App\Models\detail_pengeluaran;

use App\Charts\PendapatanHarian;
use App\Charts\PengeluaranHarian;
use App\Charts\KakeiboBar;
use App\Charts\LaporanPemasukan;

use Dompdf\Dompdf;
use Dompdf\Options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class PengelolaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PendapatanHarian $chart)
    {
        $pemasukan = DB::table('pesanans')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->select('detail_pesanans.updated_at as tanggalPemasukan', 'produk_langsungs.nama_produk_pembayaran', 'siswas.nama', 'detail_pesanans.nominal', 'pesanans.status')
                ->where('pesanans.status', 'Telah Dibayarkan')
                ->get();
        return view('admin.pengelolaan.pemasukan.index', [
            'title' => 'Data Pemasukan',
            'active' => 'pemasukan',
            'pembayarans' => ProdukLangsung::all(),
            'pemasukans' => $pemasukan,
            'chart' => $chart->build()
        ]);
    }
        
    public function searchPemasukan(PendapatanHarian $chart, Request $request)
    {
        $action = $request->input('aksi');

        $dari = $request->mulai;
        $sampai = $request->sampai;
        $dana = $request->dana;

        if ($action == 'cari') {
    
            $pemasukan = DB::table('pesanans')
                        ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                        ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                        ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                        ->select('detail_pesanans.updated_at as tanggalPemasukan', 'produk_langsungs.nama_produk_pembayaran', 'siswas.nama', 'detail_pesanans.nominal', 'pesanans.status')
                        ->where('pesanans.status', 'Telah Dibayarkan')
                        ->whereBetween('detail_pesanans.updated_at', [$dari, $sampai])
                        ->orWhere('produk_langsungs.id', $dana)
                        ->get();
    
            return view('admin.pengelolaan.pemasukan.index', [
                'title' => 'Data Pemasukan',
                'active' => 'pemasukan',
                'pembayarans' => ProdukLangsung::all(),
                'pemasukans' => $pemasukan,
                'chart' => $chart->build()
            ]);
        }

        if ($action == 'pdf') {
            $pemasukan = DB::table('pesanans')
                        ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                        ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                        ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                        ->select('detail_pesanans.updated_at as tanggalPemasukan', 'produk_langsungs.nama_produk_pembayaran', 'siswas.nama', 'detail_pesanans.nominal', 'pesanans.status')
                        ->where('pesanans.status', 'Telah Dibayarkan')
                        ->whereBetween('detail_pesanans.updated_at', [$dari, $sampai])
                        ->orWhere('produk_langsungs.id', $dana)
                        ->get();
            
            $totalNominal = $pemasukan->sum('nominal');

            // Buat objek Dompdf baru
            $dompdf = new Dompdf();

            // Kemungkinan konfigurasi tambahan
            $options = new Options();
            $options->set('defaultPaperSize', 'A4');
            $dompdf->setOptions($options);

            // Render view menjadi HTML dengan data pengguna
            $html = view('templateExport.laporanPemasukan', [
                'title' => 'Data Pemasukan',
                'pemasukans' => $pemasukan,
                'total' => $totalNominal,
                'priodeAwal' => $dari,
                'priodeAkhir' => $sampai,
            ])->render();

            // Muat HTML ke Dompdf
            $dompdf->loadHtml($html);

            // Render PDF
            $dompdf->render();

            return $dompdf->stream('Laporan Pemasukan ' . $dari . '-' . $sampai);
            
            // return view('templateExport.laporanPemasukan', [
            //     'title' => 'Data Pemasukan',
            //     'pemasukans' => $pemasukan,
            //     'total' => $totalNominal,
            //     'priodeAwal' => $dari,
            //     'priodeAkhir' => $sampai,
            // ]);
        }
    }
    
    public function indexPengeluaran(PengeluaranHarian $chart)
    {
        $pengeluarans = DB::table('pengeluarans')
                ->join('versis', 'pengeluarans.id_versi', '=', 'versis.id')
                ->select('pengeluarans.id', 'pengeluarans.nama_pengeluaran', 'pengeluarans.keterangan', 'versis.nama_versi', 'pengeluarans.status')
                ->get();
        return view('admin.pengelolaan.pengeluaran.index', [
            'title' => 'Pengeluaran',
            'active' => 'pengeluaran',
            'pengeluarans' => $pengeluarans,
            'versis' => Versi::all(),
            'chart' => $chart->build()
        ]);
    }
    
    public function indexDetailPengeluaran(KakeiboBar $chart, $id)
    {
        $pengeluaran = DB::table('pengeluarans')
                ->join('versis', 'pengeluarans.id_versi', '=', 'versis.id')
                ->select('pengeluarans.id', 'pengeluarans.nama_pengeluaran', 'pengeluarans.keterangan', 'versis.nama_versi', 'pengeluarans.status')
                ->where('pengeluarans.id', $id)
                ->first();
        $detailPengeluarans = DB::table('detail_pengeluarans')
                ->join('kakeibos', 'detail_pengeluarans.id_kakeibo', '=', 'kakeibos.id')
                ->join('produk_langsungs', 'detail_pengeluarans.id_dompet', '=', 'produk_langsungs.id')
                ->select('detail_pengeluarans.id as IdDetail', 'detail_pengeluarans.tanggal_pengeluaran', 'detail_pengeluarans.nama_pengeluaran', 'kakeibos.jenis', 'detail_pengeluarans.atas_nama', 'detail_pengeluarans.jumlah', 'detail_pengeluarans.harga_satuan', 'detail_pengeluarans.total', 'produk_langsungs.nama_produk_pembayaran', 'detail_pengeluarans.bukti_foto', 'detail_pengeluarans.bukti_pembelian', 'detail_pengeluarans.status')
                ->where('detail_pengeluarans.id_pengeluaran', $id)
                ->get();
        // Menghitung total
        $total = $detailPengeluarans->sum('total');
        return view('admin.pengelolaan.pengeluaran.detail', [
            'title' => 'Data Pemasukan',
            'active' => 'Pengeluaran',
            'pengeluaran' => $pengeluaran,
            'detailPengeluarans' => $detailPengeluarans,
            'totalKeseluruhan' => $total,
            'kakeibos' => Kakeibo::all(),
            'dompets' => ProdukLangsung::all(),
            'gurus' => Guru::all(),
            'kakeiboBar' => $chart->build($id)
        ]);
    }
    
    public function LapPengeluaran($id)
    {
        $pengeluaran = DB::table('pengeluarans')
                ->join('versis', 'pengeluarans.id_versi', '=', 'versis.id')
                ->select('pengeluarans.id', 'pengeluarans.nama_pengeluaran', 'pengeluarans.keterangan', 'versis.nama_versi', 'pengeluarans.status')
                ->where('pengeluarans.id', $id)
                ->first();
        $detailPengeluarans = DB::table('detail_pengeluarans')
                ->join('kakeibos', 'detail_pengeluarans.id_kakeibo', '=', 'kakeibos.id')
                ->join('produk_langsungs', 'detail_pengeluarans.id_dompet', '=', 'produk_langsungs.id')
                ->select('detail_pengeluarans.id as IdDetail', 'detail_pengeluarans.tanggal_pengeluaran', 'detail_pengeluarans.nama_pengeluaran', 'kakeibos.jenis', 'detail_pengeluarans.atas_nama', 'detail_pengeluarans.jumlah', 'detail_pengeluarans.harga_satuan', 'detail_pengeluarans.total', 'produk_langsungs.nama_produk_pembayaran', 'detail_pengeluarans.bukti_foto', 'detail_pengeluarans.bukti_pembelian', 'detail_pengeluarans.status')
                ->where('detail_pengeluarans.id_pengeluaran', $id)
                ->get();
        // Menghitung total
        $total = $detailPengeluarans->sum('total');

        // Buat objek Dompdf baru
        $dompdf = new Dompdf();

        // Kemungkinan konfigurasi tambahan
        $options = new Options();
        $options->set('defaultPaperSize', 'A4');
        $dompdf->setOptions($options);

        // Render view menjadi HTML dengan data pengguna
        $html = view('templateExport.LaporanPengeluaran', [
            'pengeluaran' => $pengeluaran,
            'detailPengeluarans' => $detailPengeluarans,
            'totalKeseluruhan' => $total,
        ])->render();

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        return $dompdf->stream('Laporan ' . $pengeluaran->nama_pengeluaran);

        // return view('templateExport.LaporanPengeluaran', [
        //     'pengeluaran' => $pengeluaran,
        //     'detailPengeluarans' => $detailPengeluarans,
        //     'totalKeseluruhan' => $total,
        // ]);
    }
    
    public function aksiDetailPengeluaran($id)
    {
        $detailpengeluaran = DB::table('detail_pengeluarans')
                ->select('*')
                ->where('id', $id)
                ->first();
        return view('admin.pengelolaan.pengeluaran.detailPengeluaran', [
            'title' => 'Pengeluaran',
            'active' => 'pengeluaran',
            'detail' => $detailpengeluaran,
            'kakeibos' => Kakeibo::all(),
            'dompets' => ProdukLangsung::all(),
            'gurus' => Guru::all(),
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
    
    public function storePengeluaran(Request $request)
    {
        DB::table('pengeluarans')->insertOrIgnore([
            'id_versi' => $request->versi,
            'nama_pengeluaran' => $request->kategori,
            'keterangan' => $request->keterangan,
            'status' => 'Aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('pengeluaran')->with('success', 'Kategori Pengeluaran Baru Telah Dibuat!');
    }
    
    public function storeDetailPengeluaran(Request $request)
    {
        $atasNama = $pemasukan = DB::table('gurus')
                    ->select('nama')
                    ->where('id', $request->atasNama)
                    ->first();
        if (($request->bukti_foto && $request->bukti_pembelian) != null) {
            # code...
            $validationData = $request->validate([
                'bukti_foto' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
                'bukti_pembelian' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
            ]);
            DB::table('detail_pengeluarans')->insertOrIgnore([
                'id_pengeluaran' => $request->idPengeluaran,
                'id_dompet' => $request->dana,
                'id_guru' => $request->atasNama,
                'id_kakeibo' => $request->kakeibo,
                'nama_pengeluaran' => $request->pengeluaran,
                'atas_nama' => $atasNama->nama,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $request->satuan,
                'total' => $request->total,
                'tanggal_pengeluaran' => $request->tglPembelian,
                'keterangan' => $request->keterangan,
                'bukti_foto' => $validationData['bukti_foto'] = $request->file('bukti_foto')->store('bukti-pengeluaran', 'public'),
                'bukti_pembelian' => $validationData['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti-pengeluaran', 'public'),
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (($request->bukti_foto && $request->bukti_pembelian) == null) {
            # code...
            DB::table('detail_pengeluarans')->insertOrIgnore([
                'id_pengeluaran' => $request->idPengeluaran,
                'id_dompet' => $request->dana,
                'id_guru' => $request->atasNama,
                'id_kakeibo' => $request->kakeibo,
                'nama_pengeluaran' => $request->pengeluaran,
                'atas_nama' => $atasNama->nama,
                'jumlah' => $request->jumlah,
                'harga_satuan' => $request->satuan,
                'total' => $request->total,
                'tanggal_pengeluaran' => $request->tglPembelian,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('detailpengeluaran', ['id' => $request->idPengeluaran])->with('success', 'Pengeluaran Baru Telah Dibuat!');
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
        
    }
    
    public function UpdateDetailPengeluaran(Request $request)
    {
        $atasNama = $pemasukan = DB::table('gurus')
                    ->select('nama')
                    ->where('id', $request->atasNama)
                    ->first();
        
            if ($request->bukti_foto) {
                $validationData = $request->validate([
                    'bukti_foto' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
                ]);
                if ($request->oldbukti_foto) {
                    Storage::delete($request->oldbukti_foto);
                }
                $validationData['bukti_foto'] = $request->file('bukti_foto')->store('bukti-pengeluaran', 'public');
                detail_pengeluaran::where('id', $request->idDetail)->update($validationData);
            }
            
            if ($request->bukti_pembelian) {
                $validationData = $request->validate([
                    'bukti_pembelian' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
                ]);
                if ($request->oldbukti_pembelian) {
                    Storage::delete($request->oldbukti_pembelian);
                }
                $validationData['bukti_pembelian'] = $request->file('bukti_pembelian')->store('bukti-pengeluaran', 'public');
                detail_pengeluaran::where('id', $request->idDetail)->update($validationData);
            }
            DB::table('detail_pengeluarans')
                ->where('id', $request->idDetail)
                ->update([
                    'id_dompet' => $request->dana,
                    'id_guru' => $request->atasNama,
                    'id_kakeibo' => $request->kakeibo,
                    'nama_pengeluaran' => $request->pengeluaran,
                    'atas_nama' => $atasNama->nama,
                    'jumlah' => $request->jumlah,
                    'harga_satuan' => $request->satuan,
                    'total' => $request->total,
                    'tanggal_pengeluaran' => $request->tglPembelian,
                    'keterangan' => $request->keterangan,
                    'status' => $request->status,
                    'created_at' => now(),
                ]);
        return redirect()->route('detailpengeluaran', ['id' => $request->idPengeluaran])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
