@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Produk Pembayaran</b></h1>
<!-- Button trigger modal -->

<div class="card col-sm-3 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <b>Jumlah Produk</b>
      <h1 class="bold-text">{{$total}}</h1>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
      <div class="d-flex mb-3 mt-3" style="float: right;">
          <a href="/ad_produk_langsung" class="btn b-primary">+ Tambah Baru</a>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Nominal</th>
                      <th>Untuk</th>
                      <th>Keterangan</th>
                      <th>Priode</th>
                      <th>Versi</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Nominal</th>
                    <th>Untuk</th>
                    <th>Keterangan</th>
                    <th>Priode</th>
                    <th>Versi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @foreach ($pembayarans as $pembayaran)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$pembayaran->nama_produk_pembayaran}}</td>
                    <td>{{$pembayaran->nominal}}</td>
                    <td>
                        @foreach ($kelass as $kelas)
                            @if ($pembayaran->IdProdukPem == $kelas->IdProduk)
                                <span class="badge b-primary">
                                    {{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}
                                </span>
                            @endif
                        @endforeach
                    </td>
                    <td>{{$pembayaran->keterangan}}</td>
                    <td>{{$pembayaran->priode_awal}} s.d {{$pembayaran->priode_akhir}}</td>
                    <td>{{$pembayaran->nama_versi}}</td>
                    <td>{{$pembayaran->status}}</td>
                    <td class="d-flex">
                        <a href="/d-produk-pembayaran/{{$pembayaran->IdProdukPem}}" class="badge b-primary mr-1">Edit</a>
                        <a href="/d-rincian-pembayaran/{{$pembayaran->IdProdukPem}}" class="badge badge-primary">Riwayat</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection