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
            "data" => auth("web")->check() ? Relawan::with(["caleg", "desa"])->get() : Relawan::with(['caleg', 'desa.kecamatan'])->where("id_caleg", auth()->user()->id_caleg)->get(),
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
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }
        $data = $request->validate([
            "nik" => "required|unique:relawan",
            "nama_relawan" => "required|max:255",
            "jk" => "required",
            "id_desa" => "required",
            "id_caleg" => "required",
            "status" => "required",
            "loyalis" => "required",
            "status" => "required",
            "no_hp" => "required|min:11",
            "email" => "required|email:dns|max:255|unique:relawan",
            "username" => "required|max:255|unique:relawan",
            "password" => "required|max:255|min:3",
            "foto_ktp" => "image|max:2048|required"
        ]);

        $data['foto_ktp'] = $request->file("foto_ktp")->store("/images", "public_path");
        $data['password'] = bcrypt($data['password']);

        if (Relawan::create($data)) {
            return back()->with("success", "Success Create New Relawan");
        }

        return back()->with("error", "Error, Can't Create New Relawan");
    }

    public function delete($id)
    {
        $relawan = Relawan::find($id);
        if ($relawan->delete()) {
            Storage::disk("public_path")->delete($relawan->foto_ktp);
            return back()->with("success", "Success Delete Relawan");
        }
        return back()->with("error", "Error, Can't Delete Relawan");
    }

    public function update(Request $request, $id)
    {
        $relawan = Relawan::with("desa.kecamatan")->find($id);
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        if ($request->has('loyalis')) {
            if ($request->loyalis == $relawan->loyalis) {
                return back()->with("success", "Tidak ada yang diubah");
            }

            if ($relawan->update(["loyalis" => $request->loyalis])) {
                return back()->with("success", "Success Update Loyalis");
            }
            return back()->with("error", "Error, Can't Update Loyalis");
        }

        if ($request->has("saksi")) {
            if ($request->saksi == "N" && Relawan::with("desa")->where("id_desa", $relawan->id_desa)->where("saksi", "Y")->first()) {
                return back()->with("error", "Sudah ada saksi di wilayah ini!");
            }

            if ($relawan->update(["saksi" => $request->saksi == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Saksi");
            }
            return back()->with("error", "Erorr, Can't Update Saksi");
        }

        if ($request->has("jabatan")) {
            if ($request->jabatan == $relawan->jabatan) {
                return back()->with("success", "Tidak ada yang diubah");
            }

            if (
                $request->jabatan == 1
                &&
                Relawan::with("desa")->where("id_desa", $request->desa)->where("jabatan", $request->jabatan)->first()
                )
            {
                return back()->with("error", "Jabatan untuk daerah ini sudah diambil oleh orang lain!");
            }

            if ($request->jabatan == 2 && gettype(Relawan::with("desa.kecamatan")->get()->filter(function($value, $i) use ($relawan) {
                    return $value->desa->kecamatan->nama_kecamatan == $relawan->desa->kecamatan->nama_kecamatan;
                })->search(function($value, $i) use ($request) {
                    return $value->jabatan == $request->jabatan;
                })) == "integer") {
                return back()->with("error", "Jabatan untuk daerah ini sudah diambil oleh orang lain!");
                }

            if ($relawan->update(["jabatan" => $request->jabatan])) {
                return back()->with("success", "Success Update Jabatan");
            }
            return back()->with("error", "Error, Can't Update Jabatan");
        }

        if ($request->has("blokir")) {
            if ($relawan->update(["blokir" => $request->blokir == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Block Status");
            }
            return back()->with("error", "Error, Can't Update Block status");

        }

        $rules = [
            "nama_relawan" => "required|max:255",
            "jk" => "required",
            "id_desa" => "required",
            "id_caleg" => "required",
            "status" => "required",
            "username" => "required|max:255",
            "foto_ktp" => "image|max:2048"
    ];

    if ($request->nik !== $relawan->nik) {
        $rules["nik"] = "required|unique:relawan";
    }

    if ($request->email !== $relawan->email) {
        $rules["email"] = "email|max:255|required|unique:relawan";
    }

    if ($request->no_hp !== $relawan->no_hp) {
        $rules["no_hp"] = "max:255|min:11|required|unique:relawan";
    }

    $data = $request->validate($rules);

    if ($request->hasFile("foto_ktp")) {
        Storage::disk("public_path")->delete($relawan->foto_ktp);
        $data['foto_ktp'] = $request->file("foto_ktp")->store("/images", "public_path");
    }

    if ($request->password) {
        $data["password"] = bcrypt($request->password);
    }

    if ($relawan->update($data)) {
        return back()->with("success", "Success Update Relawan");
    }
    return back()->with("error", "Error, Can't Update Relawan");
    }

    public function upline($id) {
        return view("relawan.upline", [
            "title" => "Upline " . Relawan::where("id_relawan", $id)->first()->nama_relawan,
            "data" => Relawan::with(["caleg", "desa"])->where("upline", $id)->get()
    ]);
    }
}
