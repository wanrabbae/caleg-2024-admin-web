<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CalegCtrl extends Controller
{
    public function index()
    {
        $caleg = Caleg::where('aktif', 'Y')->orderBy('id_caleg', 'ASC')->get();

        return response()->json([
            "caleg" => $caleg,
        ],);
    }

    public function createCaleg(Request $request)
    {
        $data = $request->validate([
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "alamat" => "required|max:255",
            "no_hp" => "required|max:20|min:10|unique:caleg",
            "email" => "required|email:dns|max:100|unique:caleg",
            "id_partai" => "required",
            //"aktif" => "required",
            "username" => "required|unique:caleg|max:30",
            "password" => "required|min:4",
            "foto" => "required|image|max:5120"
        ]);


        $data["foto"] = $request->file("foto")->store("/images", "public_path");
        $data["password"] = bcrypt($data["password"]);

        if (Caleg::create($data)) {
            // return back()->with("success", "Success Create New Caleg");
            return response()->json(['message' => "Success Create New Caleg", 'data' => $data], 200, );
        }
        return response()->json(['message' => "Error When Creating New Caleg"], 500, );
    }

    public function updateCaleg(Request $request, Caleg $caleg)
    {
        if ($request->aktif) {
            if (Caleg::where("id_caleg", $caleg->id_caleg)->update(["aktif" => $request->aktif == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Aktif Status");
            }
            return back()->with("error", "Error, Can't Update Aktif status");
        }

        $rules = [
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "alamat" => "required|max:255",
            "id_partai" => "required",
            "foto" => "file|image|max:5120"
        ];

        if ($request->no_hp !== $caleg->no_hp) {
            $rules["no_hp"] = "required|max:20|min:10|unique:caleg";
        }

        if ($request->email !== $caleg->email) {
            $rules["email"] = "required|email:dns|max:100|unique:caleg";
        }

        if ($request->username !== $caleg->username) {
            $rules["username"] = "required|unique:caleg|max:30";
        }

        if ($request->password) {
            $rules["password"] = "min:4|max:255|required";
        }

        $data = $request->validate($rules);

        if ($request->has("foto")) {
            if (File::exists($caleg->foto)) {
                File::delete($caleg->foto);
            }
            $data["foto"] = $request->file("foto")->store("/images", "public_path");
        }

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        if (Caleg::find($caleg->id_caleg)->update($data)) {
            return back()->with("success", "Success Update Caleg");
        }
        return back()->with("erorr", "Error When Updating Caleg");
    }

    public function deleteCaleg(Caleg $caleg)
    {
        if (Caleg::destroy($caleg->id_caleg)) {
            File::delete($caleg->foto);
            return back()->with("success", "Success Delete $caleg->nama_caleg");
        }
        return back()->with("error", "Error When Deleting $caleg->nama_caleg Caleg");
    }
}
