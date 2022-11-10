<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Desa;
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
        if (request("table") != "kabupaten" && request("table") != "kecamatan" && request("table") != "desa") {
            abort(404);
        }

        // if (auth("caleg")->check()) {
        //     $dapil = auth()->user()->dapil;
        //     if (auth()->user()->legislatif->type == "Provinsi") {
        //         $data = Desa::with("kecamatan.kabupaten.provinsi")->filter(["id" => auth()->user()->provinsi->id_provinsi, "dapil" => $dapil])->search(request("search"))->paginate(request("paginate") ?? 500)->withQueryString();
        //     } else {
        //         $data = Desa::with("kecamatan.kabupaten")->filter(["id" => auth()->user()->provinsi->id_provinsi, "dapil" => $dapil])->search(request("search"))->paginate(request("paginate") ?? 500)->withQueryString();
        //     }
        // }
        
        $arr = [];
        $diagram = [];
        $found = true;

        if (request("table") == "kabupaten") {
            if (auth("caleg")->check()) {
                $suara = Monitoring_Saksi::with("desa.kecamatan.kabupaten.provinsi")->where("id_caleg", auth()->user()->id_caleg)->whereHas("desa.kecamatan.kabupaten.provinsi", function($desa) {
                    $desa->where("id_provinsi", auth()->user()->id_provinsi)->where("dapil", auth()->user()->dapil);
                })->search(request("search"))->get();
            } else {
                $suara = Monitoring_Saksi::with(["desa.kecamatan.kabupaten.provinsi"])->search(request("search"))->get();
            }
            foreach ($suara as $data) {
                for ($i = 0; $i < count($arr); $i++) {
                    if (in_array($data->desa->kecamatan->kabupaten->nama_kabupaten, $arr[$i])) {
                        $arr[$i][3] += $data->suara_caleg;
                        $diagram[$i][1] += $data->suara_caleg;
                        $found = false;
                        break;
                    }
                }
                if ($found) {
                    array_push($arr, [$data->desa->kecamatan->id_kabupaten, $data->desa->kecamatan->kabupaten->nama_kabupaten, $data->desa->kecamatan->kabupaten->provinsi->nama_provinsi, $data->suara_caleg, $data->suara_partai]);
                    array_push($diagram, [$data->desa->kecamatan->kabupaten->nama_kabupaten, $data->suara_caleg]);
                }
                $found = true;
            }
        }
        
        if (request("table") == "kecamatan") {
            if (auth("caleg")->check()) {
                $suara = Monitoring_Saksi::with("desa.kecamatan.kabupaten")->where("id_caleg", auth()->user()->id_caleg)->whereHas("desa.kecamatan.kabupaten", function($desa) {
                    $desa->where("id_kabupaten", request("kabupaten"))->where("dapil", auth()->user()->dapil);
                })->search(request("search"))->get();
            } else {
                $suara = Monitoring_Saksi::with(["desa.kecamatan.kabupaten"])->search(request("search"))->get();
            }
            foreach ($suara as $data) {
                for ($i = 0; $i < count($arr); $i++) {
                    if (in_array($data->desa->kecamatan->nama_kecamatan, $arr[$i])) {
                        $arr[$i][2] += $data->suara_caleg;
                        $diagram[$i][1] += $data->suara_caleg;
                        $found = false;
                        break;
                    }
                }
                if ($found) {
                    array_push($arr, [$data->desa->id_kecamatan, $data->desa->kecamatan->nama_kecamatan, $data->suara_caleg, $data->suara_partai, $data->desa->kecamatan->kabupaten->nama_kabupaten]);
                    array_push($diagram, [$data->desa->kecamatan->nama_kecamatan, $data->suara_caleg]);
                }
                $found = true;
            }
        }

        if (request("table") == "desa") {
            if (auth("caleg")->check()) {
                $suara = Monitoring_Saksi::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->whereHas("desa.kecamatan", function($desa) {
                    $desa->where("id_kecamatan", request("kecamatan"));
                })->search(request("search"))->get();
            } else {
                $suara = Monitoring_Saksi::with("desa.kecamatan")->whereHas("desa.kecamatan", function($desa) {
                    $desa->where("id_kecamatan", request("kecamatan"));
                })->search(request("search"))->get();
            }
            foreach ($suara as $data) {
                for ($i = 0; $i < count($arr); $i++) {
                    if (in_array($data->desa->nama_desa, $arr[$i])) {
                        $arr[$i][1] += $data->suara_caleg;
                        $diagram[$i][1] += $data->suara_caleg;
                        $found = false;
                        break;
                    }
                }
                if ($found) {
                    array_push($arr, [$data->desa->nama_desa, $data->suara_caleg, $data->suara_partai, $data->desa->kecamatan->nama_kecamatan]);
                    array_push($diagram, [$data->desa->nama_desa, $data->suara_caleg]);
                }
                $found = true;
            }
        }
        
        return view("saksi.monitoring", [
            "title" => "Monitoring Suara",
            "data" => $arr,
            "diagram" => collect($diagram)
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
}
