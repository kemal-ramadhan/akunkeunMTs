<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PengeluaranHarian
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        $hari = date('d');

        for ($i=1; $i <= $hari ; $i++) { 
            $tanggal = date('d M', mktime(0, 0, 0, $bulan, $i)); // Menghasilkan format tanggal dan bulan (contoh: 01 Jan)
            $pengeluaran = DB::table('detail_pengeluarans')
                            ->whereMonth('detail_pengeluarans.tanggal_pengeluaran', $bulan)
                            ->whereDay('detail_pengeluarans.tanggal_pengeluaran', $i)
                            ->sum('detail_pengeluarans.total');
            $dataBulanP[] = $tanggal;
            $dataTotalPengeluaran[] = number_format($pengeluaran, 0, ',', '.'); // Format pemasukan dengan titik sebagai pemisah ribuan
        }
        return $this->chart->lineChart()
            ->setTitle('Data Pengeluaran Tahun ' . $tahun)
            ->setSubtitle('Total Pengeluaran sekolah per hari')
            ->addData('Pengeluaran', $dataTotalPengeluaran)
            ->setHeight(200)
            ->setXAxis($dataBulanP);
    }
}
