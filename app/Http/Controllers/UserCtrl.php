<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Desa;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;

use function PHPUnit\Framework\isNull;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTps(Request $request)
    {
        $relawan = Relawan::find($request->id_relawan)->tps;

        return response()->json(['relawan_data' => explode(",", $relawan)], 200);
    }

    public function getRelawan()
    {
        $data = Relawan::orderBy('id_relawan', 'ASC')->get();

        return response()->json(['relawan_data' => $data], 200);
    }

    public function getSimpatisan(Request $request)
    {
        $simpatisan = Relawan::where("upline", $request->upline)->where("loyalis", "1")->get();

        return response()->json(['simpatisan' => $simpatisan], 200);
    }

    public function updateRelawan(Request $request, $id)
    {
        $relawan = Relawan::find($id);

        // return $relawan;

        if($request->has('loyalis') && request('loyalis')){
            if($request->loyalis == $relawan->loyalis){
                return response()->json(['message' => "Status tidak dirubah"], 200);
            }

            if($relawan->update(["loyalis" => $request->loyalis])){
                return response()->json(["message" => "berhasil"]);
            }
            return response()->json(["message" => "gagal"], 200);
        }
    }

    public function addProfile(Request $request, $id)
    {
        $relawan = Relawan::find($id);

        $data = $request->validate([
            'profile' => "required|image|max:6000|mimes:png,jpg,jpeg"
        ]);

        $data['profile'] = $request->file('profile')->store("images", "public_path");

        if(Relawan::where("id_relawan", $id)->update($data)){
            return response()->json(["message" => "berhasil"], 200);
        }
        return response()->json(['message' => "gagal"], 200);

    }

    public function getQr(Request $request)
    {
        $relawan = collect(Relawan::where('nik', $request->nik)->get());

        $relawan->toArray();

        // return $relawan;

        if($relawan){
            return response()->json(['message' => "berhasil", "data" => $relawan], 200);
        }
        return response()->json(['message' => "gagal"]);
    }

    public function getProfile(Request $request)
    {
        $profile = Relawan::where("id_relawan",$request->id_relawan)->first()->profile;

        return response()->json(["message"=> "berhasil", "profile" => $profile], 200);
    }

    public function forgotPassword(Request $request)
    {

    }

    public function resetPassword(Request $request)
    {

    }
}
