<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 0.7rem;
      margin: 0;
      padding: 0;
      background-image: url('logo.ong'); /* Ganti dengan nama dan lokasi file logo perusahaan Anda */
      background-size: cover; /* Menyesuaikan ukuran gambar dengan ukuran jendela browser */
      background-position: center; /* Posisi gambar di tengah */
    }

    .invoice {
      max-width: 21cm;
      margin: 5px auto;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.8); /* Warna latar belakang semi transparan untuk konten */
    }

    .invoice-header {
      text-align: center;
    }

    .invoice-info {
      margin-top: 20px;
    }

    .invoice-info p {
      margin: 5px 0;
    }

    .invoice-info span {
      font-weight: bold;
    }

    .customer-details {
      margin-top: 30px;
    }

    .customer-details h2 {
      margin-bottom: 10px;
    }

    .customer-details p {
      margin: 5px 0;
    }

    .invoice-details {
      margin-top: 20px;
      width: 100%;
      border-collapse: collapse;
    }

    .invoice-details th,
    .invoice-details td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .invoice-details th {
      background-color: #f2f2f2;
    }

    .invoice-total {
      margin-top: 30px;
      text-align: right;
    }

    .invoice-total h2 {
      margin-bottom: 10px;
    }

    .invoice-total p {
      font-weight: bold;
    }
    .signature {
      margin-top: 50px;
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="invoice">
    <div class="invoice-header">
      <h1>Invoice</h1>
      <div class="invoice-info">
        <p>Invoice Number: <span>#{{$siswa->IdPesanan}}</span></p>
        <p>Date: <span>{{$siswa->tglBayar}}</span></p>
      </div>
    </div>
    <div class="customer-details">
      <h2>Detail Pembayaran</h2>
      <p>Name       : {{$siswa->nama}}</p>
      <p>Kelas      : {{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</p>
      <p>Sekolah    : MTs At - Tarbiyah Dayeuhkolot</p>
    </div>
    <table class="invoice-details">
      <thead>
        <tr>
          <th>No</th>
          <th>Pembayaran</th>
          <th>Nominal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($keranjangs as $keranjang)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$keranjang->nama_produk_pembayaran}}</td>
          <td>{{number_format($keranjang->nominal,0,',','.')}}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th style="text-align: center" colspan="2">Total</th>
          <th>{{number_format($sumkeranjang,0,',','.')}}</th>
        </tr>
    </tfoot>
    </table>
    <div class="signature">
        <p>Bendahara Sekolah</p>
        <br><br><br>
        <p>......................................</p>
    </div>
  </div>
</body>
</html>