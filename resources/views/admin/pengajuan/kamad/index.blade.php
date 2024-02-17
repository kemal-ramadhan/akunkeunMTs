@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Daftar Pengajuan Bagian Kepala Madrasah</b></h1>

<div class="d-flex mb-3">
    <a href="/daftar-pengajuan-kamad/{{$status = 'Pengajuan'}}" class="btn {{ $activebutton == 'Pengajuan' ? 'b-primary mr-3' : 'btn-secound'}}">Pengajuan</a>
    <a href="/daftar-pengajuan-kamad/{{$status = 'Disetujui'}}" class="btn {{ $activebutton == 'Disetujui' ? 'b-primary mr-3' : 'btn-secound'}}">Selesai</a>
    <a href="/daftar-pengajuan-kamad/{{$status = 'Ditolak'}}" class="btn {{ $activebutton == 'Ditolak' ? 'b-primary mr-3' : 'btn-secound'}}">Ditolak</a>
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
                                <a href="/detail_pengajuan_kamad/{{$daftar->id}}" class="badge b-primary">Verifikasi</a>
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