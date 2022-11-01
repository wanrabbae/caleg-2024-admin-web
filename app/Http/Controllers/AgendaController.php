<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Agenda;
use App\Models\Caleg;
use Illuminate\Http\Request;

class AgendaController extends Controller
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

        return view("rekap.agenda", [
            "title" => "Halaman Agenda",
            "dataArr" => auth("web")->check() ? Agenda::search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Agenda::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
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
            $data = Agenda::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "nama_agenda" => "max:255|required",
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255",
            "id_caleg" => "required"
    ]);

        if (Agenda::create($data)) {
            return back()->with("success", "Success Create New Agenda");
        }
        return back()->with("error", "Error, Can't Create New Agenda");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $agenda);
        }

        if ($request->has('jenis')){
            if (Agenda::where('id_agenda', $agenda->id_agenda)->update(["jenis" => $request->jenis])){
                return back()->with('success', 'Success Updating Jenis Agenda');
            }
            return back()->with('error', 'Failed Updating jenis Agenda');
        }
        
        if ($request->has('status')){
            if (Agenda::where('id_agenda', $agenda->id_agenda)->update(["status" => $request->status])){
                return back()->with('success', 'Success Updating Status');
            }

            return back()->with('error', 'Failed Updating Status');
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "nama_agenda" => "max:255|required",
            "tanggal" => "required",
            "jam" => "required",
            "lokasi" => "required|max:255",
            "id_caleg" => "required"
        ];

        $data = $request->validate($rules);

        if (Agenda::find($agenda->id_agenda)->update($data)) {
            return back()->with("success", "Success Edit $agenda->nama_agenda Agenda");
        }
        return back()->with("error", "Error, Can't Edit $agenda->nama_agenda Agenda");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $agenda);
        }

        if (Agenda::destroy($agenda->id_agenda)) {
            return back()->with("success", "Success delete $agenda->nama_agenda Agenda");
        }
        return back()->with("error", "Error, Can't delete $agenda->nama_agenda Agenda");
    }
}
