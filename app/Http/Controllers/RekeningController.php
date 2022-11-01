<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Rk_bank;
use Illuminate\Http\Request;

class RekeningController extends Controller
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

        return view("finance.rekening", [
            "title" => "Rekening Page",
            "dataArr" => Rk_bank::where("id_caleg", auth()->user()->id_caleg)->search(request("search"))->paginate(request("paginate") ?? 10)->withQueryString()
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
            $data = Rk_bank::find($request->data);
            if (auth("caleg")->check()) {
                $this->authorize("all-caleg", $data);
            }

            return response()->json($data, 200);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $data = $request->validate([
            "nama_bank" => "required|max:255",
            "nomor_bank" => "numeric|unique:rk_bank",
            "pemilik_bank" => "required|max:255",
            "id_caleg" => "required"
        ]);

        if (Rk_bank::create($data)) {
            return back()->with("success", "Success New Bank");
        }
        return back()->with("error", "Error When Creating New Bank");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rk_bank  $rk_bank
     * @return \Illuminate\Http\Response
     */
    public function show(Rk_bank $rk_bank)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rk_bank  $rk_bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Rk_bank $rk_bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rk_bank  $rk_bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rk_bank $rk_bank)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_bank);
        }

        if (auth("caleg")->check()) {
            $request["id_caleg"] = auth()->user()->id_caleg;
        }

        $rules = [
            "nama_bank" => "required|max:255",
            "pemilik_bank" => "required|max:255",
            "id_caleg" => "required"
        ];

        if ($request->nomor_bank != $rk_bank->nomor_bank) {
            $rules["nomor_bank"] = "numeric|unique:rk_bank";
        }

        $data = $request->validate($rules);

        if (Rk_bank::find($rk_bank->id_bank)->update($data)) {
            return back()->with("success", "Success Update Bank");
        }
        return back()->with("error", "Error When Updating Bank");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rk_bank  $rk_bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rk_bank $rk_bank)
    {
        if (auth("caleg")->check()) {
            $this->authorize("all-caleg", $rk_bank);
        }

        if (Rk_bank::destroy($rk_bank->id_bank)) {
            return back()->with("success", "Success Delete Bank");            
        }
        return back()->with("error", "Error When Deleting Bank");            
    }
}
