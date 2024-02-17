@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Daftar Pengajuan Saya</b></h1>

<div class="d-flex mb-3">
    <a href="/daftar-pengajuan-saya/{{$status = 'Pengajuan'}}" class="btn {{ $activebutton == 'Pengajuan' ? 'b-primary mr-3' : 'btn-secound'}}">Verifikasi Bag Keuangan</a>
    <a href="/daftar-pengajuan-saya/{{$status = 'Verifikasi'}}" class="btn {{ $activebutton == 'Verifikasi' ? 'b-primary mr-3' : 'btn-secound'}}">Verifikasi Bag Kamad</a>
    <a href="/daftar-pengajuan-saya/{{$status = 'Pembelian'}}" class="btn {{ $activebutton == 'Pembelian' ? 'b-primary mr-3' : 'btn-secound'}}">Laporan</a>
    <a href="/daftar-pengajuan-saya/{{$status = 'Selesai'}}" class="btn {{ $activebutton == 'Selesai' ? 'b-primary mr-3' : 'btn-secound'}}">Selesai</a>
    <a href="/daftar-pengajuan-saya/{{$status = 'Ditolak'}}" class="btn {{ $activebutton == 'Ditolak' ? 'b-primary mr-3' : 'btn-secound'}}">Ditolak</a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Pengajuan</th>
                        <th>Jenis</th>
                        <th>Nominal Yang Diajukan</th>
                        <th>Status</th>
                        <th>Verifikasi Keuangan</th>
                        <th>Verifikasi Kepala Madrasah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Nama Pengajuan</th>
                        <th>Jenis</th>
                        <th>Nominal Yang Diajukan</th>
                        <th>Status</th>
                        <th>Verifikasi Keuangan</th>
                        <th>Verifikasi Kepala Madrasah</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($daftars as $daftar)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$daftar->tanggal_pengajuan}}</td>
                            <td>{{$daftar->nama_pengajuan}}</td>
                            <td>{{$daftar->jenis_pengajuan}}</td>
                            <td>{{number_format($daftar->nominal,0,',','.')}}</td>
                            <td>{{$daftar->status_pengajuan}}</td>
                            <td>{{$daftar->status_bag_keuangan}}</td>
                            <td>{{$daftar->status_bag_kamad}}</td>
                            <td>
                                <a href="/detail_pengajuan_saya/{{$daftar->id}}" class="badge b-primary">Detail Pengajuan</a>
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