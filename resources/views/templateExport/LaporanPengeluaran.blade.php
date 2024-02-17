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
        <h3 style="text-transform: uppercase;">{{$pengeluaran->nama_pengeluaran}}</h3>
        <h3>MTs AT - TARBIYAH DAYEUHKOLOT</h3>
        <h3 style="text-transform: uppercase;">{{$pengeluaran->nama_versi}}</h3>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="10px">No</th>
                <th>Tanggal</th>
                <th>Pengeluaran</th>
                <th>Kategori</th>
                <th>Atas Nama</th>
                <th width="10px">QLY</th>
                <th>Harga Satuan</th>
                <th>Total</th>
                <th>Sumber Dana</th>
                <th>Paraf</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($detailPengeluarans as $detailPengeluaran)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$detailPengeluaran->tanggal_pengeluaran}}</td>
                    <td>{{$detailPengeluaran->nama_pengeluaran}}</td>
                    <td>{{$detailPengeluaran->jenis}}</td>
                    <td>{{$detailPengeluaran->atas_nama}}</td>
                    <td>{{$detailPengeluaran->jumlah}}</td>
                    <td>{{number_format($detailPengeluaran->harga_satuan,0,',','.')}}</td>
                    <td>{{number_format($detailPengeluaran->total,0,',','.')}}</td>
                    <td>{{$detailPengeluaran->nama_produk_pembayaran}}</td>
                    <td></td>
                </tr>
            @empty
            <div class="alert alert-danger" role="alert">
                Belum Ada Transaksi
            </div>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pengeluaran</th>
                <th>Kategori</th>
                <th>Atas Nama</th>
                <th colspan="2">Total</th>
                <th>{{number_format($totalKeseluruhan,0,',','.')}}</th>
                <th>Sumber Dana</th>
                <th>Paraf</th>
            </tr>
        </tfoot>
    </table>


</body>
</html>