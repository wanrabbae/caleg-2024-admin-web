<?php

namespace App\Http\Controllers;

use App\Models\Monitoring_Saksi;
use App\Models\Rk_pemilih;
use App\Models\Relawan;
use Illuminate\Http\Request;

class SaksiMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request("table") == "desa") {
            $data = auth("web")->check() ? Monitoring_Saksi::with(["desa", "caleg.partai"])->get() : Monitoring_Saksi::with(["desa"])->where("id_caleg", auth()->user()->id_caleg)->get();
            
           /* $desa = auth("web")->check() ? Rk_pemilih::with("desa.kecamatan")->get() : Rk_pemilih::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->get();
            $myArr = [];
            $found = true;

            foreach ($desa as $data) {
                for ($i = 0; $i < count($myArr); $i++) {
                    if (in_array($data->desa->nama_desa, $myArr[$i])) {
                        $myArr[$i][1] += 1;
                        $myArr[$i][2] += 0;
                        $found = false;
                        break;
                    }
                }
                if ($found) {
                    array_push($myArr, [$data->desa->nama_desa, 1, 0]);
                }
                $found = true;
            }
            $data = collect($myArr);*/
        }
        
        if (request("table") == "kecamatan") {
            $arr = auth("web")->check() ? Monitoring_Saksi::with(["desa.kecamatan", "caleg", "partai"])->get() : Monitoring_Saksi::with(["desa.kecamatan"])->where("id_caleg", auth()->user()->id_caleg)->get();
            $data = [];
            $found = true;

        foreach ($arr as $arr) {
            for ($i = 0; $i < count($data); $i++) {
                if (in_array($arr->desa->kecamatan->nama_kecamatan, $data[$i])) {
                    $data[$i][1] += $arr->suara_2024;
                    $data[$i][2] += $arr->suara_2019;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($data, [$arr->desa->kecamatan->nama_kecamatan, $arr->suara_2024, $arr->suara_2019]);
            }
            $found = true;
        }
        $data = collect($data);
        /*$pemilih = auth("web")->check() ? Rk_pemilih::with("desa.kecamatan")->get() : Rk_pemilih::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->get();
        $myArr = [];
        $found = true;

        foreach ($pemilih as $data) {
            for ($i = 0; $i < count($myArr); $i++) {
                if (in_array($data->desa->kecamatan->nama_kecamatan, $myArr[$i])) {
                    $myArr[$i][1] += 1;
                    $myArr[$i][2] += 0;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($myArr, [$data->desa->kecamatan->nama_kecamatan, 1, 0]);
            }
            $found = true;
        }
        $data = collect($myArr);*/
        }

        if (request("table") == "kabupaten") {
            $arr = auth("web")->check() ? Monitoring_Saksi::with(["desa.kecamatan.kabupaten", "caleg"])->get() : Monitoring_Saksi::with(["desa.kecamatan.kabupaten"])->where("id_caleg", auth()->user()->id_caleg)->get();
            $data = [];
            $found = true;

        foreach ($arr as $arr) {
            for ($i = 0; $i < count($data); $i++) {
                if (in_array($arr->desa->kecamatan->kabupaten->nama_kabupaten, $data[$i])) {
                    $data[$i][1] += $arr->suara_2024;
                    $data[$i][2] += $arr->suara_2019;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($data, [$arr->desa->kecamatan->kabupaten->nama_kabupaten, $arr->suara_2024, $arr->suara_2019]);
            }
            $found = true;
        }
        $data = collect($data);
        }

        return view("saksi.monitoring", [
            "title" => "Monitoring Suara",
            "dataArr" => $data,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitoring_Saksi  $monitoring_Saksi
     * @return \Illuminate\Http\Response
     */
    public function show(Monitoring_Saksi $monitoring_Saksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitoring_Saksi  $monitoring_Saksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitoring_Saksi $monitoring_Saksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Monitoring_Saksi  $monitoring_Saksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitoring_Saksi $monitoring_Saksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitoring_Saksi  $monitoring_Saksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitoring_Saksi $monitoring_Saksi)
    {
        //
    }


    public function fetch($id) {
        //$desa = Monitoring_Saksi::with("desa.kecamatan")->get();
        $desa = $id == 0 ? Monitoring_Saksi::with("desa.kecamatan")->get() : Monitoring_Saksi::with("desa.kecamatan")->where("id_caleg", $id)->get();
        $myArr = [];
        $found = true;

        foreach ($desa as $data) {
            for ($i = 0; $i < count($myArr); $i++) {
                if (in_array($data->desa->nama_desa, $myArr[$i])) {
                    $myArr[$i][1] += $data->suara_2024;
                    $myArr[$i][2] += $data->suara_2019;
                    $found = false;
                    break;
                }
            }
            if ($found) {
                array_push($myArr, [$data->desa->nama_desa, $data->suara_2024, $data->suara_2019]);
            }
            $found = true;
        }

        return response()->json($myArr);
    }
}
