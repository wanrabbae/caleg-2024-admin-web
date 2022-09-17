<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Rk_pemilih;
use App\Models\User;
use Illuminate\Http\Request;

class DPTController extends Controller
{
    public function index()
    {
        return view('rekap.dpt', [
            'title' => 'DPT Page',
            'datas' => Rk_pemilih::all(),
            'desas' => Desa::all(),
            'users' => User::all()
        ]);
    }

    public function store()
    {
    }

    public function show($id)
    {
        return response()->json(Rk_pemilih::find($id));
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}
