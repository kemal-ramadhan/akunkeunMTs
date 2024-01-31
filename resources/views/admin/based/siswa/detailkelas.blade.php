@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/ref-kelas" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Referensi / Data Siswa</b>
</h1>
<!-- Button trigger modal -->

<div class="card col-sm-6 mb-5 shadow-sm">
    <div class="card-body text-gray-800 mb-3">
        <div class="row">
            <div class="col-sm-6">
                <b class="mb-3">Nama Kelas</b>
                <h4>{{$details[0]->kelas_romawi_angka_abjad}} - {{$details[0]->nama_kelas}}</h4>
            </div>
            <div class="col-sm-6">
                <b>Wali Kelas</b>
                <h4>{{$details[0]->nama}}</h4>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>NISN/NIS</th>
                      <th>Nama Lengkap</th>
                      <th>Nama Orang tua</th>
                      <th>Kelas</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>No Telephone</th>
                      <th>Email</th>
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
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>No Telephone</th>
                    <th>Email</th>
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
                      <td>{{$siswa->tempat_lahir}}</td>
                      <td>{{$siswa->tanggal_lahir}}</td>
                      <td>{{$siswa->no_telepon}}</td>
                      <td>{{$siswa->email}}</td>
                      <td>{{$siswa->tahun_masuk}}</td>
                      <td>{{$siswa->tahun_keluar}}</td>
                      <td>{{$siswa->status}}</td>
                      <td>
                        <a href="/d_siswa/{{$siswa->id}}" class="badge b-primary">Detail</a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <div class="text-center mt-3">
        <a href="/ref-kelas" class="btn b-red">Kembali</a>
        <a href="/ref-siswa" class="btn b-primary">Tambah Data Siswa</a>
      </div>
  </div>
</div>

@endsection