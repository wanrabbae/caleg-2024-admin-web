<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Desa;
use App\Models\News;
use App\Models\Medsos;
use App\Models\Relawan;
use Illuminate\Support\Str;
use App\Models\Rk_pemilih_2;
use Illuminate\Http\Request;
use App\Models\PaymentCallback;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function requestInquery(Request $request)
    {
        $merchantCode = "DS12874"; // dari duitku
        $apiKey = "5d6698ea3a8eea58ef5b509b14f69895"; // dari duitku
        $paymentAmount = $request->amount;
        $paymentMethod = $request->kode; // VC = Cred   it Card
        $merchantOrderId = time() . ''; // dari merchant, unik
        $productDetails = 'Tes pembayaran menggunakan Duitku';
        $email = 'test@test.com'; // email pelanggan anda
        $phoneNumber = '08123456789'; // nomor telepon pelanggan anda (opsional)
        $additionalParam = ''; // opsional
        $merchantUserInfo = ''; // opsional
        $customerVaName = 'John Doe'; // tampilan nama pada tampilan konfirmasi bank
        $callbackUrl = 'http://localhost:8000/api/requestCallback'; // url untuk callback
        $returnUrl = 'http://example.com/return'; // url untuk redirect
        $expiryPeriod = 10; // atur waktu kadaluarsa dalam hitungan menit
        $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

        // Customer Detail
        $firstName = "John";
        $lastName = "Doe";

        // Address
        $alamat = "Jl. Kembangan Raya";
        $city = "Jakarta";
        $postalCode = "11530";
        $countryCode = "ID";

        $address = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'address' => $alamat,
            'city' => $city,
            'postalCode' => $postalCode,
            'phone' => $phoneNumber,
            'countryCode' => $countryCode
        );

        $customerDetail = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'billingAddress' => $address,
            'shippingAddress' => $address
        );


        $item1 = array(
            'name' => 'Test Item 1',
            'price' => $request->amount,
            'quantity' => 1
        );


        $itemDetails = array(
            $item1,
        );

        /*Khusus untuk metode pembayaran OL dan SL
    $accountLink = array (
        'credentialCode' => '7cXXXXX-XXXX-XXXX-9XXX-944XXXXXXX8',
        'ovo' => array (
            'paymentDetails' => array (
                0 => array (
                    'paymentType' => 'CASH',
                    'amount' => 40000,
                ),
            ),
        ),
        'shopee' => array (
            'useCoin' => false,
            'promoId' => '',
        ),
    );*/

        $params = array(
            'merchantCode' => $merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => $additionalParam,
            'merchantUserInfo' => $merchantUserInfo,
            'customerVaName' => $customerVaName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            // 'accountLink' => $accountLink,
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $callbackUrl,
            'returnUrl' => $returnUrl,
            'signature' => $signature,
            'expiryPeriod' => $expiryPeriod
        );

        $params_string = json_encode($params);
        //echo $params_string;
        $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
        // $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params_string)
            )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            $result = json_decode($request, true);
            //header('location: '. $result['paymentUrl']);
            return response()->json($result);
        } else {
            $request = json_decode($request);
            $error_message = "Server Error " . $httpCode . " " . $request->Message;
            echo $error_message;
        }
    }

    public function getPaymentMethod(Request $request)
    {

        // Set kode merchant anda
        $merchantCode = "DS12874";
        // Set merchant key anda
        $apiKey = "5d6698ea3a8eea58ef5b509b14f69895";
        // catatan: environtment untuk sandbox dan passport berbeda

        $datetime = date('Y-m-d H:i:s');
        $paymentAmount = $request->amount;
        $signature = hash('sha256', $merchantCode . $paymentAmount . $datetime . $apiKey);

        $params = array(
            'merchantcode' => $merchantCode,
            'amount' => $paymentAmount,
            'datetime' => $datetime,
            'signature' => $signature
        );

        $params_string = json_encode($params);

        $url = 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params_string)
            )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //execute post
        $request = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            $results = json_decode($request, true);

            return response()->json($results);
        } else {
            $request = json_decode($request);
            $error_message = "Server Error " . $httpCode . " " . $request->Message;
            echo $error_message;
        }
    }

    public function paymentCallback(Request $request)
    {
        $callback = PaymentCallback::create([
            'codeReference' => $request->codeReference,
            'amount' => $request->amount,
            'status' => $request->status,
            'datetime' => date("Y-m-d h:i:s"),
        ]);

        return response()->json(["massage" => "Success", "calback_data" => $callback], 200);
    }

    public function register(Request $request)
    {
        if ($request->has("referal") && $request->referal) {
            $referal = Relawan::where("referal", $request->referal)->first();
            if ($referal) {
                $request["upline"] = $referal->id_relawan;
            } else {
                return response()->json(["message" => "Tidak ada Referal"], 200);
            }
        }

        // $fileName = $request->file("foto_ktp")->getClientOriginalName();
        $validator = Validator::make($request->all(), [
            "username" => "required|unique:relawan",
            "no_hp" => "required|numeric|unique:relawan",
            "nik" => "required|numeric|unique:relawan",
            "email" => "required|email:dns"
        ], [
            "email.email" => "email harus valid",
            "username.unique" => "Username sudah digunakan !!",
            "no_hp.unique" => "Nomor Hp sudah digunakan !!",
            "nik.unique" => "Nik Sudah digunakan !!",
        ]);

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()], 400);
        }


        if (!$request->referal) {
            $ref = Str::random(2) . random_int(10, 99) . Str::random(2);

            while (Relawan::where("referal", $ref)->first()) {
                $ref = Str::random(2) . random_int(10, 99) . Str::random(2);
            }
            // error_log("keluar");
            $request["upline"] = 0;
        }

        $ref = Str::random(2) . random_int(10, 99) . Str::random(2);

        Relawan::insert([
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "nik" => $request->nik,
            "jabatan" => 3,
            "no_hp" => $request->no_hp,
            "email" => $request->email,
            "jk" => $request->jk,
            "id_desa" => $request->id_desa,
            "id_caleg" => $request->id_caleg,
            "status" => 1,
            "upline" => $request["upline"],
            "nama_relawan" => $request->nama_relawan,
            "loyalis" => 2,
            "blokir" => "N",
            "foto_ktp" => $request->file("foto_ktp")->store("/images", "public_path"),
            "referal" => $ref,
            "token" => uniqid() . Str::random(34) . random_int(10,99)
        ]);

        if($request->with_dpt == 0){
            Rk_pemilih_2::insert([
                "nik" => $request->nik,
                "nama" => $request->nama_relawan,
                "tempat_lahir" => $request->tempat_lahir,
                "tgl_lahir" => $request->tgl_lahir,
                "jk" => null,
                "id_desa" => $request->id_desa,
            ]);
        }

        return response()->json(['message' => 'berhasil']);
    }

    public function login(Request $request)
    {
        $users = Relawan::where("username", $request->username)->where("id_caleg", $request->id_caleg)->first();
        // $caleg = Caleg::where("username", $request->username)->first();

        if ($users) {
            if (Hash::check($request->password, $users->password)) {
                return response()->json(['message' => 'berhasil', "users" => $users,]);
            } else {
                return response()->json(['message' => 'password salah']);
            }
        } else {
            return response()->json(['message' => 'username atau id caleg salah']);
        }
    }

    public function referalCheck(Request $request)
    {
        $referal = Relawan::where('referal', $request->referal)->first();
        if($referal){
            return response()->json(["message" => "Berhasil Mendapat Kode Referal"], 200);
        }
        return response()->json(["message" => "Tidak ada Referal"], 404);
    }

    public function getSimpatisan(Request $request)
    {
        $simpatisan = Relawan::where("upline", $request->upline)->orderBy("id_relawan", 'ASC')->get();

        return response()->json(["message" => "Berhasil", "data" => $simpatisan ], 200);
    }

    public function getSurvey()
    {
        # code...
    }

    public function getDesa(Request $request)
    {
        $desa = Desa::where('id_kecamatan', $request->id_kecamatan)->orderBy('id_desa', 'ASC')->get();

        if(!$desa){
            return response()->json(['message' => 0], 400);
        }
        return response()->json(['message' => 1, 'data_desa' => $desa], 200);
    }

    public function getMedsos(Request $request)
    {
        $medsos = Medsos::where('id_caleg', $request->id_caleg)->with('caleg')->get();

        if(!  $medsos){
            return response()->json(['message' => 0], 400 );
        }
        return response()->json(['message' => 1, 'data_medsos' => $medsos], 200 );
    }

    public function getBerita(Request $request)
    {
        $news = News::where("id_caleg", $request->id_caleg)->where("aktif", "Y")->get();

        return response()->json(['message' => 1, 'data_medsos' => $news], 200 );
    }


}
