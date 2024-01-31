@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/ref-siswa" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Referensi / Siswa / {{$siswa[0]->namaSiswa}}</b>
</h1>

<div class="card col-sm-12 mb-5 shadow-sm">
    <form action="/u_siswa" method="post">
    @csrf
    <div class="card-body text-gray-800">
      <h5><b>Detail Data</b></h5>
      <hr style="background-color: black; height: 2px; margin: 10px auto;">
      <div class="row">
        <div class="col-sm-6 mb-3">
          <label for="nisn" class="form-label">NISN</label>
          <input type="text" class="form-control" id="nisn" placeholder="nisn" name="nisn" value="{{$siswa[0]->nisn}}">
          <input type="hidden" name="idSiswa" value="{{$siswa[0]->id}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="nis" class="form-label">NIS</label>
          <input type="text" class="form-control" id="nis" placeholder="nisn" name="nis" value="{{$siswa[0]->nis}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="{{$siswa[0]->namaSiswa}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="kelas" class="form-label">Kelas</label>
          <select class="form-select" aria-label="Default select example" name="kelas">
            @foreach ($kelass as $kelas)
            @if ($siswa[0]->IdKelas == $kelas->id)
            <option value="{{$kelas->id}}" selected>{{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}</option>
            @endif
            <option value="{{$kelas->id}}">{{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tempat" class="form-label">Tempat Lahir</label>
          <input type="text" class="form-control" id="tempat" placeholder="tempat" name="tempat" value="{{$siswa[0]->tempat_lahir}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tanggalLahir" placeholder="tanggal" name="tanggalLahir" value="{{$siswa[0]->tanggal_lahir}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="noTlp" class="form-label">No Telephone/WhatsApp</label>
          <input type="text" class="form-control" id="NoTlp" placeholder="no Telephone/WhatsApp" name="noTlp" value="{{$siswa[0]->no_telepon}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" placeholder="email" name="email" value="{{$siswa[0]->email}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tahunMasuk" class="form-label">Tahun Masuk</label>
          <input type="date" class="form-control" id="tahunMasuk" placeholder="Tahun Masuk" name="tahunMasuk" value="{{$siswa[0]->tahun_masuk}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tahuKeluar" class="form-label">Tahun Keluar</label>
          <input type="date" class="form-control" id="tahuKeluar" placeholder="Tahun Masuk" name="tahunKeluar" value="{{$siswa[0]->tahun_keluar}}">
        </div>
        <div class="col-sm-12 mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat">{{$siswa[0]->alamat}}</textarea>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="kelas" class="form-label">Nama Orang Tua</label>
          <select class="form-select" aria-label="Default select example" name="orangTua">
            @foreach ($walis as $wali)
            @if ($siswa[0]->IdWali == $wali->id)
            <option value="{{$wali->id}}" selected>{{$wali->nama}}</option>
            @endif
            <option value="{{$wali->id}}">{{$wali->nama}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" aria-label="Default select example" name="status">
            <option value="{{$siswa[0]->status}}" selected>{{$siswa[0]->status}}</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="text-center mt-3">
        <a href="/ref-siswa" class="btn b-red">Kembali</a>
        <button type="submit" class="btn b-primary">Perbaharui Data</button>
      </div>
    </div>
    </form>
</div>

@endsection