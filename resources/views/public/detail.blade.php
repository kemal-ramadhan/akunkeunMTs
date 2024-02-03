@extends('public.template.template')

@section('contain')
<form action="/c_keranjang_public" method="post">
@csrf
<input type="hidden" name="idProduk" value="{{$produk->id}}">
<input type="hidden" name="idSiswa" value="{{$siswa->id}}">
<input type="hidden" name="nominal" value="{{$produk->nominal}}">
<div class="top-space">
    <div class="container">
        <div class="col-sm-5 mx-auto mb-5">
            <div class="card">
                <div class="card-body">
                  <h2 class="card-title bold-text mb-3">{{$produk->nama_produk_pembayaran}}</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Priode : {{$produk->priode_awal}} s.d {{$produk->priode_akhir}}</h6>
                        <h5 class="bold-text">Rp. {{number_format($produk->nominal,0,',','.')}},-</h5>
                    </div>
                  <p class="card-text space-text-20 mb-3">{{$produk->keterangan}}</p>
                  <span class="badge b-secound mb-3">Belum Dibayarkan</span>
                  <hr class="container mb-3">
                  <div class="mb-3">
                    <label for="" class="mb-3">Atas Nama Siswa</label>
                    <input type="text" class="form-control" value="{{$siswa->nama}}" readonly>
                  </div>
                  <div class="d-grid gap-2">
                    <button class="btn b-primary d-flex justify-content-center" type="submit">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" style="margin-right: 5px;" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                      </svg>
                      <span>Tambah Ke Keranjang</span>
                    </button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection