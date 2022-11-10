<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $request->id_kabupaten)->get();
        // Kecamatan::orderBy('id_kecamatan', 'ASC')->get();

        return response()->json(["message" => 1, 'kecamatan' => $kecamatan], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "nama_kecamatan" => "required|max:225|unique:kecamatan",
            "wilayah" => "required",
            "id_kabupaten" => "required",
    ]);

        if (Kecamatan::create($data)) {
            return response()->json(["message" => 1], 201);
        };
        return response()->json(["message" => 0], 500);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $rule = [];

        if ($request->nama_kecamatan != $kecamatan->nama_kecamatan) {
            $rule["nama_kecamatan"] = "required|max:255|unique:kecamatan";
        }

        $data = $request->validate($rule);

        if (Kecamatan::find($kecamatan->id_kecamatan)->update($data)) {
            return response()->json(["message" => 1], 200);
        }
        return response()->json(["message" => 0], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if (Kecamatan::destroy($kecamatan->id_kecamatan)) {
            return response()->json(["message" => 1], 200);
        }
        return response()->json(["message" => 0], 500);
    }
}
