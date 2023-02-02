<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Hasil_Survey;
use Illuminate\Http\Request;

class SurveyCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getSurvey(Request $request)
    {
        // $survey = Survey::where([
        //     ['aktif', '=', 'Y'],
        //     ['id_caleg', '=', $request->id_caleg],
        // ])->orderBy('id_survey', 'ASC')->get();
        
        $survey = Survey::where("aktif", "Y")->where("id_caleg", $request->id_caleg)->first();
        $hasil = Hasil_Survey::where("id_relawan", $request->id_relawan)->where("id_survey", $survey->id_survey)->first();
        
        if(strtotime($survey->sampai_tanggal) >= strtotime(now())){
            return response()->json(["message" =>  "Berhasil",   'survey' => $survey]);
        }
        
        if ($hasil) {
            return response()->json(["message" => "N"]);
        }
        // return response()->json(["message" =>  "Berhasil",   'survey' => $survey]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =  $request->validate([
            'nama_survey' => 'required',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'id_caleg' => 'required',
            'id_variabel' => 'required',
        ]);

        if(Survey::create($data)){
            // return back()->with('success', 'Success Create Data Survey');
            return response()->json(['message' => 1,'data' => $data], 201);
        }
        // return back()->with('error', 'Failed Create Data Survey');
        return response()->json(['message' => 0], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id_survey)
    {

        $data = $request->validate([
            'nama_survey' => 'required',
            'mulai_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date',
            'id_caleg' => 'required',
            'id_variabel' => 'required'
        ]);

        if(Survey::where('id_survey', $id_survey)->update($data)){
            // return back()->with('success', 'Success Updating Data Survey');
            return response()->json(['message' => 1, 'data' => $data], 200);
        }
        // return back()->with('error', 'Failed Updating Data Survey');
        return response()->json(['message' => 0], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_survey)
    {
        if(Survey::where('id_survey', $id_survey)->delete()){
            // return back()->with('success', 'Success Deleting Data Survey');
            return response()->json(['message' => 1], 200, );
        }
            return response()->json(['message' => 0], 500, );
            // return back()->with('error', 'failed Deleting Data Survey')
    }
}
