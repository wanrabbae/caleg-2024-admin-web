<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(){
        return view('document.documentation', [
            'title' => 'Documentation Page'
        ]);
    }
}
