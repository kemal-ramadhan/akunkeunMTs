<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        /* Reset CSS */
        body, h1, p, table {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #f93137;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .invoice-details {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }

        .invoice-details th, .invoice-details td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .invoice-details th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PEMBAYARAN GAGAL</h1>
        </div>
        <div class="information">
            <h3>Assalamualaikum, Hai {{$wali}}!</h3>
            <b>Mohon Maaf Pembayaran Anda Gagal Dikarenakan Data yang anda kirim tidak sesuai dengan pembayaran seharusnya, Silahkan Coba Lagi dan lakukan pembayaran sesuai dengan pembayaran seharusnya, cek kembali bukti pengiriman dan pastikan input bukti pembayaran di isi dengan benar.</b> <br>
            <p>Terimakasih telah mempercayakan AKUNMTs untuk melakukan pembayaran sekolah secara online.</p>
        </div>
        <br><br>
        <div class="contact" style="margin-top: 5px;">
            <p>Salam Hangat dari kami!</p>
            <span style="margin-top: 15px;">E-mail ini dibuat oleh AKUNMTs, mohon tidak membalas email ini, jika butuh bantuan silahkan <b style="color: #50B958;"><a href="wa.me/628986004677" style="text-decoration: none; color: #50B958;">Hubungi Kami!</a></b></span>
        </div>
    </div>
</body>
</html>
