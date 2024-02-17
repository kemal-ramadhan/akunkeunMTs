<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PendapatanBulanan
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

        $bulanName = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        for ($i=1; $i <= $bulan ; $i++) { 
            $pemasukan = DB::table('pesanans')
                            ->join('detail_pesanans', 'detail_pesanans.id_pesanan', '=', 'pesanans.id')
                            ->where('pesanans.status', 'Telah Dibayarkan')
                            ->whereYear('pesanans.updated_at', $tahun)
                            ->whereMonth('pesanans.updated_at', $i)
                            ->sum('detail_pesanans.nominal');
            $pengeluaran = DB::table('detail_pengeluarans')
                            ->whereYear('detail_pengeluarans.created_at', $tahun)
                            ->whereMonth('detail_pengeluarans.created_at', $i)
                            ->sum('detail_pengeluarans.total');
            $dataBulanP[] = $bulanName[$i];
            $dataTotalPemasukan[] = number_format($pemasukan,0,',','.'); // Format pemasukan dengan titik sebagai pemisah ribuan
            $dataTotalPengeluaran[] = number_format($pengeluaran,0,',','.'); // Format pengeluaran dengan titik sebagai pemisah ribuan
        }
        return $this->chart->lineChart()
            ->setTitle('Data Pemasukan & Pengeluaran')
            ->setSubtitle('Total pemasukan dan pengeluaran sekolah')
            ->addData('Pemasukan', $dataTotalPemasukan)
            ->addData('Pengeluaran', $dataTotalPengeluaran)
            ->setHeight(250)
            ->setXAxis($dataBulanP);
    }
}
