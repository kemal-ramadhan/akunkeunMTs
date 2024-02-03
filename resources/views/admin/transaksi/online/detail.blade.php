@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi Online / {{$detail[0]->nama}}</b></h1>
<!-- Button trigger modal -->
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="produk" class="form-label">Nama Siswa</label><br>
                    <h5>{{$detail[0]->nama}}</h5>
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="nominal" class="form-label">Tanggal Pembayaran</label><br>
                            <h5>{{$detail[0]->tanggal_bayar}}</h5>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="nominal" class="form-label badge b-primary">Status</label><br>
                            <h5>{{$detail[0]->status}}</h5>
                        </div>
                      </div>
                  </div>
            </div>  
            <hr>
            <div class="row">
                <div class="col-6">
                    <h5><b>Bukti Pembayaran</b></h5>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-6 mb-3">
                            <label for="">Nama Pengirim</label>
                            <h6 class="bold-text">{{$bukti->atas_nama}}</h6>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Tanggal Pembayaran</label>
                            <h6 class="bold-text">{{$bukti->tanggal_bayar}}</h6>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Via Transfer</label>
                            <h6 class="bold-text">{{$bukti->bank}}</h6>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Nominal</label>
                            <h6 class="bold-text">{{$bukti->nominal}}</h6>
                        </div>
                        <div class="col-8 mb-3">
                            <label for="">Berita Acara</label>
                            <h6 class="">{{$bukti->keterangan}}</h6>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="">Bukti Transfer</label><br>
                            <a href="{{asset('storage/' . $bukti->file)}}" class="btn b-primary" target="_blank">Lihat Bukti</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h5><b>Untuk Pembayaran</b></h5>
                    <hr>
                    @foreach ($riwayats as $riwayat)
                    {{-- card --}}
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="mb-2">
                                <h5 class="card-title bold-text mb-3">{{$riwayat->nama_produk_pembayaran}}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Atas Nama : {{$riwayat->nama}}</h6>
                                    <h6 class="bold-text">Rp. {{number_format($riwayat->nominal,0,',','.')}},-</h6>
                                    <span class="badge b-secound">Status : {{$riwayat->status}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end card --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection