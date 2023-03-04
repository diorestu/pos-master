<?php

namespace App\Http\Controllers;

use App\Charts\StockChart;
use App\Models\Penjualan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(StockChart $chart)
    {
        $out = Pengeluaran::whereDate('tgl_keluar', date('Y-m-d'))->sum('jumlah');
        $in = Penjualan::whereDate('tgl_jual', date('Y-m-d'))->sum('grand_total');
        return view('home', [
            'in'    => $in,
            'out'   => $out,
            'chart' => $chart->build()
        ]);
    }
}
