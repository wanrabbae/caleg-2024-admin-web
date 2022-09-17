<?php

namespace App\Http\Controllers;

use App\Models\Partai;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DashboardPartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.partai.partai", [
            "title" => "Partai Page",
            "dataArr" => Partai::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            "nama_partai" => "required|max:255|unique:partai",
            "warna" => "required",
            "no_urut" => "required|max:100",
            "logo" => "image|max:2048|required"
    ]);

    $data["logo"] = $request->file("logo")->store("/images", "public_path");

    if (Partai::create($data)) {
            return back()->with("success", "Success Create New Partai");
        }

        return back()->with("error", "Error, Can't Create New Partai");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function show(Partai $partai)
    {
        return response()->json($partai->makeHidden("id_partai", "logo"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function edit(Partai $partai)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partai $partai)
    {
        $rules = [
            "logo" => "max:2024|image",
            "warna" => "required",
            "no_urut" => "required|max:100"
        ];

        if ($request->nama_partai != $partai->nama_partai) {
            $rules["nama_partai"] = "required|max:255|unique:partai";
        }

        $data = $request->validate($rules);

        if ($request->file("logo")) {
            if (File::exists($partai->logo)) {
                File::delete($partai->logo);
            }
            $data["logo"] = $request->file("logo")->store("/images", "public_path");
        }


    if (Partai::where("id_partai", $partai->id_partai)->update($data)) {
            return redirect("/dashboard/partai")->with("success", "Success Edit $partai->nama_partai");
        }

        return back()->with("error", "Error, Can't Edit $partai->nama_partai");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partai $partai)
    {
        if (Partai::destroy($partai->id_partai)) {
            File::delete($partai->logo);
            return back()->with("success", "Success Delete $partai->nama_partai Partai");
        }

        return back()->with("error", "Error, Can't Delete $partai->nama_partai Partai");
    }
}