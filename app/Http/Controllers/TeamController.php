<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return view('relawan.index', [
            'title' => 'Halaman Team Relawan',
            'data' => Relawan::with(['caleg', 'desa.kecamatan'])->get(),
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
            "nik" => "required|integer|unique:relawan",
            "nama_relawan" => "required|max:255",
            "id_desa" => "required|integer",
            "id_caleg" => "required|integer",
            "status" => "required|integer",
            "loyalis" => "required|integer",
            "status" => "required|integer",
            "no_hp" => "required|min:11",
            "email" => "required|email:dns|max:255|unique:relawan",
            "username" => "required|max:255|unique:relawan",
            "password" => "required|max:255|min:3",
            "foto_ktp" => "image|max:2048|required"
        ]);

        $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
        $data['password'] = bcrypt($data['password']);

        if (Relawan::create($data)) {
            return back()->with("success", "Success Create New Relawan");
        }

        return back()->with("error", "Error, Can't Create New Relawan");
    }

    public function delete($id)
    {
        $relawan = Relawan::find($id);
        Storage::delete($relawan->foto_ktp);
        if ($relawan->delete()) {
            return back()->with("success", "Success Delete Relawan");
        }
        return back()->with("error", "Error, Can't Delete Relawan");
    }

    public function update(Request $request, $id)
    {
        $relawan = Relawan::find($id);
        if ($request->has('loyalis')) {
            if ($relawan->update(["loyalis" => $request->loyalis])) {
                return back()->with("success", "Success Update Loyalis");
            }
            return back()->with("error", "Error, Can't Update Loyalis");

        } else if ($request->has("jabatan")) {
            if (
                ($request->jabatan == 1 || $request->jabatan == 2)
                && 
                (Relawan::with("desa")->where("id_desa", $request->desa)->where("jabatan", $request->jabatan)->first())
                ) 
            {
                return back()->with("error", "Jabatan ini sudah diambil oleh orang lain!");
            }
            
            if ($relawan->update(["jabatan" => $request->jabatan])) {
                return back()->with("success", "Success Update Jabatan");
            }
            return back()->with("error", "Error, Can't Update Jabatan");
        
        }

        else {
        // update data relawan
    $data = $request->validate([
        "nik" => "integer",
        "nama_relawan" => "max:255",
        "id_desa" => "integer",
        "id_caleg" => "integer",
        "status" => "integer",
        "no_hp" => "min:11",
        "email" => "email|max:255",
        "username" => "max:255",
        "password" => "max:255",
        "foto_ktp" => "image|max:2048"
    ]);
    
    if ($request->hasFile("foto_ktp")) {
        Storage::delete($relawan->foto_ktp);
        $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
    }
    $data['password'] = bcrypt($data['password']);
    if ($relawan->update($data)) {
        return back()->with("success", "Success Update Relawan");
    }
    return back()->with("error", "Error, Can't Update Relawan");
    }
    }

    public function upline($id) {
        return view("relawan.upline", [
            "title" => "Upline " . Relawan::where("id_relawan", $id)->first()->nama_relawan,
            "data" => Relawan::with(["caleg", "desa"])->where("upline", $id)->get()
    ]);
    }
}
