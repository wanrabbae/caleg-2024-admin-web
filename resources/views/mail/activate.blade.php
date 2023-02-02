<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
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
        <h1 style="margin-top: 32px;">Aktivasi Akun</h1>
        <p style="font-size: 20px; text-align: center;">Kami Mengirimkan Email Ini Untuk Memverifikasi Akun Anda, Silahkan Klik Tombol Dibawah Ini</p>
        <a href="{{ asset("aktivasi?token=" . $data->reset_token) }}">
            <button class="btn" type="submit">
                Aktivasi Akun
            </button>
        </a>
    </div>
</body>
</html>