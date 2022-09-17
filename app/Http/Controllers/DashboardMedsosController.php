<?php

namespace App\Http\Controllers;

use App\Models\Medsos;
use App\Models\Caleg;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DashboardMedsosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.medsos.medsos", [
            "title" => "Medsos Page",
            "dataArr" => auth("web")->check() ? Medsos::with("caleg")->get() : Medsos::where("id_caleg", auth()->user()->id_caleg)->get(),
            "caleg" => Caleg::all()
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
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "nama_medsos" => "required|max:255",
            "link_medsos" => "required|max:255",
            "id_caleg" => "required",
            "logo" => "image|max:2048|required"
        ]);

        $data["logo"] = $request->file("logo")->store("/images", "public_path");

        if (Medsos::create($data)) {
            return back()->with("success", "Success Create New Medsos");
        }
        
        return back()->with("error", "Error, Can't Create New Medsos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medsos  $medsos
     * @return \Illuminate\Http\Response
     */
    public function show(Medsos $medsos)
    {
        return response()->json($medsos->makeHidden("id_medsos", "logo"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medsos  $medsos
     * @return \Illuminate\Http\Response
     */
    public function edit(Medsos $medsos)
    {
        return view("dashboard.medsos.editMedsos", [
            "title" => "Edit $medsos->nama_medsos",
            "dataArr" => $medsos
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medsos  $medsos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medsos $medsos)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "nama_medsos" => "required|max:255",
            "link_medsos" => "required",
            "id_caleg" => "required",
            "logo" => "max:2024|image"
        ];

        $data = $request->validate($rules);
        
        if ($request->file("logo")) {
            if (File::exists($medsos->logo)) {
                File::delete($medsos->logo);
            }
            $data["logo"] = $request->file("logo")->store("/images", "public_path");
        }
        
        
    if (Medsos::where("id_medsos", $medsos->id_medsos)->update($data)) {
            return back()->with("success", "Success Edit $medsos->nama_medsos");
        }
        
        return back()->with("error", "Error, Can't Edit $medsos->nama_medsos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medsos  $medsos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medsos $medsos)
    {
        if (Medsos::destroy($medsos->id_medsos)) {
            File::delete($medsos->logo);
            return back()->with("success", "Success Delete $medsos->nama_medsos Medsos");
        }

        return back()->with("error", "Error, Can't Delete $medsos->nama_medsos Medsos");
    }
}