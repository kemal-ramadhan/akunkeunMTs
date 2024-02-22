@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/detail_pengeluaran/{{$pengeluaran->id}}" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Pengeluaran / {{$pengeluaran->nama_pengeluaran}} / Pengaturan</b>
</h1>

<form action="/u_pengaturan_pengeluaran" method="post">
    @csrf
    <input type="hidden" name="IdPengeluaran" value="{{$pengeluaran->id}}">
<div class="card mb-3">
    <div class="card-body">
        <div class="col-sm-12">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Detail Pengeluaran</h5>
            </div>
            <hr>
            <div class="row">
                <div class="mb-3 col-sm-6">
                    <label for="exampleFormControlInput1" class="form-label">Kategori Pengeluaran</label>
                    <input type="text" class="form-control" name="kategori" id="exampleFormControlInput1" value="{{$pengeluaran->nama_pengeluaran}}">
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="exampleFormControlInput1" class="form-label">Tahun Anggaran</label>
                    <select class="form-select" aria-label="Default select example" name="versi">
                        @foreach ($versis as $versi)
                            @if ($versi->id == $pengeluaran->id_versi)
                            <option value="{{$versi->id}}" selected>{{$versi->nama_versi}}</option>
                            @endif
                        <option value="{{$versi->id}}">{{$versi->nama_versi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-sm-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3">{{$pengeluaran->keterangan}}</textarea>
                  </div>
                <div class="col-sm-6">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$pengeluaran->status}}" selected>{{$pengeluaran->status}}</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Selesai">Selesai</option>
                      </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <h5>Colabolator</h5>
            <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                  </svg>
                  <span class="ml-2">Tambah Colaborator</span>
            </button>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Guru</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($colaborators as $colaborator)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$colaborator->nama}}</td>
                    <td>
                        <a href="/d_colaborator/{{$colaborator->IdHub}}/{{$pengeluaran->id}}" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Ini?')" class="badge b-red">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center mt-3">
        <button type="submit" class="btn b-primary">Perbaharui Data</button>
    </div>
    </div>
</div>
</form>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Colabolator</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_colabolator" method="post">
            @csrf
            <input type="hidden" name="idPengeluaran" value="{{$pengeluaran->id}}">
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Guru</label>
                <select class="form-select" aria-label="Default select example" name="guru">
                    @foreach ($gurus as $guru)
                    <option value="{{$guru->id}}">{{$guru->nama}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn b-primary">Tambah Colabolator</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection