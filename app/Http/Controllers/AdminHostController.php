<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\Versi;

use Illuminate\Support\Facades\DB;
use App\Charts\PendapatanBulanan;
use App\Charts\KakeiboDashboard;

class AdminHostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function akses()
    {
        return view('admin.akses',[
            'versis' => Versi::all(),
        ]);
    }

    public function authenticate(Request $request)
    {
        $credit = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('guru')->attempt($credit)) {
            $request->session()->regenerate();
            session(['versi' => $request->versi]);
            return redirect()->intended('/dashboard');
        }
 
        return back()->with('LoginError', 'Akses Masuk Salah, Periksa lagi akses masuknya!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        $request->session()->forget('versi');
    
        return redirect('/administrator');
    }

    public function index(PendapatanBulanan $chart, KakeiboDashboard $kakeibo)
    {
        $bulan = date('m');
        $pemasukanBulan = DB::table('pesanans')
                            ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->where('pesanans.status', 'Telah Dibayarkan')
                            ->whereMonth('pesanans.updated_at', $bulan)
                            ->sum('detail_pesanans.nominal');
        $pemasukanhariini = DB::table('pesanans')
                            ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->where('pesanans.status', 'Telah Dibayarkan')
                            ->whereDate('pesanans.updated_at', now())
                            ->sum('detail_pesanans.nominal');
        $pengeluaranhariini = DB::table('detail_pengeluarans')
                            ->whereDate('detail_pengeluarans.created_at', now())
                            ->sum('detail_pengeluarans.total');
        $antrians = DB::table('detail_pesanans')
                            ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->join('pembayarans', 'pembayarans.id_Pesanan', '=', 'pesanans.id')
                            ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                            ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                            ->where('pesanans.status', 'Menunggu Konfirmasi')
                            ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pembayarans.tanggal_bayar as tglBayar', 'pesanans.id as idPesanan')
                            ->orderBy('tglBayar', 'desc') // Mengurutkan berdasarkan tanggal pembayaran terbaru
                            ->take(4) // Mengambil 4 data teratas
                            ->get();                        
        $sumantrian = DB::table('pesanans')
                            ->where('pesanans.status', 'Menunggu Konfirmasi')
                            ->count();
        $antrianCicilans = DB::table('cicilans')
                ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
                ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
                ->where('bukti_pembayaran_cicilans.status', 'Menunggu Konfirmasi')
                ->select('cicilans.id as IdCicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.status')
                ->orderBy('bukti_pembayaran_cicilans.tanggal_bayar', 'desc') // Mengurutkan berdasarkan tanggal pembayaran terbaru
                ->take(4) // Mengambil 4 data teratas
                ->get();
        $CountAntrian = DB::table('bukti_pembayaran_cicilans')
                ->where('bukti_pembayaran_cicilans.status', 'Menunggu Konfirmasi')
                ->count();
        return view('admin.based.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'chart' => $chart->build(),
            'kakeibo' => $kakeibo->build(),
            'pemasukan' => $pemasukanhariini,
            'pengeluaran' => $pengeluaranhariini,
            'pendapatanBulanan' =>$pemasukanBulan,
            'antrians' => $antrians,
            'sumantrian' => $sumantrian,
            'antrianCicilans' => $antrianCicilans,
            'countantrian' => $CountAntrian,
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
