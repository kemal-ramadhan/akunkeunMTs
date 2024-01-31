@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Siswa</b></h1>
<!-- Button trigger modal -->

<div class="card col-sm-3 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <b>Jumlah Kelas</b>
      <h1 class="bold-text">{{$total}}</h1>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
      <div class="d-flex mb-3 mt-3" style="float: right;">
          <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              + Tambah Data Baru
          </button>
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
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa Baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/c_siswa" method="POST">
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6 mb-3">
            <label for="nisn" class="form-label">NISN</label>
            <input type="text" class="form-control" id="nisn" placeholder="nisn" name="nisn">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" placeholder="nisn" name="nis">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" placeholder="nama" name="nama">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" aria-label="Default select example" name="kelas">
              @foreach ($kelass as $kelas)
              <option value="{{$kelas->id}}">{{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6 mb-3">
            <label for="tempat" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat" placeholder="tempat" name="tempat">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggalLahir" placeholder="tanggal" name="tanggalLahir">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="noTlp" class="form-label">No Telephone/WhatsApp</label>
            <input type="text" class="form-control" id="NoTlp" placeholder="no Telephone/WhatsApp" name="noTlp">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="email" name="email">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="tahunMasuk" class="form-label">Tahun Masuk</label>
            <input type="date" class="form-control" id="tahunMasuk" placeholder="Tahun Masuk" name="tahunMasuk">
          </div>
          <div class="col-sm-6 mb-3">
            <label for="tahuKeluar" class="form-label">Tahun Keluar</label>
            <input type="date" class="form-control" id="tahuKeluar" placeholder="Tahun Masuk" name="tahunKeluar">
          </div>
          <div class="col-sm-12 mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
          </div>
          <div class="col-sm-6 mb-3">
            <label for="kelas" class="form-label">Nama Orang Tua</label>
            <select class="form-select" aria-label="Default select example" name="orangTua">
              @foreach ($walis as $wali)
              <option value="{{$wali->id}}">{{$wali->nama}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-6 mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status">
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn b-primary">Tambah Baru</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection