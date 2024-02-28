<?php

namespace App\Http\Controllers;

use App\Models\ProdukLangsung;
use App\Models\Versi;
use App\Models\Kakeibo;
use App\Models\Guru;
use App\Models\Pengeluaran;
use App\Models\detail_pengeluaran;
use App\Models\HubPengeluaran;

use App\Charts\PendapatanHarian;
use App\Charts\PengeluaranHarian;
use App\Charts\KakeiboBar;
use App\Charts\LaporanPemasukan;

use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

        if ($action == 'excel') {
            $pemasukans = DB::table('pesanans')
                        ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                        ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                        ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                        ->select('detail_pesanans.updated_at as tanggalPemasukan', 'produk_langsungs.nama_produk_pembayaran', 'siswas.nama', 'detail_pesanans.nominal', 'pesanans.status')
                        ->where('pesanans.status', 'Telah Dibayarkan')
                        ->whereBetween('detail_pesanans.updated_at', [$dari, $sampai])
                        ->orWhere('produk_langsungs.id', $dana)
                        ->get();
            // Inisialisasi objek Spreadsheet
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header kolom
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Tanggal Pemasukan');
            $sheet->setCellValue('C1', 'Keterangan');
            $sheet->setCellValue('D1', 'Dari');
            $sheet->setCellValue('E1', 'Nominal');
            $sheet->setCellValue('F1', 'Status');

            // Menulis data pengguna ke sel-sel berikutnya
            $row = 2;
            foreach ($pemasukans as $index => $pemasukan) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $pemasukan->tanggalPemasukan);
                $sheet->setCellValue('C' . $row, $pemasukan->nama_produk_pembayaran);
                $sheet->setCellValue('D' . $row, $pemasukan->nama);
                $sheet->setCellValue('E' . $row, $pemasukan->nominal);
                $sheet->setCellValue('F' . $row, $pemasukan->status);
                $row++;
            }

            // Membuat objek Writer dan menyimpan spreadsheet ke file Excel
            $writer = new Xlsx($spreadsheet);
            $filename = 'Laporan' . time() . '.xlsx'; // Nama file Excel yang akan disimpan
            // Membuat response dan mengirimkan file Excel ke browser
            return Response::streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename);
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
                ->join('hub_pengeluarans', 'pengeluarans.id', '=', 'hub_pengeluarans.id_pengeluaran')
                ->select('pengeluarans.id', 'pengeluarans.nama_pengeluaran', 'pengeluarans.keterangan', 'versis.nama_versi', 'pengeluarans.status', 'hub_pengeluarans.id_guru')
                ->where('hub_pengeluarans.id_guru', auth('guru')->user()->id)
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
    
    public function LapPengeluaranExcel($id)
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

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tanggal Pembelian');
        $sheet->setCellValue('C1', 'Keterangan');
        $sheet->setCellValue('D1', 'Kategori');
        $sheet->setCellValue('E1', 'Atas Nama');
        $sheet->setCellValue('F1', 'Jumlah');
        $sheet->setCellValue('G1', 'Harga Satuan');
        $sheet->setCellValue('H1', 'Total');
        $sheet->setCellValue('I1', 'Sumber Dana');
        $sheet->setCellValue('J1', 'Status');

        // Menulis data pengguna ke sel-sel berikutnya
        $row = 2;
        foreach ($detailPengeluarans as $index => $detailPengeluaran) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $detailPengeluaran->tanggal_pengeluaran);
            $sheet->setCellValue('C' . $row, $detailPengeluaran->nama_pengeluaran);
            $sheet->setCellValue('D' . $row, $detailPengeluaran->jenis);
            $sheet->setCellValue('E' . $row, $detailPengeluaran->atas_nama);
            $sheet->setCellValue('F' . $row, $detailPengeluaran->jumlah);
            $sheet->setCellValue('G' . $row, $detailPengeluaran->harga_satuan);
            $sheet->setCellValue('H' . $row, $detailPengeluaran->total);
            $sheet->setCellValue('I' . $row, $detailPengeluaran->nama_produk_pembayaran);
            $sheet->setCellValue('J' . $row, $detailPengeluaran->status);
            $row++;
        }

        // Membuat objek Writer dan menyimpan spreadsheet ke file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan Pengeluaran - '. time() . '.xlsx'; // Nama file Excel yang akan disimpan
        // Membuat response dan mengirimkan file Excel ke browser
        return Response::streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
        
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
    
    public function pengaturanPengeluaran($id)
    {
        $colaborator = DB::table('hub_pengeluarans')
                ->join('gurus', 'hub_pengeluarans.id_guru', '=', 'gurus.id')
                ->select('gurus.nama', 'hub_pengeluarans.id as IdHub')
                ->where('hub_pengeluarans.id_pengeluaran', $id)
                ->get();
        return view('admin.pengelolaan.pengeluaran.pengaturan', [
            'title' => 'Pengeluaran',
            'active' => 'pengeluaran',
            'pengeluaran' => Pengeluaran::find($id),
            'versis' => Versi::all(),
            'colaborators' => $colaborator,
            'gurus' => Guru::all()
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

        $lastPengeluaran = Pengeluaran::max('id');

        DB::table('hub_pengeluarans')->insertOrIgnore([
            'id_pengeluaran' => $lastPengeluaran,
            'id_guru' => auth('guru')->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('pengeluaran')->with('success', 'Kategori Pengeluaran Baru Telah Dibuat!');
    }
    
    public function storeColabolator(Request $request)
    {
        DB::table('hub_pengeluarans')->insertOrIgnore([
            'id_pengeluaran' => $request->idPengeluaran,
            'id_guru' => $request->guru,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('colabolator', ['id' => $request->idPengeluaran])->with('success', 'Colabolator Baru Telah dimasukan!');
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
    
    public function UpdatePengaturanPengeluaran(Request $request)
    {
        DB::table('pengeluarans')
        ->where('id', $request->IdPengeluaran)
        ->update([
            'id_versi' => $request->versi,
            'nama_pengeluaran' => $request->kategori,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'created_at' => now(),
        ]);
        return redirect()->route('detailpengeluaran', ['id' => $request->IdPengeluaran])->with('success', 'Data Telah Diperbaharui!');
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
    
    public function destroyColabolator($idColab, $idPengeluaran)
    {
        HubPengeluaran::destroy($idColab);
        return redirect()->route('colabolator', ['id' => $idPengeluaran])->with('success', 'Data Telah Dihapus');
    }
}
