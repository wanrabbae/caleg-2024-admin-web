<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Survey;
use App\Models\Variabel;
use Illuminate\Http\Request;

class DataSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.survey', [
            'title' => 'Data Survey Page',
            'data' => auth("web")->check() ? Survey::with("caleg", "variable")->get() : Survey::with("caleg", "variable")->where("id_caleg", auth()->user()->id_caleg)->get(),
            'caleg' => Caleg::all(),
            'variabel' => auth("web")->check() ? Variabel::all() : Variabel::where("id_caleg", auth()->user()->id_caleg)->get(),
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
            return response()->json(Survey::find($request->data), 200);
        }


        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        // dd($request->all());

        $data =  $request->validate([
            'nama_survey' => 'required',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'id_caleg' => 'required',
            'hasil_survey' => 'required'
        ]);

        if(Survey::create($data)){
            return back()->with('success', 'Success Create Data Survey');
        }
        return back()->with('error', 'Failed Create Data Survey');
    }

    /**
     * Display the specified resource.
     *
     * @param   Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey,$id_survey)
    {
    return response()->json(Survey::find($id_survey));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id_survey)
    {
        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        if($request->has('aktif')) {
            if ($request->aktif == "Y") {
                if (Survey::find($id_survey)->update(["aktif" => $request->aktif = "N"])) {
                    return back()->with("success", "Success Update Active");
                }
                return back()->with("error", "Error When Updating Active");
            }

            if (Survey::where("aktif", "Y")->first()) {
                Survey::where("aktif", "Y")->update(["aktif" => "N"]);
            }

            if (Survey::find($id_survey)->update(["aktif" =>    "Y"])) {
                return back()->with("success", "Success Update Active");
            }

            return back()->with("error", "Error When Updating Active");
        }

        $data = $request->validate([
            'nama_survey' => 'required',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'id_caleg' => 'required',
        ]);

        if(Survey::where('id_survey', $id_survey)->update($data)){
            return back()->with('success', 'Success Updating Data Survey');
        }
        return back()->with('error', 'Failed Updating Data Survey');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_survey)
    {
        if(Survey::where('id_survey', $id_survey)->delete()){
            return back()->with('success', 'Success Deleting Data Survey');
        }
        return back()->with('error', 'failed Deleting Data Survey');
    }
}
