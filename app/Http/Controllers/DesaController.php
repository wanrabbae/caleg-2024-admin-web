<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
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
        };

        return view("residences.desa", [
            "title" => "Desa Page",
            "dataArr" => Desa::with("kecamatan.kabupaten.provinsi")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            "provinsi" => Provinsi::all()
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
            return response()->json(Desa::find($request->data), 200);
        }

        if ($request->has("getProvinsi") && $request->getProvinsi) {
            $data = Kabupaten::where("id_provinsi", $request->data)->get();
            if (!$data->count()) {
                return response()->json("<option>Tidak ada Kabupaten</option>");
            }
            $text = "";
            foreach ($data as $kabupaten) {
                $text .= "<option value='$kabupaten->id_kabupaten'>$kabupaten->nama_kabupaten</option>";
            }
            return response()->json($text, 200);
        }

        if ($request->has("getKabupaten") && $request->getKabupaten) {
            $data = Kecamatan::where("id_kabupaten", $request->data)->get();
            if (!$data->count()) {
                return response()->json("<option>Tidak ada Kecamatan</option>");
            }
            $text = "";
            foreach ($data as $kecamatan) {
                $text .= "<option value='$kecamatan->id_kecamatan'>$kecamatan->nama_kecamatan</option>";
            }
            return response()->json($text, 200);
        }

        $data = $request->validate([
            "nama_desa" => "required|max:255",
            "id_kecamatan" => "required",
            "tps" => "required",
        ]);

        $data["type"] = "desa";

        if (Desa::create($data)) {
            return back()->with("success", "Success Create New Desa");
        }
        return back()->with("error", "Error When Creating New Desa");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $rules = [
            "tps" => "required",
        ];

        if ($request->id_kecamatan && $request->id_kecamatan != $desa->id_kecamatan) {
            $rules["id_kecamatan"] = "required";
        }

        if ($request->nama_desa != $desa->nama_desa) {
            $rules["nama_desa"] = "required|max:255|unique:desa";
        }

        $data = $request->validate($rules);

        if (Desa::find($desa->id_desa)->update($data)) {
            return back()->with("success", "Success Update Desa");
        }
        return back()->with("error", "Error When Updating Desa");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        if ($desa->delete()) {
            return back()->with("success", "Success Delete Desa");
        }
        return back()->with("error", "Error When Deleting Desa");
    }
}
