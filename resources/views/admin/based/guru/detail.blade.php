@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Orang Tua Atau Wali / {{$guru->nama}}</b></h1>

<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

    <form action="/u_guru" method="post">
        @csrf
      <div class="row mt-3">
        <div class="col-sm-6 mb-3">
            <label for="NUPTK" class="form-label">NUPTK</label>
            <input type="text" class="form-control" name="nuptk" id="NUPTK" value="{{$guru->nuptk}}">
            <input type="hidden" name="IdGuru" value="{{$guru->id}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{$guru->nama}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" aria-label="Default select example" name="jabatan">
              <option value="{{$guru->jabatan}}" selected>{{$guru->jabatan}}</option>
              <option value="Guru">Guru</option>
              <option value="Bagian Keuangan">Bagian Keuangan</option>
              <option value="Kepala Madrasah">Kepala Madrasah</option>
            </select>
        </div>
        <div class="col-sm-6 mb-3">
            <label for="tempat" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" name="tempat" id="tempat" value="{{$guru->tempat_lahir}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="tanggal" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$guru->tanggal_lahir}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="nomber" class="form-label">No Telephone/WhatsApp</label>
            <input type="text" class="form-control" name="no_telp" id="nomber" value="{{$guru->no_telepon}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{$guru->email}}">
        </div>
        <div class="col-sm-6 mb-3">
            <label for="password" class="form-label">Password Akun</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password Baru">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" aria-label="Default select example" name="status">
            <option value="{{$guru->status}}">{{$guru->status}}</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
          </select>
        </div>
      </div>

      <div class="text-center mt-3">
        <a href="/ref-guru" class="btn b-red">Kembali</a>
        <button type="submit" class="btn b-primary">Perbaharui Data</button>
      </div>
      </form>
    </div>
</div>


@endsection