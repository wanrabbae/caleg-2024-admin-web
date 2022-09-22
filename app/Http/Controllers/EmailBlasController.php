<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;

class EmailBlasController extends Controller
{
    public function index()
    {
        return view('promotions.email', [
            'relawan' => auth("web")->check() ? Relawan::all() : Relawan::with("desa.kecamatan")->where("id_caleg", auth()->user()->id_caleg)->get(),
            'title' => 'Email Blas'
        ]);
    }

    public function send(Request $request) {
        
    }
}
