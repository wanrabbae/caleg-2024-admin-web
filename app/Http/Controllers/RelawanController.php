<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Desa;
use App\Models\Relawan;
use Illuminate\Http\Request;

class RelawanController extends Controller
{
    public function index()
    {
        return view('relawan.index', [
            'title' => 'Halaman Daftar Relawan',
            'relawan' => Relawan::with(['caleg', 'desa'])->get(),
            'desa' => Desa::all(['id_desa', 'nama_desa']),
            'caleg' => Caleg::all(['id_caleg', 'nama_caleg']),
        ]);
    }

    public function show($id)
    {
        return response()->json(Relawan::find($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "nik" => "required|integer",
            "nama_relawan" => "required|max:255|unique:relawan",
            "id_desa" => "required|integer",
            "id_caleg" => "required|integer",
            "status" => "required|integer",
            "no_hp" => "required|min:11",
            "email" => "required|email|max:255",
            "username" => "required|max:255|unique:relawan",
            "password" => "required|max:255|min:3",
            "foto_ktp" => "image|max:2048|required"
        ]);

        $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
        $data['password'] = bcrypt($data['password']);

        if (Relawan::create($data)) {
            return back()->with("success", "Success Create New Relawan");
        }

        return back()->with("error", "Error, Can't Create New Partai");
    }

    public function delete($id)
    {
        $relawan = Relawan::find($id);
        if ($relawan->delete()) {
            return back()->with("success", "Success Delete Relawan");
        }
        return back()->with("error", "Error, Can't Delete Relawan");
    }

    public function update(Request $request, $id)
    {
        $relawan = Relawan::find($id);
        // update data relawan
        $data = $request->validate([
            "nik" => "required|integer",
            "nama_relawan" => "required|max:255",
            "id_desa" => "required|integer",
            "id_caleg" => "required|integer",
            "status" => "required|integer",
            "no_hp" => "required|min:11",
            "email" => "required|email|max:255",
            "username" => "required|max:255",
            "password" => "required|max:255|min:3",
            "foto_ktp" => "image|max:2048"
        ]);

        if ($request->hasFile("foto_ktp")) {
            $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
        }
        $data['password'] = bcrypt($data['password']);
        if ($relawan->update($data)) {
            return back()->with("success", "Success Update Relawan");
        }
        return back()->with("error", "Error, Can't Update Relawan");
    }
}
