@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/ref-produk-langsung" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Referensi / Produk Langsung / {{$pembayaran->nama_produk_pembayaran}}</b>
</h1>

<div class="ml-3">
  <div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

      <form action="/u_produk_langsung" method="post">
      @csrf
      <input type="hidden" name="idProduk" value="{{$pembayaran->id}}">
      <div class="row">
        <div class="col-sm-6 mb-3">
          <label for="produk" class="form-label">Nama Pembayaran</label>
          <input type="text" class="form-control" id="produk" name="pembayaran" value="{{$pembayaran->nama_produk_pembayaran}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="text" class="form-control" id="nominal" name="nominal" value="{{$pembayaran->nominal}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAwal" class="form-label">Priode Awal</label>
          <input type="date" class="form-control" id="priodeAwal" name="priodeAwal" value="{{$pembayaran->priode_awal}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAkhir" class="form-label">Priode Akhir</label>
          <input type="date" class="form-control" id="priodeAkhir" name="priodeAkhir" value="{{$pembayaran->priode_akhir}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="ket" class="form-label">Keterangan</label>
          <textarea class="form-control" id="ket" name="keterangan" rows="3">{{$pembayaran->keterangan}}</textarea>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="ket" class="form-label">Status</label>
          <select class="form-select" aria-label="Default select example" name="status">
              <option value="{{$pembayaran->status}}" selected>{{$pembayaran->status}}</option>
              <option value="Publish">Publish</option>
              <option value="Draf">Draf</option>
            </select>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tahun" class="form-label">Tahun Anggaran</label>
          <select class="form-select" id="tahun" name="versi" aria-label="Default select example">
            @foreach ($versis as $versi)
              @if ($versi->id == $pembayaran->versi)
              <option value="{{$versi->id}}" selected>{{$versi->nama_versi}} [{{$versi->status}}]</option>
              @endif
              <option value="{{$versi->id}}">{{$versi->nama_versi}} [{{$versi->status}}]</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="text-center mt-3">
        <a href="/ref-produk-langsung" class="btn b-red">Kembali</a>
        <button type="submit" class="btn b-primary">Simpan & Perbaharui</button>
      </div>
    </form>
    </div>
  </div>
    
    <div class="card col-sm-12 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-3"><b>Atur Kelas</b></h5>
                <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  + Tambah Kelas
                </button>
            </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($hubKelass as $hubKelas)
                <tr>
                  <td scope="row">{{$loop->iteration}}</td>
                  <td>{{$hubKelas->kelas_romawi_angka_abjad}} - {{$hubKelas->nama_kelas}}</td>
                  <td>
                    <form action="/h_hubKelasDetail/{{$hubKelas->id}}" method="post">
                        @method('delete')
                        @csrf
                        <input id="" type="hidden" value="{{$pembayaran->id}}" name="IdPembayaran">
                        <span>
                            <button class="btn b-red" onclick="return confirm('Hapus Data?')">Hapus</button>
                        </span>
                    </form>
                  </td>
                </tr>
                @empty
                    <div class="text-center">
                        <h5>Produk Belum Dihubungkan!</h5>
                        <p>Hubungkan Pembayaran Dengan Kelas, dengan meng-klik tombol "+ Tambah Kelas"!</p>
                    </div>
                @endforelse
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_hub_kelas_detail" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="tahun" class="form-label">Kelas</label>
            <input type="hidden" name="idPembayaran" value="{{$pembayaran->id}}">
            <select class="form-select" aria-label="Default select example" name="kelas">
                @foreach ($kelass as $kelas)
                <option value="{{$kelas->id}}">{{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn b-primary">Tambah Kelas</button>
        </div>
        </div>
        </form>
    </div>
  </div>
@endsection