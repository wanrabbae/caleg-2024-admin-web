<?php

namespace App\Http\Controllers;
use App\Models\Rk_pemilih;
use Illuminate\Http\Request;

class DPTController extends Controller
{
    public function index(){
        return view('rekap.dpt', [
            'title' => 'DPT Page',
            'data' => Rk_pemilih::all()
        ]);
    }
}
