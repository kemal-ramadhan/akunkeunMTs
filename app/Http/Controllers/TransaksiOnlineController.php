<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\BuktiPembayaranCicilan;
use App\Models\Cicilan;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status)
    {
        $antrians = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('pembayarans', 'pembayarans.id_Pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.status', $status)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pembayarans.tanggal_bayar as tglBayar', 'pesanans.id as idPesanan')
                ->get();
        $sumantrian = DB::table('pesanans')
                ->where('pesanans.status', 'Menunggu Konfirmasi')
                ->count();
        $sumselesai = DB::table('pembayarans')
                ->where('pembayarans.status', 'Telah Dibayarkan')
                ->count();
        return view('admin.transaksi.online.index', [
            'title' => 'Antiran Pembayaran Siswa',
            'active' => 'online',
            'antrians' => $antrians,
            'sumantrian' => $sumantrian,
            'sumselesai' => $sumselesai,
            'activebutton' => $status
        ]);
    }
    
    public function indexCicilan($status)
    {
        $antrians = DB::table('cicilans')
                ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
                ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
                ->where('bukti_pembayaran_cicilans.status', $status)
                ->select('cicilans.id as IdCicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.status')
                ->get();
        $CountAntrian = DB::table('bukti_pembayaran_cicilans')
                ->where('bukti_pembayaran_cicilans.status', 'Menunggu Konfirmasi')
                ->count();
        $CountSelesai = DB::table('bukti_pembayaran_cicilans')
                ->where('bukti_pembayaran_cicilans.status', 'Selesai')
                ->count();
        return view('admin.transaksi.online.indexcicilan', [
            'title' => 'Antiran Cicilan Pembayaran Siswa',
            'active' => 'online',
            'activebutton' => $status,
            'antrians' => $antrians,
            'countantrian' => $CountAntrian,
            'countselesai' => $CountSelesai,
        ]);
    }
    
    public function detail($id)
    {
        $detailPesanan = DB::table('pesanans')
                ->join('pembayarans', 'pembayarans.id_Pesanan', '=', 'pesanans.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->where('pesanans.id', $id)
                ->select('pesanans.id as idPesanan', 'pesanans.status', 'pembayarans.tanggal_bayar', 'siswas.nama')
                ->get();
        $bukti = Pembayaran::where('id_Pesanan', $id)->first();
        $riwayat = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.id', $id)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'pesanans.status', 'pesanans.id as idPesanan')
                ->get();
        return view('admin.transaksi.online.detail', [
            'title' => 'Pembayaran Siswa',
            'active' => 'online',
            'detail' => $detailPesanan,
            'bukti' => $bukti,
            'riwayats' => $riwayat
        ]);
    }
    
    public function indexCicilanDetail($id)
    {
        $detail = DB::table('cicilans')
                ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
                ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
                ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->where('cicilans.id', $id)
                ->select('cicilans.id as IdCicilan', 'pembayaran_cicilans.nama_cicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.nominal', 'bukti_pembayaran_cicilans.status')
                ->get();
        $bukti = BuktiPembayaranCicilan::where('id_cicilan', $id)->first();
        return view('admin.transaksi.online.detailcicilan', [
            'title' => 'Pembayaran Siswa',
            'active' => 'online',
            'detail' => $detail,
            'bukti' => $bukti,
            'riwayats' => $detail
        ]);
    }
    
    // public function invoiceCicilan()
    // {
    //     $detail = DB::table('cicilans')
    //             ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
    //             ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
    //             ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
    //             ->where('cicilans.id', '1')
    //             ->select('cicilans.id as IdCicilan', 'pembayaran_cicilans.nama_cicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.nominal', 'bukti_pembayaran_cicilans.status')
    //             ->get();
    //     $bukti = BuktiPembayaranCicilan::where('id_cicilan', '1')->first();
    //     return view('templateEmail.invoiceCicilan', [
    //         'title' => 'Pembayaran Siswa',
    //         'bukti' => $bukti,
    //         'riwayats' => $detail
    //     ]);
    // }
    


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
    public function updatePesanan(Request $request)
    {
        if ($request->status == 'Telah Dibayarkan') {
            DB::table('pesanans')
            ->where('id', $request->idPesanan)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);
            
            DB::table('pembayarans')
            ->where('id_Pesanan', $request->idPesanan)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

            $riwayat = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.id', $request->idPesanan)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'orangtuawalis.email', 'pesanans.status', 'pesanans.id as idPesanan')
                ->get();
            $bukti = Pembayaran::where('id_Pesanan', $request->idPesanan)->first();
            $sumNominal = $riwayat->sum('nominal');
            $emails = $riwayat->pluck('email');
            $walis = $riwayat->pluck('wali');

            $firstEmail = $emails->first();
            $firstWali = $walis->first();

            if ($firstEmail != null) {
                $mail = new PHPMailer(true); // Passing `true` enables exceptions

                try {
                    // Server settings
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = env('MAIL_HOST');
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = env('MAIL_USERNAME');
                    $mail->Password   = env('MAIL_PASSWORD');
                    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                    $mail->Port       = env('MAIL_PORT');
        
                    // Recipients
                    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mail->addAddress($firstEmail, $firstWali); // Add a recipient
        
                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Pembayaran Sekolah';
                    $mail->Body    = view('templateEmail.invoicePembayaran', [
                                        'title' => 'Pembayaran Siswa',
                                        'riwayats' => $riwayat,
                                        'bukti' => $bukti,
                                        'total' => $sumNominal,
                                        'wali' => $firstWali
                                    ]);
        
                    $mail->send();
                    return redirect()->route('TransaksiOnline', ['status' => 'Telah Dibayarkan'])->with('success', 'Konfirmasi Selesai!');
                } catch (Exception $e) {
                    return "Email gagal dikirim. Pesan error: {$mail->ErrorInfo}";
                }
            }
            return redirect()->route('TransaksiOnline', ['status' => 'Telah Dibayarkan'])->with('success', 'Konfirmasi Selesai!');

        }
        
        if ($request->status == 'Tidak Sesuai') {
            $riwayat = DB::table('detail_pesanans')
                ->join('pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                ->join('siswas', 'pesanans.id_siswa', '=', 'siswas.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('pesanans.id', $request->idPesanan)
                ->select('produk_langsungs.nama_produk_pembayaran', 'produk_langsungs.nominal', 'siswas.nama', 'orangtuawalis.nama AS wali', 'orangtuawalis.email', 'pesanans.status', 'pesanans.id as idPesanan')
                ->get();
            $emails = $riwayat->pluck('email');
            $walis = $riwayat->pluck('wali');

            $firstEmail = $emails->first();
            $firstWali = $walis->first();

            if ($firstEmail != null) {
                $mail = new PHPMailer(true); // Passing `true` enables exceptions

                try {
                    // Server settings
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = env('MAIL_HOST');
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = env('MAIL_USERNAME');
                    $mail->Password   = env('MAIL_PASSWORD');
                    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                    $mail->Port       = env('MAIL_PORT');
        
                    // Recipients
                    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mail->addAddress($firstEmail, $firstWali); // Add a recipient
        
                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Gagal Pembayaran';
                    $mail->Body    = view('templateEmail.gagal', [
                                        'title' => 'Gagal Pembayaran Siswa',
                                        'wali' => $firstWali
                                    ]);
        
                    $mail->send();
                    Pesanan::destroy($request->idPesanan);
                    DB::table('pembayarans')
                        ->where('id_Pesanan', $request->idPesanan)
                        ->delete();
                    DB::table('detail_pesanans')
                        ->where('id_Pesanan', $request->idPesanan)
                        ->delete();
                    return redirect()->route('TransaksiOnline', ['status' => 'Menunggu Konfirmasi'])->with('success', 'Data Telah dihapus, hubungi orang tua atau wali siswa untuk memberitahukan masalah tersebut!');
                } catch (Exception $e) {
                    Pesanan::destroy($request->idPesanan);
                    DB::table('pembayarans')
                        ->where('id_Pesanan', $request->idPesanan)
                        ->delete();
                    DB::table('detail_pesanans')
                        ->where('id_Pesanan', $request->idPesanan)
                        ->delete();
                    return "Email gagal dikirim. Pesan error: {$mail->ErrorInfo}";
                }
            }
        }
    }
    
    public function updateCicilanOnline(Request $request)
    {
        if ($request->status == 'Telah Dibayarkan') {
            DB::table('cicilans')
            ->where('id', $request->IdCicilan)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);
            
            DB::table('bukti_pembayaran_cicilans')
            ->where('id_cicilan', $request->IdCicilan)
            ->update([
                'status' => 'Selesai',
                'updated_at' => now(),
            ]);

            $detail = DB::table('cicilans')
                ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
                ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
                ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                ->where('cicilans.id', $request->IdCicilan)
                ->select('cicilans.id as IdCicilan', 'pembayaran_cicilans.nama_cicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.nominal', 'bukti_pembayaran_cicilans.status', 'orangtuawalis.nama AS wali',
                'orangtuawalis.email')
                ->get();
            $bukti = BuktiPembayaranCicilan::where('id_cicilan', $request->IdCicilan)->first();
            $emails = $detail->pluck('email');
            $walis = $detail->pluck('wali');

            $firstEmail = $emails->first();
            $firstWali = $walis->first();

            $mail = new PHPMailer(true); // Passing `true` enables exceptions

                try {
                    // Server settings
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host       = env('MAIL_HOST');
                    $mail->SMTPAuth   = true; // Enable SMTP authentication
                    $mail->Username   = env('MAIL_USERNAME');
                    $mail->Password   = env('MAIL_PASSWORD');
                    $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                    $mail->Port       = env('MAIL_PORT');
        
                    // Recipients
                    $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $mail->addAddress($firstEmail, $firstWali); // Add a recipient
        
                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Pembayaran Cicilan';
                    $mail->Body    = view('templateEmail.invoiceCicilan', [
                        'title' => 'Pembayaran Siswa',
                        'bukti' => $bukti,
                        'riwayats' => $detail,
                        'wali' => $firstWali
                    ]);
        
                    $mail->send();
                    return redirect()->route('TransaksiCicilanOnline', ['status' => 'Selesai'])->with('success', 'Konfirmasi Selesai!');
                } catch (Exception $e) {
                    return "Email gagal dikirim. Pesan error: {$mail->ErrorInfo}";
                }
        }
        
        if ($request->status == 'Tidak Sesuai') {
            
                $detail = DB::table('cicilans')
                    ->join('bukti_pembayaran_cicilans', 'bukti_pembayaran_cicilans.id_cicilan', '=', 'cicilans.id')
                    ->join('siswas', 'cicilans.id_siswa', '=', 'siswas.id')
                    ->join('pembayaran_cicilans', 'cicilans.id_produk_cicilan', '=', 'pembayaran_cicilans.id')
                    ->join('orangtuawalis', 'siswas.id_ortu', '=', 'orangtuawalis.id')
                    ->where('cicilans.id', $request->IdCicilan)
                    ->select('cicilans.id as IdCicilan', 'pembayaran_cicilans.nama_cicilan', 'siswas.nama', 'bukti_pembayaran_cicilans.tanggal_bayar', 'bukti_pembayaran_cicilans.nominal', 'bukti_pembayaran_cicilans.status', 'orangtuawalis.nama AS wali',
                    'orangtuawalis.email')
                    ->get();
                $bukti = BuktiPembayaranCicilan::where('id_cicilan', $request->IdCicilan)->first();
                $emails = $detail->pluck('email');
                $walis = $detail->pluck('wali');
                $firstEmail = $emails->first();
                $firstWali = $walis->first();
    
                $mail = new PHPMailer(true); // Passing `true` enables exceptions
    
                    try {
                        // Server settings
                        $mail->isSMTP(); // Send using SMTP
                        $mail->Host       = env('MAIL_HOST');
                        $mail->SMTPAuth   = true; // Enable SMTP authentication
                        $mail->Username   = env('MAIL_USERNAME');
                        $mail->Password   = env('MAIL_PASSWORD');
                        $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                        $mail->Port       = env('MAIL_PORT');
            
                        // Recipients
                        $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $mail->addAddress($firstEmail, $firstWali); // Add a recipient
            
                        // Content
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = 'Gagal Pembayaran';
                        $mail->Body    = view('templateEmail.gagal', [
                            'title' => 'Pembayaran Siswa',
                            'wali' => $firstWali
                        ]);
            
                        $mail->send();

                        Cicilan::destroy($request->IdCicilan);
                        DB::table('bukti_pembayaran_cicilans')
                            ->where('id_cicilan', $request->IdCicilan)
                            ->delete();

                        return redirect()->route('TransaksiCicilanOnline', ['status' => 'Menunggu Konfirmasi'])->with('success', 'Data Telah dihapus, hubungi orang tua atau wali siswa untuk memberitahukan masalah tersebut!');
                    } catch (Exception $e) {
                        Cicilan::destroy($request->IdCicilan);
                        DB::table('bukti_pembayaran_cicilans')
                            ->where('id_cicilan', $request->IdCicilan)
                            ->delete();
                        return "Email gagal dikirim. Pesan error: {$mail->ErrorInfo}";
                    }
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
