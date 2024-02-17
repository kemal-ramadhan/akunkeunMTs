<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KakeiboBar
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($id): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        $hari = date('d');

        $kakeibo = [
            1 => 'Survival',
            2 => 'Optional',
            3 => 'Culture',
            4 => 'Extra',
        ];

        for ($i=1; $i <= 4 ; $i++) { 
            $survival = DB::table('detail_pengeluarans')
                            ->where('detail_pengeluarans.id_pengeluaran', $id)
                            ->where('detail_pengeluarans.id_kakeibo', $i)
                            ->sum('detail_pengeluarans.total');
            $kakeiboName[] = $kakeibo[$i];
            $dataTotalPengeluaran[] = $survival; // Format pemasukan dengan titik sebagai pemisah ribuan
        }
        return $this->chart->barChart()
            ->setTitle('Kakeibo')
            ->setSubtitle('Data Pengeluaran')
            ->addData('Kakeibo', $dataTotalPengeluaran)
            ->setHeight(200)
            ->setXAxis($kakeiboName);
    }
}
