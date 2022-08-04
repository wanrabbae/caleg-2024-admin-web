<?php

namespace App\Http\Controllers;

use App\Models\Legislatif;
use App\Models\Partai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.dashboard');
    }

    public function legislatifView() {
        return view("dashboard.legislatif", [
            "title" => "Halaman Legislatif",
            "dataArr" => Legislatif::all()
        ]);
    }

    public function partaiView() {
        dd(Partai::all());
        return view("dashboard.partai", [
            "title" => "Halaman Partai",
            "dataArr" => Partai::all()
    ]);
    }
}
