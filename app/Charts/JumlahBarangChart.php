<?php

namespace App\Charts;

use App\Models\Barang;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahBarangChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $barang = Barang::all();
        $namaBarang = [];
        $stokBarang = [];

        foreach($barang as $item) {
            $namaBarang[] = $item->nama;
            $stokBarang[] = $item->stok;
        }

        return $this->chart->barChart()
            ->setTitle('Chart Stok Barang')
            ->setSubtitle('Menampilkan stok per barang yang masih tersedia')
            ->addData('Stok Barang Tersedia', $stokBarang)
            ->setXAxis($namaBarang);
    }
}
