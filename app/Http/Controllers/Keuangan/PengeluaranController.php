<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengeluaran::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx bx-dots-vertical-rounded"></i>
                        </button>
                        <form class="dropdown-menu" action="' . route('pengeluaran.destroy', $row->id) . '" method="post">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a href="' . route('pengeluaran.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Edit</a>
                            <button class="dropdown-item text-danger"><i class="bx bx-trash text-danger me-2"></i>Hapus</button>
                        </form>
                    </div>';
                })
                ->addColumn('user', function ($row) {
                    return $row->user->name;
                })
                ->editColumn('jumlah', function ($row) {
                    return number_format($row->jumlah);
                })
                ->editColumn('tgl_keluar', function ($row) {
                    return tglIndo($row->tgl_keluar);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('keuangan.index');
    }

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
        $input               = $request->all();
        $input['tgl_keluar'] = date('Y-m-d');
        $input['jumlah']     = ambilAngka($request->jumlah);
        $input['id_user']    = Auth::user()->id;
        try {
            Pengeluaran::create($input);
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
        $data = Pengeluaran::findOrFail($id);
        return view('keuangan.edit', compact('data'));
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
        $input = $request->all();
        try {
            $data = Pengeluaran::findOrFail($id);
            $data->nama   = $input['nama'];
            $data->jumlah = ambilAngka($input['jumlah']);
            $data->save();
            return redirect()->route('pengeluaran.index')->with('success', 'Berhasil Update Data');
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
            Pengeluaran::find($id)->delete();
            return redirect()->back()->with('success', 'Berhasil Hapus Data!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
