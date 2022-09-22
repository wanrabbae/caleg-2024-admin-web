<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Relawan::orderBy('id_relawan', 'ASC')->get();
        return response()->json(['relawan_data' =>$data], 200);
    }

    public function getSimpatisan(Request $request)
    {
        $simpatisan = Relawan::where("upline", $request->upline)->where("loyalis", "1")->get();

        return response()->json(['simpatisan' => $simpatisan], 200);
    }


}
