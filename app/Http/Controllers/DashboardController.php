<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\Rk_pemilih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.dashboard', [
            'title' => 'Dashboard Caleg',
            "relawan" => auth("web")->check() ? Relawan::all()->count() : Relawan::where("id_caleg", auth()->user()->id_caleg)->get()->count(),
            "pemilih" => Rk_pemilih::all()->count(),
        ]);
    }
}
