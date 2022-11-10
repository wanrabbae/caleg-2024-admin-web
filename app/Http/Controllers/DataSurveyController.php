<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Caleg;
use App\Models\Survey;
use App\Models\Variabel;
use App\Models\Hasil_Survey;
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
        if (Helper::RequestCheck(request()->all())) {
            return back()->with("error", "Karakter Ilegal Ditemukan");
        };

        return view('data.survey', [
            'title' => 'Data Survey Page',
            'data' => auth("web")->check() ? Survey::with("caleg", "variable")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Survey::with("caleg", "variable")->where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'caleg' => Caleg::all(),
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
            $data = Survey::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
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
    public function show(Request $request)
    {
        $survey = Survey::with("variable")->find($request->survey);

        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $survey);
        }

        $hasil = Hasil_Survey::where("id_survey", $request->survey)->get();
        $relawanSurvey = [];
        $data = [];
        $found = true;
        foreach ($survey->variable as $i => $pertanyaan) {
            array_push($data, [$pertanyaan->pertanyaan, 0, 0]);
            array_push($relawanSurvey, [$pertanyaan->pertanyaan, [], []]);
            foreach ($hasil as $jawaban) {
                $hasilJawaban = json_decode($jawaban->jawaban);
                $hasilJawaban[$i] == 1 ? $data[$i][1] += 1 : $data[$i][2] += 1;
            }
        }
        
        foreach ($hasil as $relawan) {
            foreach (json_decode($relawan->jawaban) as $i => $jawaban) {
                if ($jawaban == 1) {
                    array_push($relawanSurvey[$i][1], $relawan->relawan->nama_relawan . ", " . $relawan->relawan->desa->nama_desa);
                } else {
                    array_push($relawanSurvey[$i][2], $relawan->relawan->nama_relawan . ", " . $relawan->relawan->desa->nama_desa);
                }
            }
        }

        return view("data.hasil", [
            "title" => "Hasil Survey",
            "survey" => $survey->nama_survey,
            "data" => collect($data),
            "relawanSurvey" => collect($relawanSurvey)
        ]);
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
            $survey = Survey::find($id_survey);
            $this->authorize("all-caleg", $survey);
        }

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

            if (Survey::find($id_survey)->update(["aktif" => "Y"])) {
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
        if (auth("caleg")->check()) {
            $data = Survey::find($id_survey);
            $this->authorize("all-caleg", $data);
        }

        if(Survey::where('id_survey', $id_survey)->delete()){
            return back()->with('success', 'Success Deleting Data Survey');
        }
        return back()->with('error', 'failed Deleting Data Survey');
    }
}
