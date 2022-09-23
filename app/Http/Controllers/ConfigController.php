<?php

namespace App\Http\Controllers;

use App\Models\ConfigBlas;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("promotions.config", [
            "title" => "Setting Blas",
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
    public function send(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $configBlas
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigBlas $configBlas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $configBlas
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigBlas $configBlas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $configBlas
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, ConfigBlas $configBlas) {
        if (request("update") == "wa") {
            $data = $request->validate([
                "API_KEY" => "required",
                "device_id" => "required"
            ]);
        } else {
            $data = $request->validate([
                "email" => "required",
                "password" => "required"
            ]);
            }

            if (ConfigBlas::where("id_caleg", auth()->user()->id_caleg)->update($data)) {
                return back()->with("success", "Berhasil Mengubah Data");
            }
            return back()->with("error", "Error Saat Mengubah Data");
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $configBlas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $configBlas)
    {
        //
    }
}
