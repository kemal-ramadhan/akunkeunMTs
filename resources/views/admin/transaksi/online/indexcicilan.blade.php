@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi Cicilan Online</b></h1>
<!-- Button trigger modal -->

<div class="row container">
    <div class="card col-sm-3 mr-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Menunggu Konfirmasi</b>
          <h1 class="bold-text">{{$countantrian}}</h1>
        </div>
    </div>
    
    <div class="card non-border col-sm-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Selesai</b>
          <h1 class="bold-text">{{$countselesai}}</h1>
        </div>
    </div>
</div>

<div class="d-flex mb-3">
    <a href="/transaksi-cicilan-online/{{$status = 'Menunggu Konfirmasi'}}" class="btn mr-3 {{ $activebutton == 'Menunggu Konfirmasi' ? 'b-primary' : 'btn-secound'}}">Menunggu Konfirmasi</a>
    <a href="/transaksi-cicilan-online/{{$status = 'Selesai'}}" class="btn {{ $activebutton == 'Selesai' ? 'b-primary' : 'btn-secound'}}">Selesai</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="mb-3">
        <h4>Antrian Pembayaran Online</h4>
    </div>
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Nama Siswa</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @forelse ($antrians as $antrian)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$antrian->nama}}</td>
                  <td>{{$antrian->tanggal_bayar}}</td>
                  <td>{{$antrian->status}}</td>
                  <td>
                    <a href="/transaksi_cicilan_online/{{$antrian->IdCicilan}}" class="badge b-primary">Konfirmasi</a>
                  </td>
                </tr>
                @empty
                    
                @endforelse
              </tbody>
          </table>
      </div>
  </div>
</div>

@endsection