<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use DataTables;

class MetodePembayaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MetodePembayaran::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx bx-dots-vertical-rounded"></i>
                        </button>
                        <form class="dropdown-menu" action="' . route('metode-bayar.destroy', $row->id) . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a href="' . route('metode-bayar.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Edit</a>
                            <button class="dropdown-item text-danger"><i class="bx bx-trash text-danger me-2"></i>Hapus</button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.metode_bayar.index');
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
            MetodePembayaran::create($input);
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
        $data = MetodePembayaran::findOrFail($id);
        return view('admin.metode_bayar.edit', compact('data'));
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
        $data = MetodePembayaran::findOrFail($id);
        try {
            $data->metode = $request->metode;
            $data->keterangan = $request->keterangan;
            $data->save();
            return redirect()->route('metode-bayar.index')->with('success', 'Berhasil Update Data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal: ' . $th->getMessage());
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
            MetodePembayaran::find($id)->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
