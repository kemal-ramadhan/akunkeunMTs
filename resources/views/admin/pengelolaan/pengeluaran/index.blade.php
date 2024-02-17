@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Pengeluaran</b></h1>

<div class="card mb-3 col-sm-12">
    <div class="card-body">
        {!! $chart->container() !!}
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        
        <div class="d-flex mb-3 flex-row-reverse">
            <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="ml-2">Tambah Kategori Pengeluaran</span>
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Tahun ANggaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Pengeluaran</th>
                        <th>Keterangan</th>
                        <th>Tahun ANggaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($pengeluarans as $pengeluaran)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$pengeluaran->nama_pengeluaran}}</td>
                            <td>{{$pengeluaran->keterangan}}</td>
                            <td>{{$pengeluaran->nama_versi}}</td>
                            <td>{{$pengeluaran->status}}</td>
                            <td>
                                <a href="/detail_pengeluaran/{{$pengeluaran->id}}" class="badge b-primary">Detail</a>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Pengeluaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_kategori_pengeluaran" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="Nama" class="form-label">Nama Kategori Pengeluaran</label>
                <input type="text" class="form-control" id="Nama" name="kategori">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Tahun Anggaran</label>
                <select class="form-select" aria-label="Default select example" name="versi">
                    @foreach ($versis as $versi)
                    @if ($versi->status == 'Aktif')
                    <option value="{{$versi->id}}" selected>{{$versi->nama_versi}}</option>
                    @endif
                    <option value="{{$versi->id}}">{{$versi->nama_versi}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button class="btn b-primary" type="submit">Tambah</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endsection