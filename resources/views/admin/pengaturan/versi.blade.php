@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    Pengaturan Versi Aplikasi</b>
</h1>

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
                        <th>Nama Versi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Versi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($versis as $versi)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$versi->nama_versi}}</td>
                            <td>
                                @if ($versi->status == 'Aktif')
                                    <span class="badge b-primary">{{$versi->status}}</span>
                                @endif
                                @if ($versi->status == 'Tidak Aktif')
                                    <span class="badge b-red">{{$versi->status}}</span>
                                @endif
                            </td>
                            <td>
                                <form action="/set_versi" method="post">
                                @csrf
                                <input type="hidden" name="idVersi" value="{{$versi->id}}">
                                <button type="submit" class="btn b-primary" onclick="return confirm('Yakin Akan Mengaktifkan Versi ini?, Perubahan Versi akan berpengaruh pada menu lainnya')">Aktifkan Versi</button>
                                </form>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Versi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_versi" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Versi</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="versi">
            </div>              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn b-primary">Tambah Versi</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection