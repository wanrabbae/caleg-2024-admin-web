<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
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

        return view("residences.kabupaten", [
            "title" => "Kabupaten Page",
            "dataArr" => Kabupaten::with("provinsi")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
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
            return response()->json(Kabupaten::find($request->data), 200);
        }

        if ($request->has("getDapil") && $request->getDapil) {
            $data = Provinsi::find($request->data)->jumlah_dapil;
            $text = "";
            for ($i = 1; $i < $data + 1; $i++) {
                $text .= "<option value='$i'>$i</option>";
            }
            return response()->json($text, 200);
        }

        $data = $request->validate([
            "nama_kabupaten" => "required|max:255|unique:kabupaten",
            "id_provinsi" => "required",
            "dapil" => "",
            "jumlah_dapil" => "nullable|numeric"
        ]);

        if (Kabupaten::create($data)) {
            return back()->with("success", "Success Create New Kabupaten");
        }
        return back()->with("error", "Error When Creating New Kabupaten");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function edit(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $rules = [
            "id_provinsi" => "required",
            "jumlah_dapil" => "nullable|numeric"
        ];

        if ($request->dapil != "") {
            $rules["dapil"] = "";
        }

        if ($request->nama_kabupaten != $kabupaten->nama_kabupaten) {
            $rules["nama_kabupaten"] = "required|max:255|unique:kabupaten";
        }
        
        $data = $request->validate($rules);

        if ($kabupaten->update($data)) {
            return back()->with("success", "Success Update Kabupaten");
        }
        return back()->with("error", "Error When Updating Kabupaten");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kabupaten $kabupaten)
    {
        if ($kabupaten->delete()) {
            return back()->with("success", "Success Delete Kabupaten");
        }
        return back()->with("error", "Error When Deleting Kabupaten");
    }
}
