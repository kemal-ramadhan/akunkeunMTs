@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi</b></h1>
<!-- Button trigger modal -->

<div class="row container">
    <div class="card col-sm-3 mr-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Jumlah Siswa</b>
          <h1 class="bold-text">{{$total}}</h1>
        </div>
    </div>
    
    <div class="card non-border col-sm-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <b>Jumlah Kelas</b>
          <h1 class="bold-text">{{$totalKelas}}</h1>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="mb-3">
        <h4>Daftar Siswa</h4>
    </div>
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NISN/NIS</th>
                      <th>Nama Lengkap</th>
                      <th>Nama Orang tua</th>
                      <th>Kelas</th>
                      <th>Tahun Masuk</th>
                      <th>Tahun Keluar</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NISN/NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Orang tua</th>
                    <th>Kelas</th>
                    <th>Tahun Masuk</th>
                    <th>Tahun Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @foreach ($siswas as $siswa)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$siswa->nisn}}/{{$siswa->nis}}</td>
                      <td>{{$siswa->namaSiswa}}</td>
                      <td>{{$siswa->nama}}</td>
                      <td>{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</td>
                      <td>{{$siswa->tahun_masuk}}</td>
                      <td>{{$siswa->tahun_keluar}}</td>
                      <td>{{$siswa->status}}</td>
                      <td>
                        <a href="/transaksi-siswa/{{$siswa->id}}" class="badge b-primary">Transaksi</a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>

@endsection