<?php

namespace App\Http\Controllers\Transaksi;

use DataTables;
use App\Models\Stok;
use App\Models\Saldo;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Models\MetodePembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // <a href="' . route('penjualan.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Edit</a>
        if ($request->ajax()) {
            $data = Penjualan::with('detail')->where('is_active', false)->latest();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx bx-dots-vertical-rounded"></i>
                        </button>
                        <form class="dropdown-menu" action="' . route('penjualan.destroy', $row->id) . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a href="' . route('penjualan.show', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Detail</a>
                            <a href="' . route('penjualan.show', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Cetak Nota</a>
                            <button class="dropdown-item text-danger"><i class="bx bx-trash text-danger me-2"></i>Hapus</button>
                        </form>
                    </div>';
                })
                ->addColumn('items', function ($item) {
                    return $item->detail->map(function ($detail) {
                        // return '<span>' . $detail->produk->nama_produk . '</span>';
                        return '<div class="d-flex justify-content-between align-items-center mb-1"><div>' . $detail->produk->nama_produk . '</div><div class="text-end">x' . number_format($detail->qty) . '</div></div>';
                    })->implode('');
                })
                ->addColumn('payment', function ($item) {
                    return $item->payment->map(function ($detail) {
                        return '<div class="d-flex justify-content-between align-items-center mb-1"><div>' . $detail->method->metode . '</div><div class="text-end">' . number_format($detail->total_bayar) . '</div></div>';
                    })->implode('');
                })
                ->editColumn('tgl_jual', function ($row) {
                    return tglIndo($row->tgl_jual);
                })
                ->editColumn('grand_total', function ($row) {
                    return number_format($row->grand_total);
                })
                ->editColumn('diskon', function ($row) {
                    return number_format($row->diskon);
                })
                ->editColumn('total', function ($row) {
                    return number_format($row->total);
                })
                ->rawColumns(['action', 'items', 'payment'])
                ->make(true);
        }
        return view('transaksi.penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk        = Produk::where('is_active', true)->get();
        $stok          = Stok::whereDate('tgl_stok', now())->count();
        $saldo         = Saldo::whereDate('tgl_saldo', now())->count();
        $pesanan_aktif = Penjualan::where('id_user', Auth::user()->id)->where('is_active', true)->count();
        $metode        = MetodePembayaran::get();
        if ($stok < 1) {
            return redirect()->route('stok.index')->with('error', 'Input Stok Terlebih Dahulu!');
        } elseif ($saldo < 1) {
            return redirect()->route('saldo.index')->with('error', 'Input Saldo Awal Terlebih Dahulu!');
        } elseif ($pesanan_aktif > 0) {
            $pesanan = Penjualan::where('id_user', Auth::user()->id)->where('is_active', true)->first();
        } else {
            $pesanan = Penjualan::create([
                'id_user' => Auth::user()->id,
                'tgl_jual' => date('Y-m-d'),
                'is_active' => true,
            ]);
        }
        return view('transaksi.penjualan.buat', compact('produk', 'pesanan', 'metode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input  = $request->all();
        $date   = date('Y-m-d');
        $data   = Penjualan::findOrFail($input['id_penjualan']);
        $total  = (int) array_sum(ambilAngka($input['total']));
        $diskon = 0 * $total;
        if (isset($input['metode_bayar'])) {
            foreach ($input['metode_bayar'] as $key => $value) {
                Pembayaran::create([
                    'tgl_bayar'     => $date,
                    'id_penjualan'  => $data->id,
                    'id_pembayaran' => $value,
                    'total_bayar'   => ambilAngka($input['total'][$key]),
                ]);
            }

            try {
                $data->tgl_jual    = $date;
                $data->total       = $total;
                $data->diskon      = $diskon;
                $data->grand_total = $total - $diskon;
                $data->is_active   = false;
                $data->save();
                return redirect()->route('penjualan.index')->with('success', 'Transaksi telah berhasil!');
            } catch (\Throwable $th) {
                return redirect()->route('penjualan.index')->with('error', 'Gagal: ' . $th->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'Mohon pilih metode pembayaran terlebih dahulu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Penjualan::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal: ' . $th->getMessage());
        }
    }
}
