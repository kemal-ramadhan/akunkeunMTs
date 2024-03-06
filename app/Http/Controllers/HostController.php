<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Siswa;
use App\Models\ProdukLangsung;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Cicilan;
use App\Models\Versi;
use App\Models\Orangtuawali;

use Illuminate\Support\Facades\Storage;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function akses()
    {
        return view('akses', [
        ]);
    }

    // logic login bawaan laravel
    public function authenticate(Request $request)
    {
        $credit = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('wali')->attempt($credit)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
 
        return back()->with('LoginError', 'Akses Masuk Salah, Periksa lagi akses masuknya!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/akses');
    }

    public function index()
    {
        $produkLangsung = DB::table('hub_produk_langsungs')
            ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
            ->join('hub_kelas_siswas', 'hub_produk_langsungs.id_kelas', '=', 'hub_kelas_siswas.id_kelas')
            ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
            ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('produk_langsungs.id as IdProdukLangsung', 'produk_langsungs.versi', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'produk_langsungs.keterangan', 'produk_langsungs.priode_awal', 'produk_langsungs.priode_akhir', 'produk_langsungs.status', 'hub_produk_langsungs.id_kelas', 'siswas.nama', 'siswas.id as IdSiswa', 'orangtuawalis.nama as wali', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $riwayatLangsung = DB::table('pesanans')
            ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
            ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('detail_pesanans.id_produk_langsung', 'detail_pesanans.id as idDetailPesanan', 'siswas.id as IdSiswa', 'siswas.nama', 'pesanans.updated_at as tanggalBayar', 'pesanans.status', 'orangtuawalis.nama as namaOrangTuaWali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $produkCicilan = DB::table('hub_cicilans')
            ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
            ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan', 'siswas.nama', 'orangtuawalis.nama as wali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        
        return view('public.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
            'produks' => $produkLangsung,
            'cicilans' => $produkCicilan,
            'riwayats' => $riwayatLangsung
        ]);
    }
    
    public function indexProduk()
    {
        $produkLangsung = DB::table('hub_produk_langsungs')
            ->join('produk_langsungs', 'hub_produk_langsungs.id_produk_langsung', '=', 'produk_langsungs.id')
            ->join('hub_kelas_siswas', 'hub_produk_langsungs.id_kelas', '=', 'hub_kelas_siswas.id_kelas')
            ->join('siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
            ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('produk_langsungs.id as IdProdukLangsung', 'produk_langsungs.versi', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'produk_langsungs.keterangan', 'produk_langsungs.priode_awal', 'produk_langsungs.priode_akhir', 'produk_langsungs.status', 'hub_produk_langsungs.id_kelas', 'siswas.nama', 'siswas.id as IdSiswa', 'orangtuawalis.nama as wali', 'kelas.kelas_romawi_angka_abjad', 'kelas.nama_kelas')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $riwayatLangsung = DB::table('pesanans')
            ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
            ->join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('detail_pesanans.id_produk_langsung', 'detail_pesanans.id as idDetailPesanan', 'siswas.id as IdSiswa', 'siswas.nama', 'pesanans.updated_at as tanggalBayar', 'pesanans.status', 'orangtuawalis.nama as namaOrangTuaWali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        $produkCicilan = DB::table('hub_cicilans')
            ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
            ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('pembayaran_cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan', 'siswas.nama', 'orangtuawalis.nama as wali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        return view('public.produk', [
            'title' => 'Pembayaran',
            'active' => 'pembayaran',
            'produks' => $produkLangsung,
            'cicilans' => $produkCicilan,
            'riwayats' => $riwayatLangsung
        ]);
    }
    
    public function indexCicilan()
    {
        $produkCicilan = DB::table('hub_cicilans')
            ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
            ->join('siswas', 'hub_cicilans.id_siswa', '=', 'siswas.id')
            ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
            ->select('pembayaran_cicilans.id as IdProdukCicilan', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa', 'hub_cicilans.id as IdCicilan', 'siswas.nama', 'siswas.id as IdSiswa', 'orangtuawalis.nama as wali')
            ->where('orangtuawalis.id', auth('wali')->user()->id)
            ->get();
        return view('public.cicilans', [
            'title' => 'cicilan Saya',
            'active' => 'cicilans',
            'cicilans' => $produkCicilan,
        ]);
    }
    
    public function indexDetail($parameterProduk, $parameterSiswa)
    {
        return view('public.detail', [
            'title' => 'Detail Pembayaran',
            'active' => 'pembayaran',
            'produk' => ProdukLangsung::find($parameterProduk),
            'siswa' => Siswa::find($parameterSiswa),
        ]);
    }
    
    public function indexDetailCicilan($parameterProdukCicilan, $parameterSiswa)
    {
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id as IdProdukCicilan', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa as IdSiswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_produk_cicilan', $parameterProdukCicilan)
                ->where('hub_cicilans.id_siswa', $parameterSiswa)
                ->get();
        $riwayat = DB::table('cicilans')
                ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('cicilans.id', 'pembayaran_cicilans.nama_cicilan', 'cicilans.id_siswa', 'cicilans.nominal', 'cicilans.keterangan', 'cicilans.tanggal_bayar', 'cicilans.status')
                ->where('cicilans.id_produk_cicilan', $parameterProdukCicilan)
                ->where('cicilans.id_siswa', $parameterSiswa)
                ->get();
        $totalBayar = DB::table('cicilans')
                ->where('cicilans.id_produk_cicilan', $parameterProdukCicilan)
                ->where('cicilans.id_siswa', $parameterSiswa)
                ->sum('nominal');
        return view('public.detailcicilan', [
            'title' => 'Detail Pembayaran Cicilan',
            'active' => 'pembayaran',
            'cicilan' => $produkCicilan,
            'riwayats' => $riwayat,
            'totalBayar' => $totalBayar
        ]);
    }
    
    public function indexPembayaranCicilan($parameterProdukCicilan, $parameterSiswa)
    {
        $produkCicilan = DB::table('hub_cicilans')
                ->join('pembayaran_cicilans', 'hub_cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->select('pembayaran_cicilans.id as IdProdukCicilan', 'pembayaran_cicilans.nama_cicilan', 'pembayaran_cicilans.nominal', 'pembayaran_cicilans.keterangan', 'pembayaran_cicilans.priode_awal', 'pembayaran_cicilans.priode_akhir', 'hub_cicilans.status', 'hub_cicilans.id_siswa as IdSiswa', 'hub_cicilans.id as IdCicilan')
                ->where('hub_cicilans.id_produk_cicilan', $parameterProdukCicilan)
                ->where('hub_cicilans.id_siswa', $parameterSiswa)
                ->get();
        $totalBayar = DB::table('cicilans')
                ->where('cicilans.id_produk_cicilan', $parameterProdukCicilan)
                ->where('cicilans.id_siswa', $parameterSiswa)
                ->sum('nominal');
        return view('public.pembayarancicilan', [
            'title' => 'Detail Pembayaran Cicilan',
            'active' => 'pembayaran',
            'cicilan' => $produkCicilan,
            'totalBayar' => $totalBayar
        ]);
    }
    
    public function indexKeranjang()
    {
        $keranjangs = DB::table('keranjangs')
                ->join('produk_langsungs', 'keranjangs.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'keranjangs.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('orangtuawalis.id', auth('wali')->user()->id)
                ->where('keranjangs.status', 'Keranjang')
                ->select('keranjangs.id AS idKeranjang', 'produk_langsungs.id as idProduk', 'produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.id as idSiswa', 'siswas.nama', 'orangtuawalis.nama as namaOrangtuaWali')
                ->get();
        return view('public.keranjang', [
            'title' => 'Keranjang',
            'active' => 'keranjang',
            'keranjangs' => $keranjangs
        ]);
    }
    
    public function indexPembayaran()
    {
        $pembayaran = Pesanan::join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->select('produk_langsungs.nama_produk_pembayaran', 'detail_pesanans.nominal', 'siswas.nama', 'pesanans.status', 'pesanans.id as idPesanan')
                ->where('pesanans.status', 'Pembayaran')
                ->where('orangtuawalis.id', auth('wali')->user()->id)
                ->get();
        $sumPembayaran = Pesanan::join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.id_pesanan')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.status', 'Pembayaran')
                ->where('orangtuawalis.id', auth('wali')->user()->id)
                ->sum('detail_pesanans.nominal');
        return view('public.pembayaran', [
            'title' => 'Pembayaran',
            'active' => 'keranjang',
            'pembayarans' => $pembayaran,
            'sumTotal' => $sumPembayaran
        ]);
    }
    
    public function indexRiwayat($status = 'Menunggu Konfirmasi')
    {
        $riwayat = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('orangtuawalis.id', auth('wali')->user()->id)
                ->where('pesanans.status', $status)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.id as idPesanan')
                ->get();
        return view('public.riwayat', [
            'title' => 'Riwayat',
            'active' => 'riwayat',
            'riwayats' => $riwayat,
            'activeStatus' => $status
        ]);
    }
    
    public function profile()
    {
        $idOrtu = auth('wali')->user()->id;
        $activeVersi = Versi::where('status', 'Aktif')->first();
        $siswas = DB::table('siswas')
                ->join('hub_kelas_siswas', 'hub_kelas_siswas.id_siswa', '=', 'siswas.id')
                ->join('kelas', 'hub_kelas_siswas.id_kelas', '=', 'kelas.id')
                ->select('siswas.nama', 'kelas.nama_kelas', 'kelas.kelas_romawi_angka_abjad')
                ->where('siswas.id_ortu', $idOrtu)
                ->where('hub_kelas_siswas.id_versi', $activeVersi->id)
                ->get();
        return view('public.profile', [
            'title' => 'Profile Saya',
            'active' => 'profile',
            'biodata' => Orangtuawali::find(auth('wali')->user()->id),
            'siswas' => $siswas
        ]);
    }
    
    public function new_password()
    {
        return view('public.new_password', [
            'title' => 'Password Baru',
            'active' => 'profile',
            'biodata' => Orangtuawali::find(auth('wali')->user()->id),
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
    
    public function storeKeranjang(Request $request)
    {
        DB::table('keranjangs')->insertOrIgnore([
            'id_produk_langsung' => $request->idProduk,
            'id_siswa' => $request->idSiswa,
            'nominal' => $request->nominal,
            'status' => 'Keranjang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('keranjangPublic')->with('success', 'Pembayaran Telah dimasukan kedalam Keranjang!');
    }
    
    public function storePesanan(Request $request)
    {
        $num = $request->numTotal;
        for ($i=0; $i < $num; $i++) { 
            $idSiswa = 'idSiswa_' . $i;
            $nomsatuan = 'nominal_' . $i;
            $idProduk = 'idProduk_' . $i;
            $idKeranjang = 'idKeranjang_' . $i;

            DB::table('pesanans')->insertOrIgnore([
                'id_siswa' => $request->$idSiswa,
                'nominal' => $request->$nomsatuan,
                'status' => 'Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $lastPesanan = Pesanan::max('id');

            DB::table('detail_pesanans')->insertOrIgnore([
                'id_pesanan' => $lastPesanan,
                'id_produk_langsung' => $request->$idProduk,
                'nominal' => $request->$nomsatuan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            Keranjang::destroy($request->$idKeranjang);
        }
        return redirect()->route('pembayaran')->with('success', 'Pesanan Telah Dibuat, Silahkan lakukan Pembayaran Via Transfer!');
    }
    
    public function storePembayaranPublic(Request $request)
    {
        $validationData = $request->validate([
            'bukti' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
        ]);
        $num = $request->numPesanan;
        for ($i=0; $i < $num; $i++) { 
            $idPesanan = 'idPesanan_' . $i;

            DB::table('pembayarans')->insertOrIgnore([
                'id_Pesanan' => $request->$idPesanan,
                'atas_nama' => $request->nama_pengirim,
                'bank' => $request->bank,
                'nominal' => $request->nominal,
                'keterangan' => $request->keterangan,
                'file' => $validationData['bukti'] = $request->file('bukti')->store('bukti-transfer', 'public'),
                'tanggal_bayar' => now(),
                'status' => 'Menunggu Konfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('pesanans')
                ->where('id', $request->$idPesanan)
                ->update([
                    'status' => 'Menunggu Konfirmasi',
                    'updated_at' => now(),
                ]);
        }
        return redirect()->route('riwayat', ['status' => 'Menunggu Konfirmasi'])->with('success', 'Pembayaran Telah Dibuat, Tunggu Konfirmasi dari Pihak Sekolah!');
    }
    
    public function storePembayaranCicilanPublic(Request $request)
    {
        $validationData = $request->validate([
            'bukti' => 'required|mimes:pdf,jpg,jpeg|file|max:2048',
        ]);
        
        DB::table('cicilans')->insertOrIgnore([
            'id_produk_cicilan' => $request->idProdukCicilan,
            'id_siswa' => $request->idSiswa,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'tanggal_bayar' => now(),
            'status' => 'Menunggu Konfirmasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lastCicilan = Cicilan::max('id');

        DB::table('bukti_pembayaran_cicilans')->insertOrIgnore([
            'id_cicilan' => $lastCicilan,
            'atas_nama' => $request->nama_pengirim,
            'bank' => $request->bank,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'file' => $validationData['bukti'] = $request->file('bukti')->store('bukti-transfer', 'public'),
            'tanggal_bayar' => now(),
            'status' => 'Menunggu Konfirmasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('detailCicilanPublic', ['idcicilan' => $request->idProdukCicilan, 'idSiswa' => $request->idSiswa])->with('success', 'Pembayaran Telah Dibuat, Tunggu Konfirmasi dari Pihak Sekolah!');
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
    
    public function updateProfilePublic(Request $request)
    {
        DB::table('orangtuawalis')
        ->where('id', $request->idMy)
        ->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_telepon' => $request->notlp,
            'alamat' => $request->alamat,
            'updated_at' => now(),
        ]);

        return redirect()->route('profile')->with('success', 'Data Telah Diperbaharui!');
    }

    public function updateNewPassword(Request $request)
    {
        $idOrtu = auth('wali')->user()->id;
        DB::table('orangtuawalis')
        ->where('id', $idOrtu)
        ->update([
            'password' => bcrypt($request->password),
            'updated_at' => now(),
        ]);

        return redirect()->route('profile')->with('success', 'Password Telah Diperbaharui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyKeranjang($id)
    {
        Keranjang::destroy($id);
        return redirect()->route('keranjangPublic')->with('success', 'Data Telah Dihapus');
    }
}
