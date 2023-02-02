<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Legislatif;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class DashboardLegislatifController extends Controller
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
        
        return view("dashboard.legislatif.legislatif", [
            "title" => "Legislatif Page",
            "dataArr" => Legislatif::search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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
            return response()->json(Legislatif::find($request->data), 200);
        }
        
        $data = $request->validate([
            "nama_legislatif" => "required|max:255|unique:legislatif",
            "type" => "required"
    ]);

        if (Legislatif::create($request->only('nama_legislatif'))) {
            return back()->with("success", "Success Create New Legislatif");
        }
        
        return back()->with("error", "Error, Can't Create New Legislatif");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function show(Legislatif $legislatif)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Legislatif $legislatif)
    {
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Legislatif $legislatif)
    {

        // if ($request->nama_legislatif == $legislatif->nama_legislatif) {
        //     return back();
        // }
        
        // $rules = [
        //     "type" => "required"
        // ];
        
        // $rules["nama_legislatif"] = "required|max:255|unique:legislatif";

        // $data = $request->validate($rules);

        // if (Legislatif::where("id_legislatif", $legislatif->id_legislatif)->update($data)) {
        //     return redirect("/dashboard/legislatif")->with("success", "Success Update $legislatif->nama_legislatif");
        // }

        // return back()->with("error", "Error, Can't Update $legislatif->nama_legislatif");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Legislatif  $legislatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Legislatif $legislatif)
    {
        if (Legislatif::destroy($legislatif->id_legislatif)) {
            return back()->with("success", "Success Delete $legislatif->nama_legislatif Legislatif");
        }

        return back()->with("error", "Error, Can't Delete $legislatif->nama_legislatif Legislatif");
    }
    
    public function provinsi(Request $request) {
        if ($request->has("getData") && $request->getData) {
            $data = Legislatif::find($request->data)->type;
            $text = "";
            $provinces = Provinsi::all();
            if (!$provinces->count()) {
                $text .= "<option value=''>Tidak Ada Provinsi</option>";
            } else {
                foreach ($provinces as $provinsi) {
                    $text .= "<option value='$provinsi->id_provinsi'>$provinsi->nama_provinsi</option>";
                }
                if ($data == "Provinsi") {
                    return response()->json(["Provinsi", $text], 200);
                } else {
                    return response()->json(["Kabupaten", $text], 200);
                }
            }
            return response()->json(["Provinsi", $text], 200);
        }
    }

    public function kabupaten(Request $request) {
        if ($request->has("getData") && $request->getData) {
            $provinces = Provinsi::find($request->data)->id_provinsi;
            $text = "";
            $kabupatens = Kabupaten::where("id_provinsi", $provinces)->get();
            if (!$kabupatens->count()) {
                $text .= "<option value=''>Tidak Ada Kabupaten</option>";
            } else {
                foreach ($kabupatens as $kabupaten) {
                    $text .= "<option value='$kabupaten->id_kabupaten'>$kabupaten->nama_kabupaten</option>";
                }
            }
            return response()->json($text, 200);
        }
    }
    
    public function dapil(Request $request) {
        if ($request->has("getData") && $request->getData) {
            if ($request->id == "provinsi" || $request->id == "edit_provinsi") {
                $provinces = Provinsi::find($request->data)->jumlah_dapil;
                $text = "";
                if ($provinces) {
                    for ($i = 1; $i < $provinces + 1; $i++) {
                        $text .= "<option value='$i'>$i</option>";
                    }
                } else {
                    $text .= "<option>Tidak Ada Dapil</option>";
                }
            } else {
                $kabupaten = Kabupaten::find($request->data)->jumlah_dapil;
                $text = "";
                if ($kabupaten) {
                    for ($i = 1; $i < $kabupaten + 1; $i++) {
                        $text .= "<option value='$i'>$i</option>";
                    }
                } else {
                    $text .= "<option>Tidak Ada Dapil</option>";
                }
            }

            return response()->json($text, 200);
        }
    }
}
