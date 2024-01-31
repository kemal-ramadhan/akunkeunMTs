@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Kelas</b></h1>
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
                      <th>Nama Kelas</th>
                      <th>Kelas</th>
                      <th>Wali Kelas</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>No</th>
                      <th>Nama Kelas</th>
                      <th>Kelas</th>
                      <th>Wali Kelas</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                  </tr>
              </tfoot>
              <tbody>
                @foreach ($kelass as $kelas)
                <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$kelas->nama_kelas}}</td>
                      <td>{{$kelas->kelas_romawi_angka_abjad}}</td>
                      <td>{{$kelas->nama}}</td>
                      <td>{{$kelas->keterangan}}</td>
                      <td>
                        <a href="/d-kelas/{{$kelas->id}}" class="badge b-primary">Detail</a>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas Baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/c_kelas" method="POST">
      @csrf
      <div class="modal-body">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Kelas</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="mb-3">
          <label for="kelas" class="form-label">Kelas (Contoh : VII/7 A)</label>
          <input type="text" class="form-control" id="kelas" name="kelas">
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" rows="3" name="Keterangan"></textarea>
        </div>
        <div class="mb-3">
          <label for="kelas" class="form-label">Wali Kelas</label>
          <select class="form-select" aria-label="Default select example" name="guru">
            @foreach ($gurus as $guru)
            <option value="{{$guru->id}}">{{$guru->nama}}</option>
            @endforeach
          </select>
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