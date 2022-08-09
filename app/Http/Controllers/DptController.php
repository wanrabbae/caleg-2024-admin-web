<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DptController extends Controller
{
    public function index()
    {
        return view('rekap.dpt');
    }
}
