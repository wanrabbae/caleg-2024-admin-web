<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Legislatif;
use App\Models\Partai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register', [
            'legislatif' => Legislatif::all(),
            'partai' => Partai::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->password = bcrypt($request->password);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'You are now logged in!');
        }
        return redirect()->route('login')->with('error', 'Username atau Password salah!');
    }

    public function registerAction(Request $request)
    {
        $file = "default.png";

        if ($request->hasFile('file_up')) {
            // rename file with time
            $file = time() . '.' . $request->file_up->extension();
            $request->file_up->move(public_path('images'), $file);
        }

        // CREATE USER
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->nohp,
            'id_session' => '1234567',
            'foto_user' => $file,
        ]);

        // CREATE CALEG
        $caleg = Caleg::create([
            'nama_caleg' => $request->nama_caleg,
            'nama_lengkap' => $request->nama_lengkap,
            'id_legislatif' => $request->legislatif,
            'alamat' => $request->alamat,
            'no_hp' => intval($request->nohp),
            'email' => $request->email,
            'id_partai' => $request->partai,
            'aktif' => 'Y',
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'foto' => $file
        ]);

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'You are now logged out!');
    }
}
