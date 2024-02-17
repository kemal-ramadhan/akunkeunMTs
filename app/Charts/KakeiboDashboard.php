<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KakeiboDashboard
{
    protected $kakeibo;

    public function __construct(LarapexChart $kakeibo)
    {
        $this->kakeibo = $kakeibo;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
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
                            ->where('detail_pengeluarans.id_kakeibo', $i)
                            ->whereMonth('detail_pengeluarans.updated_at', $bulan)
                            ->sum('detail_pengeluarans.total');
            $kakeiboName[] = $kakeibo[$i];
            $dataTotalPengeluaran[] = $survival; // Format pemasukan dengan titik sebagai pemisah ribuan
        }

        return $this->kakeibo->barChart()
            ->setTitle('Kakeibo')
            ->setSubtitle('Data Pengeluaran Bulan ' . date('M'))
            ->addData('Kakeibo', $dataTotalPengeluaran)
            ->setHeight(237)
            ->setXAxis($kakeiboName);
    }
}
