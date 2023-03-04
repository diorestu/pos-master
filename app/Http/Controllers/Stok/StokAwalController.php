<?php

namespace App\Http\Controllers\Stok;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokAwalController extends Controller
{
    public function index()
    {
        $data = Produk::where('is_active', true)->get();
        $stok = Stok::whereDate('created_at', date('Y-m-d'))->where('is_active', true)->get();
        return view('transaksi.stok.index', compact('data', 'stok'));
    }

    public function store(Request $r)
    {
        $input = $r->all();
        $date  = date('Y-m-d');
        try {
            for ($i = 0; $i < count($input['qty_stok']); $i++) {
                Stok::create([
                    'tgl_stok'  => $date,
                    'id_produk' => $input['id_produk'][$i],
                    'qty_stok'  => $input['qty_stok'][$i],
                    'is_active' => true
                ]);
            }
            return redirect()->route('stok.index')->with('success', 'Berhasil Set Stok Hari Ini');
        } catch (\Throwable $th) {
            redirectError('stok.index', $th->getMessage());
        }
    }
    public function update(Request $r, $id)
    {
        try {
            $input = $r->all();
            $data = Stok::findOrFail($id);
            $data->qty_stok = $input['qty_stok'];
            $data->save();
            return redirect()->route('stok.index')->with('success', 'Berhasil Update Stok!');
        } catch (\Throwable $th) {
            redirectError('stok.index', $th->getMessage());
        }
    }
}
