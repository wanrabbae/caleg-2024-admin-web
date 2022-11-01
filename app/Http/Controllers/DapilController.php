<?php

namespace App\Http\Controllers;

use App\Models\Dapil;
use App\Models\Detail_Dapil;
use App\Models\Legislatif;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class DapilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("residences.dapil", [
            "title" => "Dapil Page",
            "dataArr" => Dapil::with(["legislatif"])->get(),
            "legislatif" => Legislatif::all(),
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
            return response()->json(Dapil::find($request->data), 200);
        }

        $data = $request->validate([
            "nama_dapil" => "required|max:255",
            "id_legislatif" => "required"
        ]);

        if (Dapil::create($data)) {
            return back()->with("success", "Success Create New Dapil");
        }
        return back()->with("error", "Error When Creating New Dapil");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dapil  $dapil
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $request->validate([
            "id_dapil" => "required"
        ]);

        $detail = Detail_Dapil::where("id_dapil", $data["id_dapil"])->get();
        return view("residences.detail", [
            "title" => "Detail Dapil " . Dapil::find($data["id_dapil"])->nama_dapil,
            "dataArr" => $detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dapil  $dapil
     * @return \Illuminate\Http\Response
     */
    public function edit(Dapil $dapil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dapil  $dapil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dapil $dapil)
    {
        $data = $request->validate([
            "nama_dapil" => "required|max:255",
            "id_legislatif" => "required"
        ]);

        if ($dapil->update($data)) {
            return back()->with("success", "Success Update Dapil");
        }
        return back()->with("error", "Error When Updating Dapil");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dapil  $dapil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dapil $dapil)
    {
        if ($dapil->delete()) {
            return back()->with("success", "Success Delete Dapil");
        }
        return back()->with("error", "Error When Deleting Dapil");
    }
}
