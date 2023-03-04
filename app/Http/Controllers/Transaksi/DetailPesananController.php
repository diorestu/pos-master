<?php

namespace App\Http\Controllers\Transaksi;

use DataTables;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class DetailPesananController extends Controller
{
    public function data_detail(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DetailPesanan::where('id_pesanan', $id)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="btn text-danger btndel" data-id="' . $row->id . '" id="btnDel' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //
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
            $input             = $request->all();
            $produk            = Produk::find($input['id_produk'])->harga_produk;
            $input['qty']      = 1;
            $input['subtotal'] = $produk;
            $data              = DetailPesanan::where('id_pesanan', $input['id_pesanan'])->where('id_produk', $input['id_produk'])->count();
            if ($data > 0) {
                return response()->json(['error' => 'Item sudah diinput!']);
            } else {
                DetailPesanan::create($input);
                return response()->json(['success' => 'Berhasil Menambahkan Item']);
            }
        } catch (QueryException $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPesanan  $detailPesanan
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPesanan $detailPesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailPesanan  $detailPesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPesanan $detailPesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailPesanan  $detailPesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $input = $request->all();
            $data = DetailPesanan::findOrFail($id);
            $harga = Produk::where('id', $data->id_produk)->first();
            $data->qty = $input['qty'];
            $data->subtotal = (int) $input['qty'] * (int) $harga->harga_produk;
            $data->save();
            return response()->json(['success' => 'Laravel ajax example is being processed.']);
        } catch (QueryException $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPesanan  $detailPesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DetailPesanan::find($id)->delete();
            return response()->json(['success' => 'Item Berhasil Dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['success' => $th->getMessage()]);
        }
    }
}
