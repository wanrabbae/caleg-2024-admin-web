<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view("admin.index");
    }

    public function authenticate(Request $request) {
        $request->password = bcrypt($request->password);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $request->remember == "on" ? true : false)) {
            return redirect()->route('dashboard')->with('success', 'You are now logged in!');
        }
        return redirect()->route('administrator')->with('error', 'Username atau Password salah!');
    }
}
