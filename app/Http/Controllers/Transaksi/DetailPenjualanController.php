<?php

namespace App\Http\Controllers\Transaksi;

use DataTables;
use App\Models\Produk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Http\Controllers\Controller;
use App\Models\Stok;

class DetailPenjualanController extends Controller
{

    public function data_detail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DetailPenjualan::where('id_penjualan', $id)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="text-danger btndel cursor-pointer" data-id="' . $row->id . '" id="btnDel' . $row->id . '"><i class="bx bxs-x-circle"></i></a>';
                })
                ->addColumn('title', function ($row) {
                    return $row->produk->nama_produk;
                })
                ->addColumn('harga', function ($row) {
                    return 'Rp ' . number_format($row->produk->harga_produk);
                })
                ->editColumn('subtotal', function ($row) {
                    return 'Rp ' . number_format($row->subtotal);
                })
                ->addColumn('qty', function ($row) {
                    return '<input type="number" class="form-control quantity" data-id="' . $row->id . '"  name="qty" value="' . $row->qty . '"/>';
                })
                ->rawColumns(['action', 'qty', 'title', 'harga'])
                ->make(true);
        }
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input  = $request->all();
            $produk = Produk::find($input['id_produk'])->harga_produk;
            $stok   = Stok::whereDate('tgl_stok', date('Y-m-d'))->where('id_produk', $input['id_produk'])->first();
            $data   = DetailPenjualan::where('id_penjualan', $input['id_penjualan'])->where('id_produk', $input['id_produk'])->count();

            $input['qty']      = 1;
            $input['subtotal'] = $produk;

            if ($stok->qty_stok == 0) {
                return response()->json(['error' => 'Item tidak tersedia!']);
            } elseif ($data >= 1) {
                return response()->json(['error' => 'Item kosong!']);
            } else {
                DetailPenjualan::create($input);
                $stok->qty_stok    = (int)$stok->qty_stok - 1;
                $stok->save();
                return response()->json(['success' => 'Berhasil Menambahkan Item']);
            }
        } catch (QueryException $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPenjualan  $detailPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPenjualan $detailPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailPenjualan  $detailPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPenjualan $detailPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailPenjualan  $detailPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input          = $request->all();
        $data           = DetailPenjualan::findOrFail($id);
        $harga          = Produk::where('id', $data->id_produk)->first();
        $stok           = Stok::whereDate('tgl_stok', date('Y-m-d'))->where('id_produk', $data->id_produk)->first();
        try {
            if ($data->qty >= $input['qty']) {
                $stok->qty_stok = $stok->qty_stok + 1;
            } else {
                $stok->qty_stok = $stok->qty_stok - 1;
            }
            $stok->save();
            $data->qty      = $input['qty'];
            $data->subtotal = (int) $input['qty'] * (int) $harga->harga_produk;
            $data->save();
            return response()->json(['success' => 'Item Berhasil Diupdate!']);
        } catch (QueryException $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPenjualan  $detailPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data           = DetailPenjualan::findOrFail($id);
            $stok           = Stok::whereDate('tgl_stok', date('Y-m-d'))->where('id_produk', $data->id_produk)->first();
            $stok->qty_stok = $stok->qty_stok + $data->qty;
            $stok->save();
            $data->delete();
            return response()->json(['success' => 'Item Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['success' => $th->getMessage()]);
        }
    }
}
