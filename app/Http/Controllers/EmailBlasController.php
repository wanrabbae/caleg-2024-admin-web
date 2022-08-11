<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use Illuminate\Http\Request;

class EmailBlasController extends Controller
{
    public function index()
    {
        return view('promotions.email', [
            'relawan' => Relawan::all(),
            'title' => 'Email Blas'
        ]);
    }
}
