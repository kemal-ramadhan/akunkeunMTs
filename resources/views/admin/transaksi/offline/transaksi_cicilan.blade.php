@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi Cicilan / {{$siswa[0]->nama}}</b></h1>

<div class="row">
@forelse ($cicilans as $cicilan)
        {{-- start card--}}
    <div class="col-sm-4 mb-3">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title bold-text mb-3">{{$cicilan->nama_cicilan}}</h5>
            <p class="card-text mb-3">{{$cicilan->keterangan}}</p>
            <p class="card-text mb-3">Priode : {{$cicilan->priode_awal}} s.d {{$cicilan->priode_akhir}}</p>
            <span class="badge b-primary">{{$cicilan->status}}</span>
                <div class="d-flex justify-content-between align-items-center">
                    <input id="" type="hidden" value="{{$siswa[0]->id}}" name="idSiswa">
                    <input id="" type="hidden" value="{{$cicilan->nominal}}" name="nominal">
                    <h6 class="bold-text">Rp. {{number_format($cicilan->nominal,0,',','.')}}</h6>
                    <a href="/daftar-cicilan-siswa/{{$cicilan->IdCicilan}}" class="btn b-primary">Bayar Cicilan</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end card --}}
    @empty
    <div class="container alert alert-danger" role="alert">
        Data Pembayaran Cicilan Tidak Ditemukan!
    </div>
@endforelse
</div>
@endsection