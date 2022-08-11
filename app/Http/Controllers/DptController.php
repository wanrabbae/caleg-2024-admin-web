<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Rk_pemilih;
use App\Models\User;
use Illuminate\Http\Request;

class DptController extends Controller
{
    public function index()
    {
        return view('rekap.dpt', [
            'title' => 'DPT / Pemilih Page',
            'datas' => Rk_pemilih::with('desa')->get(),
            'desas' => Desa::all(),
            'users' => User::all(),
        ]);
    }

    public function show($id)
    {
        return response()->json(Rk_pemilih::find($id));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|max:100|unique:rk_pemilih',
            'nama' => 'required|max:100',
            'tempat_lahir' => 'required|max:50',
            'tgl_lahir' => 'required|date',
            'tgl_data' => 'required|date|after_or_equal:today',
            'jk' => 'required|max:10',
            'tps' => 'required|integer|',
            'id_desa' => 'required|max:4',
            'relawan' => 'required',
            'saksi' => 'required',
            'id_users' => 'required|max:4'
        ]);

        if(Rk_pemilih::create($data)){
            return back()->with("success", "Success Create New Data DPT");
        }
        return back()->with("error", "Error, Can't Create New Data DPT");
    }
    public function update(Request $request, $id)
    {
        $pemilih = Rk_pemilih::find($id);

        $data = $request->validate([
            'nik' => 'max:100',
            'nama' => 'max:100',
            'tempat_lahir' => 'max:50',
            'tgl_lahir' => 'date',
            'tgl_data' => 'date|after_or_equal:today',
            'jk' => 'max:10',
            'tps' => 'integer|',
            'id_desa' => 'max:4',
            'relawan' => 'max:1',
            'saksi' => 'max:1',
            'id_users' => 'max:4'
        ]);

        if($pemilih->update($data)){
            return back()->with("success", "Success Update New Data DPT");
        }
        return back()->with("error", "Error, Can't Update New Data DPT");
    }
    public function delete($id)
    {
        $pemilih = Rk_pemilih::find($id);

        if($pemilih->delete()){
            return back()->with("success", "Success Delete Data DPT");
        }
        return back()->with("error", "Error, Can't Delete Data DPT");
    }
}
