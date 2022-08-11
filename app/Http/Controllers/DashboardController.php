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
        return view('home.dashboard', [
            'title' => 'Dashboard Caleg'
        ]);
    }
}
