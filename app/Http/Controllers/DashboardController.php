<?php

namespace App\Http\Controllers;

use App\Models\Legislatif;
use App\Models\Partai;
use App\Models\Medsos;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.dashboard');
    }


    public function legislatifDelete(Legislatif $legislatif) {
        if (Legislatif::where("id_legislatif", $legislatif->id_legislatif)->delete()) {
            return back()->with("success", "Success Delete $legislatif->nama_legislatif Legislatif");
        }

        return back()->with("error", "Error, Can't Delete $legislatif->nama_legislatif Legislatif");
    }

    public function partaiView()
    {
        return view("dashboard.partai", [
            "title" => "Halaman Partai",
            "dataArr" => Partai::all()
        ]);
    }

    public function medsosView() {
        return view("dashboard.medsos", [
            "title" => "Halaman Medsos",
            "dataArr" => Medsos::all()
    ]);
    }
}
