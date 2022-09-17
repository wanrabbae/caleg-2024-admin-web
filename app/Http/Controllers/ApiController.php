<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Caleg;
use App\Models\Desa;
use App\Models\Galery;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Program;
use App\Models\Survey;
use App\Models\User;
use App\Models\Variabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    
    public function getProgram(Request $request)
    {
        $program = Program::where("id_caleg", $request->id_caleg)->first();

        return response()->json([
            "program" => $program,
        ],);
    }

    public function requestInquery(Request $request)
    {
        $merchantCode = "DS12874"; // dari duitku
        $apiKey = "5d6698ea3a8eea58ef5b509b14f69895"; // dari duitku
        $paymentAmount = $request->amount;
        $paymentMethod = $request->kode; // VC = Credit Card
        $merchantOrderId = time() . ''; // dari merchant, unik
        $productDetails = 'Tes pembayaran menggunakan Duitku';
        $email = 'test@test.com'; // email pelanggan anda
        $phoneNumber = '08123456789'; // nomor telepon pelanggan anda (opsional)
        $additionalParam = ''; // opsional
        $merchantUserInfo = ''; // opsional
        $customerVaName = 'John Doe'; // tampilan nama pada tampilan konfirmasi bank
        $callbackUrl = 'http://example.com/callback'; // url untuk callback
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

    public function register(Request $request)
    {
        User::insert([
            "username" => $request->username,
            "password" => Hash::make($request->password),
            "nik" => $request->nik,
            "jabatan" => 1,
            "no_hp" => $request->no_hp,
            "email" => $request->email,
            "upline" => 1,
            "id_desa" => 1,
            "id_caleg" => 2,
            "status" => 1,
            "nama_relawan" => $request->nama_relawan,
            "loyalis" => 1,
            "blokir" => "N",
        ]);

        return response()->json(['message' => 'berhasil']);
    }

    public function login(Request $request)
    {
        $users = User::where("username", $request->username)->first();

        if ($users) {
            if (Hash::check($request->password, $users->password)) {
                return response()->json(['message' => 'berhasil', "users" => $users,]);
            } else {
                return response()->json(['message' => 'password salah']);
            }
        } else {
            return response()->json(['message' => 'username salah']);
        }
    }

    public function getGalery()
    {
        $galery = Galery::orderBy('id_galery', 'DESC')->get();
        return response()->json(['gallery' => $galery]);
    }

    public function getVariabel()
    {
        $variable = Variabel::orderBy("id_variabel", "DESC")->get();

        return response()->json(["variable" => $variable]);
    }

    public function getSurvey(Request $request)
    {
        $survey = Survey::where([
            ['id_caleg', '=', $request->id_caleg],
            ['id_variabel', '=', $request->id_variabel],
        ])->orderBy('id_survey', 'DESC')->get();

        return response()->json(['survey' => $survey]);
    }

    public function getKabupaten()
    {
        $kabupaten = Kabupaten::orderBy('id_kabupaten', 'DESC')->get();

        return response()->json(['kabupaten' => $kabupaten]);
    }

    public function getKecamatan(request $request)
    {
        $kecamatan = Kecamatan::where('id_kabupaten', $request->id_kabupaten)->get();

        return response()->json(['kecamatan' => $kecamatan]);
    }

    public function getDesa(request $request)
    {
        $desa = Desa::where('id_kecamatan', $request->id_kecamatan)->get();

        return response()->json(['desa' => $desa]);
    }
}