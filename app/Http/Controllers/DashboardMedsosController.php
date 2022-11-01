<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Medsos;
use App\Models\Caleg;
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
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view("dashboard.medsos.medsos", [
            "title" => "Medsos Page",
            "dataArr" => auth("web")->check() ? Medsos::with("caleg")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Medsos::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
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
        if ($request->has("getData") && $request->getData) {
            $data = Medsos::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "type" => "required",
            "nama_medsos" => "required|max:255",
            "link_medsos" => "required|max:255",
            "id_caleg" => "required",
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medsos  $medsos
     * @return \Illuminate\Http\Response
     */
    public function edit(Medsos $medsos)
    {
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
            $this->authorize("all-caleg", $medsos);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "type" => "required",
            "nama_medsos" => "required|max:255",
            "link_medsos" => "required",
            "id_caleg" => "required",
        ];

        $data = $request->validate($rules);
        
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
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $medsos);
        }

        if (Medsos::destroy($medsos->id_medsos)) {
            return back()->with("success", "Success Delete $medsos->nama_medsos Medsos");
        }

        return back()->with("error", "Error, Can't Delete $medsos->nama_medsos Medsos");
    }
}
