<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Stok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxDataController extends Controller
{
    public function data_produk(Request $request)
    {
        if ($request->ajax()) {
            return '';
        }
    }

    public function stok(Request $request)
    {
        if ($request->ajax()) {
            return Stok::whereDate('tgl_stok', date('Y-m-d'))->orderBy('id_produk', 'ASC')->pluck('qty_stok')->toArray();
        }
    }
}
