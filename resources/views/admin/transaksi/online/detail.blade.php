@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <a href="/transaksi-onine/{{$status = 'Menunggu Konfirmasi'}}" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
      </svg>
    </a>
    <b>Transaksi Online / {{$detail[0]->nama}}</b></h1>
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
                            <h6 class="bold-text">{{number_format($bukti->nominal,0,',','.')}}</h6>
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
            <hr>
            <form action="/u_pesanan" method="post">
            @csrf
            <input type="hidden" name="idPesanan" value="{{$detail[0]->idPesanan}}">
            @if ($detail[0]->status == "Menunggu Konfirmasi")
            <div class="text-center mx-auto col-sm-6 mb-3">
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="status">
                    <option value="Telah Dibayarkan">Konfirmasi Pembayaran</option>
                    <option value="Tidak Sesuai">Data Tidak Sesuai, Hapus Dari Pesanan</option>
                </select>
                <div class="d-grid gap-2">
                    <button class="btn b-primary btn-lg" type="submit">Konfirmasi</button>
                </div>
            </div>
            @endif
            @if ($detail[0]->status == "Telah Dibayarkan")
            <div class="text-center mx-auto col-sm-6 mb-3">
                <div class="d-grid gap-2">
                    <a href="/transaksi-onine/{{$status = 'Menunggu Konfirmasi'}}" class="btn b-red btn-lg">Kembali</a>
                </div>
            </div>
            @endif
            </form>
        </div>
    </div>
</div>
@endsection