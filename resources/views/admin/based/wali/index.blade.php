@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Orang Tua Atau Wali</b></h1>

<div class="card col-sm-3 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <b>Jumlah Orang tua/Wali</b>
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
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($walis as $wali)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$wali->nama}}</td>
                                            <td>{{$wali->username}}</td>
                                            <td>{{$wali->email}}</td>
                                            <td>{{$wali->no_telepon}}</td>
                                            <td>{{$wali->status}}</td>
                                            <td>
                                                <a href="/d_wali/{{$wali->id}}" class="badge b-primary">Detail</a>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_wali" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Orang Tua / Wali</label>
                <input type="text" class="form-control" name="nama" id="nama">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="nomber" class="form-label">No Telephone/WhatsApp</label>
                <input type="text" class="form-control" name="no_telp" id="nomber">
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