
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
      crossorigin="anonymous"
    />
   
    <title>Kwitansi</title>

    <div class="container" style="margin-top: 30px">
      <div
        style="
          position: absolute;
          z-index: -1;
          opacity: 60%;
          margin: 60px 0 0 500px;
        "
      >
        <img
          src="https://cdn.discordapp.com/attachments/990841636386897971/1016257085027139594/WhatsApp_Image_2022-09-05_at_14.56.33-removebg-preview.png"
          alt=""
          height="200px"
        />
      </div>
      <div class="row">
       <!-- <div
          class="col-3 left"
          style="border: 1px solid #000000; padding-top: 20px"
        >
          <p class="text-start">No : .....................................</p>
          <p class="text-start">
            Tanggal : .....................................
          </p>
          <p class="text-start">
            Terima Dari : ......................................
          </p>
          <p class="text-start text-break">
            Jumlah :
            ..........................................................................................................................................
          </p>
          <p class="text-start text-break">
            Untuk Pembayaran :
            ........................................................................................................................................
          </p>
        </div>-->
        <div class="col-9" style="border: 1px solid #000000">
          <h5 class="text-center" style="font-size: 30px; font-family: 'arial', sans-serif;" class="import" >KWITANSI PEMBAYARAN</h5>
          <div class="row">
            <p class="col-6 text-start">
              No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<B> {{ $data->no_invoice }}</B>
            </p>
            <p class="col-6 text-end">
              Invoice :
              {{ date("d F Y", strtotime($data->created_at)) }}            </p>
          </div>
          <p>
            Terima Dari &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
           <B>{{ $data->caleg->nama_caleg }}</B> 
          </p>
          <p>
            Untuk Pembayaran &nbsp;&nbsp;:
            Paket {{ $data->caleg->level }} Caleg Berbasis Web          </p>
          <div class="row">
            <div class="col-4" style="margin-top: 20px">
              <div
                style="
                  border: 1px solid black;
                  width: 300px;
                  padding-left: 10px;
                  padding-top: 5px;
                "
              >
                <p>Rp. {{ $total }}</p>
              </div>
            </div>
            <div class="col-8">
               
              <div class="row d-flex justify-content-end">
                <div class="col-6">
                    Cirebon, {{ date("d F Y", strtotime($tanggal)) }}                  <div style="padding-left: 17px; z-index: -5">
                    <img
                      src="https://cdn.discordapp.com/attachments/990841636386897971/1016232545572094003/176.jpg"
                      alt="materai"
                      height="90px"
                      width="120px"
                    />
                    <div
                      style="
                        position: absolute;
                        margin: -110px 0 0 -115px;
                        z-index: 9;
                      "
                    >
                      <img
                        src="https://cdn.discordapp.com/attachments/990841636386897971/1016242227690872872/CAP.png"
                        alt=""
                        width="140px"
                        height="140px"
                      />
                    </div>
                    <div
                      style="position: absolute; z-index: 1; margin-top: -90px"
                    >
                      <img
                        src="https://cdn.discordapp.com/attachments/990841636386897971/1016265621182353479/unknown.png"
                        alt="tanda tangan"
                        width="150px"
                        height="150px"
                      />
                    </div>
                  </div>
                  <div class="col-6">
                    <p class="text-center">Widya., SE</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"
    ></script>
  </head>
  <body></body>
</html>
