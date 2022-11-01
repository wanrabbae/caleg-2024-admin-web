<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container img {
            width: 75px;
            height: 75px;
        }

        .btn {
            padding: 16px;
            background-color: #4e73df;
            font-size: 20px;
            border: 0;
            color: white;
            font-weight: 600;
            cursor: pointer;
            margin-top: 16px;
            border-radius: 4px;
        }

    </style>
    <div class="container">
        <img src="{{ asset("images/jagat.png") }}" alt="">
        <h1 style="margin-top: 32px; text-align: center">Aktivasi Akun</h1>
        <p style="font-size: 20px; text-align: center;">Kami Mengirimkan Email Ini Untuk Memverifikasi Akun Anda, Silahkan Klik Tombol Dibawah Ini</p>
        <a href="{{ env("APP_URL") . "/aktivasi?token=$data->reset_token" }}" style="outline: none; text-decoration: none">
            <button type="button" style="color: white; background-color: #4e73df; padding: 24px; border-radius: 6px; font-size: 24px; border: none; outline: none; margin: auto; display: block; cursor: pointer">
                Aktivasi Akun
            </button>
        </a>
    </div>
</body>
</html>