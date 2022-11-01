<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Caleg;
use App\Models\Legislatif;
use App\Models\Partai;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Monitoring_Saksi;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class CalegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        }

        return view("caleg.index", [
            "title" => "Caleg Page",
            "dataArr" => Caleg::with(["partai", "legislatif", "kabupaten", "provinsi"])->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            "legislatif" => Legislatif::all(),
            "partai" => Partai::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has("getData") && $request->getData) {
            return response()->json(Caleg::find($request->data), 200);
        }

        if ($request->has("getLevel") && $request->getLevel) {
            return response()->json(Caleg::find($request->data), 200);
        }

        $data = $request->validate([
            "demo" => "required",
            "nama_caleg" => "required|max:255",
            "nama_lengkap" => "required|max:255",
            "id_legislatif" => "required",
            "level" => "required",
            "id_provinsi" => "required",
            "id_kabupaten" => Legislatif::find($request->id_legislatif)->type == "Kabupaten" ? "required" : "",
            "dapil" => "required",
            "alamat" => "required|max:255",
            "no_hp" => "required|max:20|min:10|unique:caleg",
            "email" => "required|email|max:100|unique:caleg",
            "id_partai" => "required",
            //"aktif" => "required",
            "username" => "required|unique:caleg|max:30",
            "password" => "required|min:4",
            "foto" => "required|image|max:5120"
        ]);


        $data["foto"] = $request->file("foto")->store("/images", "public_path");
        $data["password"] = bcrypt($data["password"]);

        if (Caleg::create($data)) {
            return back()->with("success", "Success Create New Caleg");
        }
        return back()->with("erorr", "Error When Creating New Caleg");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function show(Caleg $caleg)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function edit(Caleg $caleg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Caleg $caleg)
    {
        if ($request->aktif) {
            if (Caleg::where("id_caleg", $caleg->id_caleg)->update(["aktif" => $request->aktif == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Aktif Status");
            }
            return back()->with("error", "Error, Can't Update Aktif status");
        }

        if ($request->demo) {
            if (Caleg::where("id_caleg", $caleg->id_caleg)->update(["demo" => $request->demo == "Y" ? "N" : "Y"])) {
                return back()->with("success", "Success Update Demo Status");
            }
            return back()->with("error", "Error, Can't Update Aktif Status");
        }

        if ($request->level) {
            if (Caleg::where("id_caleg", $caleg->id_caleg)->update(["level" => $request->level])) {
                return back()->with("success", "Success Update Subscribe");
            }
            return back()->with("error", "Error, Can't Update Subscribe");
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
            $rules["email"] = "required|email|max:100|unique:caleg";
        }

        if ($request->username !== $caleg->username) {
            $rules["username"] = "required|unique:caleg|max:30";
        }

        if ($request->has("id_provinsi") && $request->id_provinsi !== $caleg->id_provinsi) {
            $rules["id_provinsi"] = "required";
        }

        if ($request->has("id_kabupaten") && $request->id_kabupaten !== $caleg->id_kabupaten) {
            $rules["id_kabupaten"] = "required";
        }

        if ($request->has("dapil") && $request->dapil !== $caleg->dapil) {
            $rules["dapil"] = "required";
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caleg  $caleg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caleg $caleg)
    {
        if (Caleg::destroy($caleg->id_caleg)) {
            File::delete($caleg->foto);
            return back()->with("success", "Success Delete $caleg->nama_caleg");
        }
        return back()->with("error", "Error When Deleting $caleg->nama_caleg Caleg");
    }

    public function fetch(Request $request) {
        if ($request->has("getData") && $request->getData) {
            $arr = Monitoring_Saksi::with(["desa.kecamatan.kabupaten"])->where("id_caleg", $request->data)->get();
            $data = ["Suara", 0, 0];

            foreach ($arr as $suara) {
                $data[2] += $suara->suara_2024;
            }

            $data[1] = Caleg::find($request->data)->harapan_suara;

            return response()->json([$data], 200);
        }
    }
}