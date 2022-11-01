<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;

class RelawanController extends Controller
{
    public function index()
    {
        return view('rekap.relawan', [
            'title' => 'Halaman Data Relawan'
        ]);
    }

    // public function show($id)
    // {
    //     return response()->json(Relawan::find($id));
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         "nik" => "required|integer",
    //         "nama_relawan" => "required|max:255|unique:relawan",
    //         "id_desa" => "required|integer",
    //         "id_caleg" => "required|integer",
    //         "status" => "required|integer",
    //         "no_hp" => "required|min:11",
    //         "email" => "required|email|max:255",
    //         "username" => "required|max:255|unique:relawan",
    //         "password" => "required|max:255|min:3",
    //         "foto_ktp" => "image|max:2048|required"
    //     ]);

    //     $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
    //     $data['password'] = bcrypt($data['password']);

    //     if (Relawan::create($data)) {
    //         return back()->with("success", "Success Create New Relawan");
    //     }

    //     return back()->with("error", "Error, Can't Create New Relawan");
    // }

    // public function delete($id)
    // {
    //     $relawan = Relawan::find($id);
    //     Storage::delete($relawan->foto_ktp);
    //     if ($relawan->delete()) {
    //         return back()->with("success", "Success Delete Relawan");
    //     }
    //     return back()->with("error", "Error, Can't Delete Relawan");
    // }

    // public function update(Request $request, $id)
    // {
    //     $relawan = Relawan::find($id);
    //     // update data relawan
    //     $data = $request->validate([
    //         "nik" => "integer",
    //         "nama_relawan" => "max:255",
    //         "id_desa" => "integer",
    //         "id_caleg" => "integer",
    //         "status" => "integer",
    //         "no_hp" => "min:11",
    //         "email" => "email|max:255",
    //         "username" => "max:255",
    //         "password" => "max:255",
    //         "foto_ktp" => "image|max:2048"
    //     ]);

    //     if ($request->hasFile("foto_ktp")) {
    //         Storage::delete($relawan->foto_ktp);
    //         $data['foto_ktp'] = $request->file("foto_ktp")->store("/image");
    //     }
    //     $data['password'] = bcrypt($data['password']);
    //     if ($relawan->update($data)) {
    //         return back()->with("success", "Success Update Relawan");
    //     }
    //     return back()->with("error", "Error, Can't Update Relawan");
    // }

    public function fetch(Request $request) {
        if ($request->has("getData") && $request->getData) {
            if (auth("caleg")->check()) {
                $data = Relawan::with("desa.kecamatan")->where("id_caleg", $request->data)->first();
                $this->authorize("all-caleg", $data);
            }
        $arr = $request->data == 0 ? Relawan::with("desa.kecamatan")->get() : Relawan::with("desa.kecamatan")->where("id_caleg", $request->data)->get();
        $found = true;
        $data = [];
        
        foreach ($arr as $arr) {
            for ($i = 0; $i < count($data); $i++) {
                if (in_array($arr->desa->kecamatan->nama_kecamatan, $data[$i])) {
                    $arr->jk == "Laki-Laki" ? $data[$i][1]++ : $data[$i][2]++;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($data, [$arr->desa->kecamatan->nama_kecamatan, $arr->jk == "Laki-Laki" ? 1 : 0, $arr->jk == "Perempuan" ? 1 : 0]);
            }
            $found = true;
        }
        return response()->json($data, 200);
        }
    }
}