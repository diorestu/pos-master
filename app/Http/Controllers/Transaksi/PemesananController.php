<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use DataTables;

class PemesananController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pesanan::where('is_active', false)->get();
            return DataTables::of($data)->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     return '<div class="d-flex justify-content-between"><a class="btn text-danger me-2" data-id="' . $row->id . '"><i class="bx bx-trash"></i></a>
                //     <a class="btn text-danger btndel" data-id="' . $row->id . '"><i class="bx bx-trash"></i></a></div>';
                // })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx bx-dots-vertical-rounded"></i>
                        </button>
                        <form class="dropdown-menu" action="' . route('preorder.destroy', $row->id) . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a href="' . route('preorder.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Edit</a>
                            <button class="dropdown-item text-danger"><i class="bx bx-trash text-danger me-2"></i>Hapus</button>
                        </form>
                    </div>';
                })
                ->editColumn('total_bayar', function ($row) {
                    return number_format($row->total_bayar);
                })
                ->editColumn('bayar_dp', function ($row) {
                    return number_format($row->bayar_dp);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('transaksi.preorder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::where('is_active', true)->get();
        $pesanan_aktif = Pesanan::where('is_active', true)->count();
        // dd($pesanan_aktif);
        $metode = MetodePembayaran::get();
        if ($pesanan_aktif > 0) {
            $pesanan = Pesanan::where('is_active', true)->first();
        } else {
            $pesanan = Pesanan::create([
                'is_active' => true,
            ]);
        }

        return view('transaksi.preorder.buat', compact('produk', 'pesanan', 'metode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data = Pesanan::findOrFail($input['id_pesanan']);
        $input['tgl_pesan'] = date('Y-m-d');
        if (!isset($input['metode_bayar'])) {
            return redirect()->back()->with('error', 'Mohon pilih metode pembayaran terlebih dahulu');
        } elseif ($input['metode_bayar'] != null && isset($input['metode_bayar2'])) {
            return redirect()->back()->with('error', 'Elseif');
        } else {
            // dd($input);
            try {
                $data->tgl_pesan     = $input['tgl_pesan'];
                $data->nama_customer = $input['nama_pemesan'];
                $data->via_pemesanan = $input['via_pemesanan'];
                $data->phone1        = $input['telp_pemesan'];
                $data->id_pembayaran = $input['metode_bayar'];
                $data->total_bayar   = $input['bayar_dp'];
                $data->bayar_dp      = $input['total'];
                $data->phone1        = $input['telp_pemesan'];
                $data->is_active     = false;
                $data->save();
                return redirect()->route('preorder.index')->with('success', 'Berhasil Membuat Order ' . $data->kode_pesanan);
            } catch (\Throwable $th) {
                return redirect()->route('preorder.index')->with('error', $th->getMessage());
            }
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
            Pesanan::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
