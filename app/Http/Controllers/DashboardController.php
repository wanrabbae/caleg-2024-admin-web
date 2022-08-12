<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\Rk_pemilih;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.dashboard', [
            'title' => 'Dashboard Caleg',
            "relawan" => Relawan::all()->count(),
            "pemilih" => Rk_pemilih::all()->count()
        ]);
    }
}
