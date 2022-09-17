<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;

class WaBlasController extends Controller
{
    public function index()
    {
        return view('promotions.wa', [
            'relawan' => Relawan::all(),
            'title' => 'WhatsApp Blas'
        ]);
    }
}
