<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
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
        return view("residences.kecamatan", [
            "title" => "Kecamatan Page",
            "dataArr" => Kecamatan::with("kabupaten.provinsi")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
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
            return response()->json(Kecamatan::find($request->data), 200);
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

        if ($request->has("getDapil") && $request->getDapil) {
            $data = Kabupaten::find($request->data)->jumlah_dapil;
            $text = "";
            for ($i = 1; $i < $data + 1; $i++) {
                $text .= "<option value='$i'>$i</option>";
            }
            return response()->json($text, 200);
        }

        $data = $request->validate([
            "nama_kecamatan" => "required|max:255|unique:kecamatan",
            "id_kabupaten" => "required",
            "dapil" => "nullable",
            "wilayah" => "nullable",
        ]);

        if (Kecamatan::create($data)) {
            return back()->with("success", "Success Create New Desa");
        }
        return back()->with("error", "Error When Creating New Desa");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $rules = [
            "wilayah" => "",
        ];
        
        if ($request->id_kabupaten && $request->id_kabupaten != $kecamatan->id_kabupaten) {
            $rules["id_kabupaten"] = "required";
        }

        if ($request->dapil != "") {
            $rules["dapil"] = "";
        }
        
        if ($request->nama_kecamatan != $kecamatan->nama_kecamatan) {
            $rules["nama_kecamatan"] = "required|max:255|unique:kecamatan";
        }
 
        $data = $request->validate($rules);

        if ($kecamatan->update($data)) {
            return back()->with("success", "Success Update Kecamatan");
        }
        return back()->with("error", "Error When Updating Kecamatan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if ($kecamatan->delete()) {
            return back()->with("success", "Success Delete Kecamatan");
        }
        return back()->with("error", "Error When Deleting Kecamatan");
    }
}
