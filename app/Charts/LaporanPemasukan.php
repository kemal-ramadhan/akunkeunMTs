<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LaporanPemasukan
{
    protected $chartLap;

    public function __construct(LarapexChart $chartLap)
    {
        $this->chartLap = $chartLap;
    }

    public function build($dari, $sampai, $dana): \ArielMejiaDev\LarapexCharts\LineChart
    {
        for ($i=1; $i <= $sampai ; $i++) { 
            $pemasukan = DB::table('pesanans')
                            ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->join('produk_langsungs', 'detail_pesanans.id_produk_langsung', '=', 'produk_langsungs.id')
                            ->where('pesanans.status', 'Telah Dibayarkan')
                            ->whereBetween('detail_pesanans.updated_at', [$dari, $sampai])
                            ->orWhere('produk_langsungs.id', $dana)
                            ->sum('detail_pesanans.nominal');
            $dataBulanP[] = $sampai;
            $dataTotalPemasukan[] = number_format($pemasukan,0,',','.'); // Format pengeluaran dengan titik sebagai pemisah ribuan
        }
        return $this->chartLap->lineChart()
            ->setTitle('Data Pemasukan Priode ' . $dari . 's.d' . $sampai)
            ->addData('Pemasukan', $dataTotalPemasukan)
            ->setHeight(200)
            ->setXAxis($dataBulanP);
    }
}
