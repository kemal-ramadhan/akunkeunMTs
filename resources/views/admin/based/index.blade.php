@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Dashboard</b></h1>
<h1 class="h3 mb-4 text-gray-800">Hallo, Selamat Datang <b>{{ auth('guru')->user()->nama }}</b></h1>

<div class="container row mb-3">
        <div class="col-sm-4">
            <div class="row">
                <div class="card col-sm-12 mb-3">
                    <div class="card-body">
                        <h6>Pendapatan Bulan Ini</h6>
                        <h1 class="bold-text">{{number_format($pendapatanBulanan,0,',','.')}}</h1>
                    </div>
                </div>
                <div class="card col-sm-12 mb-3">
                    <div class="card-body">
                        <h6>Pendapatan Hari Ini</h6>
                        <h1 class="bold-text">{{number_format($pemasukan,0,',','.')}}</h1>
                    </div>
                </div>
                <div class="card col-sm-12 mb-3">
                    <div class="card-body">
                        <h6>Pengeluaran Hari Ini</h6>
                        <h1 class="bold-text">{{number_format($pengeluaran,0,',','.')}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
</div>

<div class="row mb-3">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="bold-text">Antrian Verifikasi Pembayaran <span class="badge b-primary">{{$sumantrian}}</span></h5>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Atas Nama</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($antrians as $antrian)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$antrian->nama}}</td>
                            <td>
                                <a href="/detail-transaksi-online/{{$antrian->idPesanan}}" class="badge b-primary">Transaksi</a>
                            </td>
                        </tr>
                    @empty
                    <div class="text-center">
                        <img src="{{asset('assets/icons/waiting.svg')}}" alt="emptcart" style="max-width: 143px">
                    </div>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <h5 class="bold-text">Antrian Verifikasi Cicilan <span class="badge b-primary">{{$countantrian}}</span></h5>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Atas Nama</th>
                    <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($antrianCicilans as $antrianCicilan)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$antrianCicilan->nama}}</td>
                            <td>
                                <a href="/transaksi_cicilan_online/{{$antrianCicilan->IdCicilan}}" class="badge b-primary">Konfirmasi</a>
                            </td>
                        </tr>
                    @empty
                    <div class="text-center">
                        <img src="{{asset('assets/icons/mountend.svg')}}" alt="emptcart" style="max-width: 250px">
                    </div>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                {!! $kakeibo->container() !!}
            </div>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script src="{{ $kakeibo->cdn() }}"></script>
{{ $kakeibo->script() }}
@endsection