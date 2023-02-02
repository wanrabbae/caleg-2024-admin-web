<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\Legislatif;
use App\Models\Partai;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Activate;
use App\Models\Invoice;

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
        if (Auth::guard('caleg')->attempt($credentials, $request->remember == "on" ? true : false)) {
            if (Caleg::find(auth("caleg")->user()->id_caleg)->demo == "Y" && strtotime(auth("caleg")->user()->created_at) < strtotime(now()->subDay(3))) {
                $caleg = Caleg::find(auth("caleg")->user()->id_caleg);
                $caleg->update(["aktif" => "N"]);
                if (!Invoice::where("id_caleg", $caleg->id_caleg)->first()) {
                    $data["id_caleg"] = $caleg->id_caleg;
                    $data["no_invoice"] = "JG" . now()->format("Y") . $data["id_caleg"];
                    Invoice::create($data);
                }
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route("login")->with("invoice", $caleg->id_caleg);
            }
            if (Caleg::find(auth("caleg")->user()->id_caleg)->aktif == "N") {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route("login")->with("error", "Maaf Akun Anda Belum Di Aktifkan");
            }
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'You are now logged in!');
        }
        return redirect()->route('login')->with('error', 'Username atau Password salah!');
    }

    public function registerAction(Request $request)
    {
        $file = "default.png";
        
        if (Legislatif::find($request->legislatif)->type == "Provinsi") {
            $request["provinsi"] = Provinsi::find($request->provinsi)->id_provinsi;
            $request->validate([
                "nama_caleg" => "required|max:255",
                "nama_lengkap" => "required|max:255",
                "email" => "required|email|unique:caleg",
                "legislatif" => "required",
                "level" => "required",
                "provinsi" => "required",
                "alamat" => "required|max:255",
                "no_hp" => "required|max:20|unique:caleg",
                "partai" => "required",
                "username" => "required|unique:caleg",
                "password" => "required",
                "foto" => "required"
                ]);
        } else {
            $request["kabupaten"] = Kabupaten::find($request->kabupaten)->id_kabupaten;
            $request->validate([
                "nama_caleg" => "required|max:255",
                "nama_lengkap" => "required|max:255",
                "email" => "required|email",
                "legislatif" => "required",
                "level" => "required",
                "provinsi" => "required",
                "kabupaten" => "required",
                "alamat" => "required|max:255",
                "no_hp" => "required|max:20",
                "partai" => "required",
                "username" => "required",
                "password" => "required",
                "foto" => "required"
                ]);
        }
        
        if ($request->hasFile('foto')) {
            // rename file with time
            $file = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $file);
        }

        // CREATE CALEG
        $caleg = Caleg::create([
             "demo" => "Y",
            'nama_caleg' => $request->nama_caleg,
            'nama_lengkap' => $request->nama_lengkap,
            "level" => $request->level,
            'id_legislatif' => $request->legislatif,
            "id_provinsi" => $request["provinsi"] ?? null,
            "id_kabupaten" => $request["kabupaten"] ?? null,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'id_partai' => $request->partai,
            'aktif' => 'N',
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'foto' => "images/" . $file,
            "created_at" => date("Y-m-d h:m:s", strtotime(now()))
        ]);
        
        if ($caleg) {
        Caleg::where("email", $request->email)->update(["reset_token" => Str::random(60)]);
        $token = Caleg::where("email", $request->email)->first();
        Mail::to($request->email)->send(new Activate($token));   
        return redirect()->route('login')->with("error", "Silahkan Cek E-Mail $request->email Untuk Aktivasi Akun Demo");
        }
    }
    
    public function activate() {
        if (!Caleg::where("reset_token", request("token"))->first()) {
            return redirect("login")->with("error", "Token Tidak Sama!");
        }

        if (Caleg::where("reset_token", request("token"))->first()->update(["aktif" => "Y"])) {
            return redirect("login")->with("success", "Success Aktivasi Akun, Silahkan Login");
        }
        return redirect("login")->with("error", "Error Saat Aktivasi Akun");
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect()->route('login')->with('success', 'You are now logged out!');
    }

    public function update(Request $request) {
        if (User::where("id_users", auth()->user()->id_users)->update(["warna" => $request->warna])) {
            return back()->with("success", "Berhasil mengubah warna tema ke $request->warna");
        }
        return back()->with("error", "Gagal mengubah warna tema");
    }
    
    public function invoice(Request $request) {
        $data = $request->validate([
            "id_caleg" => "required"
        ]);

        $invoice = Invoice::where("id_caleg", $data["id_caleg"])->first();

        if ($invoice->caleg->level == "Basic") {
            $harga = 500000;
        }

        if ($invoice->caleg->level == "Gold") {
            $harga = 1000000;
        }

        if ($invoice->caleg->level == "Platinum") {
            $harga = 2000000;
        }

        $total = $harga . $invoice->caleg->id_caleg;
        $total = number_format($total,2,',','.');
        $harga = number_format($harga,2,',','.');

        return view("invoice.invoice", [
            "data" => $invoice,
            "harga" => $harga,
            "total" => $total
        ]);
    }
}
