@extends('public.template.template')

@section('contain')
<div class="top-space">

    {{-- categori 2 --}}
    <div class="container mt-5">
        <span class="badge b-primary mb-3">Cicilan Saya</span>
        <h4 class="bold-text">Cicilan Pembayaran</h4>
        <div class="row mt-5 mb-3">
            @forelse ($cicilans as $cicilan)
            {{-- start card--}}
            <div class="col-sm-4 mb-5">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title bold-text mb-3">{{$cicilan->nama_cicilan}}</h5>
                      <h6>Atas Nama : <span class="badge b-primary">{{$cicilan->nama}}</span></h6>
                      <p class="card-text mb-3">{{$cicilan->keterangan}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="bold-text">Rp. {{number_format($cicilan->nominal,0,',','.')}},-</h6>
                          <a href="{{route('detailCicilanPublic', ['idcicilan' => $cicilan->IdProdukCicilan, 'idSiswa' => $cicilan->IdSiswa])}}" class="btn b-primary">Bayarkan</a>
                      </div>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            @empty
            <div class="text-center">
                <img src="{{asset('assets/icons/emptycart.png')}}" alt="emptcart" style="max-width: 300px">
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection