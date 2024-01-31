@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Guru</b></h1>
<!-- Button trigger modal -->

<div class="card col-sm-3 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <b>Jumlah Guru</b>
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
                      <th>NUPTK</th>
                      <th>Nama Lengkap</th>
                      <th>Jabatan</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>No Telephone</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th>No</th>
                      <th>NUPTK</th>
                      <th>Nama Lengkap</th>
                      <th>Jabatan</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>No Telephone</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @foreach ($gurus as $guru)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$guru->nuptk}}</td>
                      <td>{{$guru->nama}}</td>
                      <td>{{$guru->jabatan}}</td>
                      <td>{{$guru->tempat_lahir}}</td>
                      <td>{{$guru->tanggal_lahir}}</td>
                      <td>{{$guru->no_telepon}}</td>
                      <td>{{$guru->email}}</td>
                      <td>{{$guru->status}}</td>
                      <td>
                        <a href="/d_guru/{{$guru->id}}" class="badge b-primary">Detail</a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </div>
</div>

<!-- Tanbah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/c_guru" method="POST">
      @csrf
      <div class="modal-body">
          <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="NUPTK" class="form-label">NUPTK</label>
                <input type="text" class="form-control" name="nuptk" id="NUPTK">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="form-select" aria-label="Default select example" name="jabatan">
                  <option value="Guru">Guru</option>
                  <option value="Bagian Keuangan">Bagian Keuangan</option>
                  <option value="Kepala Madrasah">Kepala Madrasah</option>
                </select>
            </div>
            <div class="col-sm-6 mb-3">
                <label for="tempat" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat" id="tempat">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="tanggal" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal" id="tanggal">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="nomber" class="form-label">No Telephone/WhatsApp</label>
                <input type="text" class="form-control" name="no_telp" id="nomber">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-sm-6 mb-3">
                <label for="password" class="form-label">Password Akun</label>
                <input type="password" class="form-control" name="password" id="password">
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
        <button type="submit" class="btn b-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection