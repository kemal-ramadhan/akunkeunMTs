@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Produk Cicilan Pembayaran</b></h1>
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
          <a href="/ad_produk_cicilan" class="btn b-primary">+ Tambah Baru</a>
      </div>
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Cicilan</th>
                      <th>Nominal</th>
                      <th>Keterangan</th>
                      <th>Priode</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Nama Cicilan</th>
                      <th>Nominal</th>
                      <th>Keterangan</th>
                      <th>Priode</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @foreach ($cicilans as $cicilan)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$cicilan->nama_cicilan}}</td>
                    <td>{{$cicilan->nominal}}</td>
                    <td>{{$cicilan->keterangan}}</td>
                    <td>{{$cicilan->priode_awal}} s.d {{$cicilan->priode_akhir}}</td>
                    <td>{{$cicilan->status}}</td>
                    <td>
                        <a href="/d_produk_cicilan/{{$cicilan->id}}" class="badge b-primary">Detail</a>
                        <a href="/d_riwayat_cicilan/{{$cicilan->id}}" class="badge badge-primary">Riwayat</a>
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>
@endsection