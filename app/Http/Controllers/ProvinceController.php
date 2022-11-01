<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinceController extends Controller
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
        
        return view("residences.provinsi", [
            "title" => "Provinsi Page",
            "dataArr" => Provinsi::search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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
            return response()->json(Provinsi::find($request->data), 200);
        }

        $data = $request->validate([
            "nama_provinsi" => "required|max:255|unique:provinsi",
            "jumlah_dapil" => "nullable|numeric",
        ]);

        if (Provinsi::create($data)) {
            return back()->with("success", "Success Create New Province");
        }
        return back()->with("error", "Error When Creating New Province");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show(Provinsi $provinsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $rules = [
            "jumlah_dapil" => "nullable|numeric",
        ];

        if ($request->nama_provinsi != $provinsi->nama_provinsi) {
            $rules["nama_provinsi"] = "required|max:255|unique:provinsi";
        }

        $data = $request->validate($rules);

        if ($provinsi->update($data)) {
            return back()->with("success", "Success Update Provinsi");
        }
        return back()->with("error", "Error When Updating Provinsi");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provinsi $provinsi)
    {
        if ($provinsi->delete()) {
            return back()->with("success", "Success Delete Province");
        }
        return back()->with("error", "Error When Deleting Province");
    }
}
