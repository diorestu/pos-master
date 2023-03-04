<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportHarian()
    {
        $awal = Saldo::whereDate('tgl_saldo', now())->first();
        $out     = Pengeluaran::whereDate('tgl_keluar', now())->get();
        $payment = Pembayaran::whereDate('tgl_bayar', now())->select('metode_pembayarans.metode', DB::raw('sum(total_bayar) as total'))
            ->leftJoin('metode_pembayarans', 'pembayarans.id_pembayaran', '=', 'metode_pembayarans.id')
            ->groupBy('metode')
            ->get();
        $data = [
            'title'   => 'Laporan Harian',
            'date'    => now(),
            'payment' => $payment,
            'out'     => $out,
            'awal'     => $awal,
        ];
        $pdf = PDF::loadView('print.report_harian', $data);
        $pdf->setPaper('a4', 'portrait')->setOptions(['isHtml5ParserEnabled' => false, 'isRemoteEnabled' => true]);

        return $pdf->stream('Laporan Harian.pdf');
    }

    public function reportBulanan()
    {
        $awal    = Saldo::whereMonth('tgl_saldo', now())->get();
        $out     = Pengeluaran::whereMonth('tgl_keluar', now())->get();
        $payment = Pembayaran::whereMonth('tgl_bayar', now())->select('metode_pembayarans.metode', DB::raw('sum(total_bayar) as total'))
            ->leftJoin('metode_pembayarans', 'pembayarans.id_pembayaran', '=', 'metode_pembayarans.id')
            ->groupBy('metode')
            ->get();
        $data = [
            'title'   => 'Laporan Bulanan',
            'date'    => Carbon::now()->isoFormat('MMMM YYYY'),
            'payment' => $payment,
            'out'     => $out,
            'awal'    => $awal,
        ];
        $pdf = PDF::loadView('print.report_bulanan', $data);
        $pdf->setPaper('a4', 'portrait')->setOptions(['isHtml5ParserEnabled' => false, 'isRemoteEnabled' => true]);

        return $pdf->stream('Laporan Bulanan.pdf');
    }

    public function showReportPeriode()
    {
        return view('print.view_report');
    }
    public function printReportPeriode(Request $r)
    {
        $tanggal =  explode(' - ', $r->tanggal);
        $awal    = Saldo::whereDate('tgl_saldo', '>=', $tanggal[0])->whereDate('tgl_saldo', '<=', $tanggal[1])->get();
        $out     = Pengeluaran::whereDate('tgl_keluar', '>=', $tanggal[0])->whereDate('tgl_keluar', '<=', $tanggal[1])->get();
        $payment = Pembayaran::whereDate('tgl_bayar', '>=', $tanggal[0])->whereDate('tgl_bayar', '<=', $tanggal[1])->select('metode_pembayarans.metode', DB::raw('sum(total_bayar) as total'))
            ->leftJoin('metode_pembayarans', 'pembayarans.id_pembayaran', '=', 'metode_pembayarans.id')
            ->groupBy('metode')
            ->get();
        $data = [
            'title'   => 'Laporan Keuangan',
            'date'    => $tanggal,
            'payment' => $payment,
            'out'     => $out,
            'awal'    => $awal,
        ];
        $pdf = PDF::loadView('print.report_general', $data);
        $pdf->setPaper('a4', 'portrait')->setOptions(['isHtml5ParserEnabled' => false, 'isRemoteEnabled' => true]);

        return $pdf->stream('Laporan Keuangan.pdf');
    }
}
