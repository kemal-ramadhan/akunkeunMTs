@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    <a href="/ref-produk-langsung" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
      </svg>
    </a>
    Data Referensi / Riwayat Pembayaran</b>
</h1>
<div class="card col-sm-5 mr-3 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Pembayaran</b></h5>
      <div class="d-flex justify-content-between mb-3">
        <b>Nama Produk</b>
        <b>{{$pembayaran->nama_produk_pembayaran}}</b>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <b>Nominal</b>
        <b>{{$pembayaran->nominal}}</b>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <b>Priode</b>
        <b>{{$pembayaran->priode_awal}} s.d {{$pembayaran->priode_akhir}}</b>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <b>Keterangan</b>
        <b class="col-sm-8 text-end">{{$pembayaran->keterangan}}</b>
      </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4>Daftar yang sudah membayar</h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal Bayar</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($riwayats as $riwayat)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$riwayat->nama}}</td>
                        <td>{{$riwayat->kelas_romawi_angka_abjad}} - {{$riwayat->nama_kelas}}</td>
                        <td>{{$riwayat->tanggalBayar}}</td>
                        <td><span class="badge b-primary" style="text-decoration: none;">{{$riwayat->status}}</span></td>
                    </tr>
                    @empty
                    <div class="alert alert-danger" role="alert">
                        Belum ada yang membayar!
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection