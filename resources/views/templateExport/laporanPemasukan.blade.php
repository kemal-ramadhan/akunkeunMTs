<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pemasukan</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 11px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .judul-laporan{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="judul-laporan">
        <h3>LAPORAN PEMASUKAN KEUANGAN</h3>
        <h3>MTs AT - TARBIYAH DAYEUHKOLOT</h3>
        <h3>PRIODE {{$priodeAwal}} s.d {{$priodeAkhir}}</h3>
    </div>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10px">No</th>
                <th>Tanggal Pemasukan</th>
                <th>Keterangan</th>
                <th>Dari</th>
                <th>Nominal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pemasukans as $pemasukan)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pemasukan->tanggalPemasukan}}</td>
                <td>{{$pemasukan->nama_produk_pembayaran}}</td>
                <td>{{$pemasukan->nama}}</td>
                <td>{{number_format($pemasukan->nominal,0,',','.')}}</td>
                <td>{{$pemasukan->status}}</td>
            </tr>
            @empty
            <div class="alert alert-danger text-center" role="alert">
                <h5>Data Tidak Ditemukan</h5>
                <p>Cari data lain mungkin anda salah memasukan input!</p>
              </div>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>{{number_format($total,0,',','.')}}</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>


</body>
</html>