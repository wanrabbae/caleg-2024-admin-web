<?php

namespace App\Http\Controllers;

use App\Models\Rk_pemilih;
use Illuminate\Http\Request;

class DptController extends Controller
{
    public function index()
    {
        return view('rekap.dpt', [
            'data' => Rk_pemilih::with('desa')->get(),
        ]);
    }
}
