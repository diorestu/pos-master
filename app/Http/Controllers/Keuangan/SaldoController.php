<?php

namespace App\Http\Controllers\Keuangan;

use DataTables;
use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaldoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Saldo::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="' . route('saldo.edit', $row->id) . '" class="dropdown-item"><i class="bx bx-edit me-2"></i> Edit</a>
                        </div>
                    </div>';
                })
                ->addColumn('harga', function ($row) {
                    return number_format($row->saldo_awal);
                })
                ->addColumn('tanggal', function ($row) {
                    return tglIndo($row->tgl_saldo);
                })
                ->rawColumns(['action', 'harga', 'tanggal'])
                ->make(true);
        }

        $data = Saldo::whereDate('created_at', now())->count();
        return view('keuangan.saldo_index', compact('data'));
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
        $input               = $request->all();
        $input['saldo_awal'] = ambilAngka($input['saldo_awal']);
        $input['tgl_saldo']  = date('Y-m-d');
        try {
            Saldo::create($input);
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
        try {
            $data = Saldo::findOrFail($id);
            return view('keuangan.saldo_edit', compact('data'));
        } catch (\Throwable $th) {
            redirectError('stok.index', $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        try {
            $input = $r->all();
            // dd($input);

            $data = Saldo::findOrFail($id);
            $data->saldo_awal = ambilAngka($input['saldo_awal']);
            $data->save();
            return redirect()->route('saldo.index')->with('success', 'Berhasil Update Saldo Awal!');
        } catch (\Throwable $th) {
            redirectError('saldo.index', $th->getMessage());
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
        //
    }
}
