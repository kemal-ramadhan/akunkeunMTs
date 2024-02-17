<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PendapatanHarian
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
            $pemasukan = DB::table('pesanans')
                            ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->where('pesanans.status', 'Telah Dibayarkan')
                            ->whereMonth('pesanans.updated_at', $bulan)
                            ->whereDay('pesanans.updated_at', $i)
                            ->sum('detail_pesanans.nominal');
            $dataBulanP[] = $tanggal;
            $dataTotalPemasukan[] = number_format($pemasukan,0,',','.'); // Format pengeluaran dengan titik sebagai pemisah ribuan
        }
        return $this->chart->lineChart()
            ->setTitle('Data Pemasukan Tahun ' . $tahun)
            ->setSubtitle('Total pemasukan sekolah per hari')
            ->addData('Pendapatan', $dataTotalPemasukan)
            ->setHeight(200)
            ->setXAxis($dataBulanP);

    }
}
