<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
</head>
<body>
    <style>
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font: 10pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 230mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;

        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: .2 cm;
        border: 1px #F8F8FF solid;
        height: 257mm;
        outline: 2.5cm #FFFFFF solid;
    }

    @page  {
        size: A4;
        margin: 0;
    }

    @media  print {

        html,
        body {
            width: 200mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    .table,
    th,
    tr,
    td {
        padding-left: 5px;
        border-collapse: collapse;
        border: 1px solid black;
        border-width: 1px;
        bg-color: black;
    }

    .w-100 {
        width: 100%;
    }

    .text-center {
        text-align: center;
    }

    .header {
        padding: 0 10mm 4mm 10mm;
        position: relative;
    }

    </style>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="header">
                    <img src="{{ asset($foto) }}" width="80px" style="position: absolute; top: 0">
                    <h2 style="text-align: center">{{ auth()->user()->partai->nama_partai }}</h2>
                    <h4 style="text-align: center">{{ auth()->user()->nama_caleg }}</h4>
                </div>
                <div style="width: 180mm; background: black; height: 4px; margin: auto; display: block"></div>
                <hr>
                <h3 style="color:black; font-family: sans;" align="center">LAPORAN NERACA SALDO</h3>
                <p>Tanggal Cetak : {{ date("d F Y", strtotime($start)) }} s.d {{ date("d F Y", strtotime($end)) }}</p>
                <div id="outtable">
                    <div class="table-responsive">
                        <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Pemasukan</th>
                                        <th class="text-center">Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalPemasukan = 0;
                                    $totalPengeluaran = 0;
                                    ?>
                                    @if ($transaksi->count())
                                    @foreach ($transaksi as $data)
                                    <?php
                                    if ($data->jenis_transaksi == "Pemasukan") {
                                        $totalPemasukan += $data->jumlah;
                                    } else {
                                        $totalPengeluaran += $data->jumlah;
                                    }
                                    ?>
                                        <tr>
                                            <td>{{ $data->kode_kategori }}</td>
                                            <td>{{ $data->nama_kategori }}</td>
                                            @if ($data->jenis_transaksi == "Pemasukan")
                                            <td>Rp.{{ $data->jumlah ? number_format($data->jumlah,2,',','.') : 0}} </td>
                                            <td>Rp.0</td>
                                            @else
                                            <td>Rp.0</td>
                                            <td>Rp.{{ $data->jumlah ? number_format($data->jumlah,2,',','.') : 0}} </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: center">Total</td>
                                        <td>Rp.{{ number_format($totalPemasukan,2,',','.') }}</td>
                                        <td>Rp.{{ number_format($totalPengeluaran,2,',','.');}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p>Cirebon, {{ date("d F Y", strtotime(now())) }} </p><br><br><br>
                        <p>(__________________)</p>

                    </div>
                </div>
            </div>
        </div>
        <script>
            // window.print();
        </script>
</body>
</html>