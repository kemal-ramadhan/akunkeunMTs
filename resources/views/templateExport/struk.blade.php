<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pembayaran</title>

    <style>
        .container{
            max-width: 10cm;
            margin: 0px auto;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 0.7rem;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 26px;
        }
        
        .sub-title {
            text-align: center;
            font-weight: bold;
        }
        .text-head{
            line-height: 15px;
        }
        .body-struk{
            line-height: 20px;
        }
        .space{
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- <div class="image-center">
            <img src="{{asset('assets/icons/mts.png')}}" alt="" srcset="">
        </div> --}}
        <div class="text-head">
            <h1 class="judul">BUKTI PEMBAYARAN</h1>
            <h4 class="sub-title">MTs At - Tarbiyah Dayeuhkolot, Kp. Sayuran No. 118 Rt 03 Rw 08 Desa Cangkuang Kulon Kec.  Dayeuhkolot Bandung 40239</h4>
        </div>
        <hr>
        <div class="body-struk">
            <div class="space">
                <b>Kode Pembayaran</b>
                <b style="float: right">{{$siswa->IdPesanan}}</b>
            </div>
            <div class="space">
                <b>Atas Nama</b>
                <b style="float: right">{{$siswa->nama}}</b>
            </div>
            <div class="space">
                <b>Kelas</b>
                <b style="float: right">{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</b>
            </div>
            <div class="space">
                <b>Tanggal Pembayaran</b>
                <b style="float: right">{{$siswa->tglBayar}}</b>
            </div>
            <hr>
            @forelse ($keranjangs as $keranjang)
            <div class="space">
                <b>{{$keranjang->nama_produk_pembayaran}}</b>
                <b style="float: right">{{number_format($keranjang->nominal,0,',','.')}}</b>
            </div>
            @empty
                <div class="alert alert-danger" role="alert">
                Belum Ada data dikeranjang!
                </div>
            @endforelse
            <hr>
            <div class="space">
                <b>Total</b>
                <b style="float: right">{{number_format($sumkeranjang,0,',','.')}}</b>
            </div>
            <hr>
            <p class="sub-title">Terimakasih Atas Pembayarannya! Simpan Struk ini sebagai bukti bahwa anda telah membayar</p>
        </div>
    </div>
</body>
</html>