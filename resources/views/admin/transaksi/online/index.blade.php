@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi Online</b></h1>
<!-- Button trigger modal -->

<div class="row container">
    <div class="card col-sm-3 mr-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Menunggu Konfirmasi</b>
          <h1 class="bold-text">{{$sumantrian}}</h1>
        </div>
    </div>
    
    <div class="card non-border col-sm-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Selesai</b>
          <h1 class="bold-text">{{$sumselesai}}</h1>
        </div>
    </div>
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
                    <td>{{$antrian->tglBayar}}</td>
                    <td>
                        @if ($antrian->status == 'Menunggu Konfirmasi')
                            <span class="badge b-red">{{$antrian->status}}</span></td>
                        @else
                            <span class="badge b-primary">{{$antrian->status}}</span></td>
                        @endif
                    <td>
                        <a href="/detail-transaksi-online/{{$antrian->idPesanan}}" class="badge b-primary">Transaksi</a>
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