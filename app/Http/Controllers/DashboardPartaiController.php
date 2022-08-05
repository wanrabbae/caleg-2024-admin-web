<?php

namespace App\Http\Controllers;

use App\Models\Partai;
use Illuminate\Support\Facades\Storage;
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
            "title" => "Halaman Legislatif",
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

    $data["logo"] = $request->file("logo")->store("/image");

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partai  $partai
     * @return \Illuminate\Http\Response
     */
    public function edit(Partai $partai)
    {
        return view("dashboard.partai.editPartai", [
            "title" => "Edit $partai->nama_partai",
            "dataArr" => $partai
        ]);
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
            if (!Storage::exists($partai->logo)) {
                Storage::delete($partai->logo);
            }
            $data["logo"] = $request->file("logo")->store("/image");
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
            return back()->with("success", "Success Delete $partai->nama_partai Partai");
        }

        return back()->with("error", "Error, Can't Delete $partai->nama_partai Partai");
    }
}
