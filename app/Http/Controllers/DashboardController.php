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

    public function legislatifView()
    {
        return view("dashboard.legislatif", [
            "title" => "Halaman Legislatif",
            "dataArr" => Legislatif::all()
        ]);
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
