<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('users.show', $row->id) . '" class="badge bg-pink"><i class="bx bxs-cog"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function show($id)
    {
        return view('users.edit');
    }
}
