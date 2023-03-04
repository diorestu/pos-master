<?php

namespace App\Charts;

use App\Models\Stok;
use App\Models\Produk;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StockChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Stok Hari Ini')
            ->addData('Qty', Stok::whereDate('tgl_stok', date('Y-m-d'))->orderBy('id_produk', 'ASC')->pluck('qty_stok')->toArray())
            ->setXAxis(Produk::pluck('nama_produk')->toArray())
            ->setColors(['#D32F2F', '#ff6384'])
            ->setFontFamily('Lato')
            ->setHeight(250)->setGrid();
    }
}
