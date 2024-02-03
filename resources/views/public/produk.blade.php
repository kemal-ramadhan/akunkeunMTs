@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container mt-5">
        <div class="card col-sm-9 mx-auto shadow-sm" style="border: none">
            <div class="card-body">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control" placeholder="Cari Sesuatu ..." aria-label="Cari Sesuatu ..." aria-describedby="button-addon2">
                    <button class="btn b-primary" type="button" id="button-addon2">Cari</button>
                </div>

            </div>
        </div>           
    </div>


    {{-- categori 1 --}}
    <div class="container mt-5">
        <span class="badge b-primary mb-3">Pembayaran Bulanan</span>
        <h4 class="bold-text">Pembayaran Siswa</h4>
        <div class="row mt-5 mb-3">
            @forelse ($produks as $produk)
            @php
                $adaPasanganSama = false; // Variabel penanda
            @endphp
            @foreach ($riwayats as $riwayat)
                @if (($riwayat->IdSiswa == $produk->IdSiswa) && ($riwayat->id_produk_langsung == $produk->IdProdukLangsung))
                    @php
                    $adaPasanganSama = true; // Ada pasangan yang sama
                    @endphp
                    {{-- start card--}}
                    <div class="col-sm-4 mb-5">
                        <div class="card">
                            <div class="card-body">
                            <h5 class="card-title bold-text mb-3">{{$produk->nama_produk_pembayaran}}</h5>
                            <h6>Kelas : VII/7</h6>
                            <h6>Atas Nama : <span class="badge b-primary">{{$produk->nama}}</span></h6>
                            <p class="card-text mb-3">{{$produk->keterangan}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="bold-text">Rp. {{number_format($produk->nominal,0,',','.')}},-</h6>
                                <span class="btn b-red">Sudah Membayar</span>
                            </div>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}
                @endif
            @endforeach
            @if (!$adaPasanganSama)
            {{-- start card--}}
            <div class="col-sm-4 mb-5">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title bold-text mb-3">{{$produk->nama_produk_pembayaran}}</h5>
                      <h6>Kelas : VII/7</h6>
                      <h6>Atas Nama : <span class="badge b-primary">{{$produk->nama}}</span></h6>
                      <p class="card-text mb-3">{{$produk->keterangan}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="bold-text">Rp. {{number_format($produk->nominal,0,',','.')}},-</h6>
                          <a href="{{route('detailProduk', ['idProduk' => $produk->IdProdukLangsung, 'idSiswa' => $produk->IdSiswa])}}" class="btn b-primary">Bayarkan</a>
                      </div>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            @endif
            @empty
            <div class="text-center">
                <img src="{{asset('assets/icons/emptycart.png')}}" alt="emptcart" style="max-width: 300px">
            </div>
            @endforelse
            
        </div>
    </div>

    {{-- categori 2 --}}
    <div class="container mt-5">
        <span class="badge b-primary mb-3">Rangkaian Ujian</span>
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
                          <a href="#" class="btn b-primary">Bayarkan</a>
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