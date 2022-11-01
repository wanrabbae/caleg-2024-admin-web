<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\Caleg;
use App\Models\Survey;
use App\Models\Variabel;
use Illuminate\Http\Request;

class VariableController extends Controller
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

        return view('data.variable', [
            'title' => 'Variable Survey Page',
            "caleg" => Caleg::all(),
            'data' => auth("web")->check() ? Variabel::with("caleg")->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString() : Variabel::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString(),
            'survey' => auth("web")->check() ? Survey::all() : Survey::where("id_caleg", auth()->user()->id_caleg)->get()
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
            $data = Variabel::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }
            return response()->json($data, 200);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rule = [
            'pertanyaan' => 'required',
            "id_survey" => "required",
            "id_caleg" => "required",
        ];

        $data = $request->validate($rule);

        if(Variabel::create($data)){
            return back()->with('success', 'Success Create Data Variable');
        }

        return back()->with('success', 'Failed Create Data Variable');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function show(Variabel $variabel, $id_variabel)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function edit(Variabel $variabel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variabel $variabel,$id_variabel)
    {
        if (auth("caleg")->check()) {
            $data = Variabel::find($id_variabel);
            $this->authorize("all-caleg", $data);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rule = [
            "pertanyaan" => "required",
            "id_survey" => "required",
            "id_caleg" => "required"
           ];

        if ($request->nama_variable !== Variabel::find($id_variabel)->nama_variabel) {
            $rule["nama_variabel"] = "required";
        }

       $data = $request->validate($rule);

       if(Variabel::find($id_variabel)->update($data)){
            return redirect('/survey/VariableSurvey')->with('success', "Success Update Variabel $variabel->nama_variabel");
       }
       return redirect('/survey/VariableSurvey')->with('error', "Failed Update Variabel $variabel->nama_variabel");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variabel  $variabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variabel $variabel, $id_variabel)
    {
        if (auth("caleg")->check()) {
            $data = Variabel::find($id_variabel);
            $this->authorize("all-caleg", $data);
        }

        if(Variabel::where('id_variabel', $id_variabel)->delete()){
            return back()->with('success', "Success Deleting Data Variable");
        }
        return back()->with('error', "Failed Deleting Data Variable");
    }
}
