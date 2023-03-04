<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use DataTables;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Produk::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('produk.edit', $row->id) . '" class=""><i class="bx bx-dots-vertical-rounded text-reset bx-md"></i></a>';
                })
                ->addColumn('modal-edit', function ($row) {
                    return '<button type="button" class="btn btn-ghost-dark p-0" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id . '"><i class="bx bx-dots-vertical-rounded text-reset bx-sm"></i>
                    </button>
                        <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal' . $row->id . '" tabindex="-1"
                            aria-labelledby="exampleModal' . $row->id . 'Label" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header bg-dark text-white">Edit Produk</div>
                                    <div class="modal-body">
                                        <form action="' . route('produk.update', $row->id) . '" method="post">
                                            ' . @csrf_field() . '
                                            ' . @method_field('PATCH') . '
                                            <div class="mb-3 row">
                                                <label class="col-4 col-form-label">Nama Produk</label>
                                                <div class="col">
                                                <input type="text" class="form-control" name="nama_produk" value="' . $row->nama_produk . '">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-4 col-form-label">Harga Produk</label>
                                                <div class="col">
                                                <input type="number" class="form-control" name="harga_produk" value="' . $row->harga_produk . '">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-4 col-form-label">Keterangan</label>
                                                <div class="col">
                                                <textarea class="form-control" rows="3" name="keterangan">' . $row->keterangan . '</textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 mb-2 ">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                })
                ->addColumn('harga', function ($row) {
                    return '<div class="d-flex justify-content-between align-items-center"><span>Rp</span>' . number_format($row->harga_produk) . '</div>';
                })
                ->rawColumns(['action', 'harga', 'modal-edit'])
                ->make(true);
        }
        return view('admin.produk.index');
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
        $input = $request->all();
        try {
            Produk::create($input);
            return redirect()->back()->with('success', 'Berhasil Tambah Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
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
        $data = Produk::findOrFail($id);
        // dd($request->all());
        try {
            $data->nama_produk = $request->nama_produk;
            $data->harga_produk = $request->harga_produk;
            $data->keterangan = $request->keterangan;
            $data->save();
            return redirect()->back()->with('success', 'Berhasil Update Data');
        } catch (\Throwable $th) {
            throw $th;
        }
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
            Produk::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
