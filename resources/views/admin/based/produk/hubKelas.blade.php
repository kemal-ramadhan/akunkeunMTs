@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Produk Langsung / {{$pembayaran->nama_produk_pembayaran}}</b></h1>

<div class="container row">
    <div class="card col-sm-5 mr-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <h5 class="mb-3"><b>Detail Data</b></h5>
          <div class="d-flex justify-content-between mb-3">
            <b>Nama Produk</b>
            <b>{{$pembayaran->nama_produk_pembayaran}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Nominal</b>
            <b>{{$pembayaran->nominal}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Priode</b>
            <b>{{$pembayaran->priode_awal}} s.d {{$pembayaran->priode_akhir}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Keterangan</b>
            <b class="col-sm-8 text-end">{{$pembayaran->keterangan}}</b>
          </div>
        </div>
    </div>
    
    <div class="card col-sm-6 mb-5 shadow-sm">
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
                    <form action="/h_hubKelas/{{$hubKelas->id}}" method="post">
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
          <form action="/u_pembayaran" method="POST">
            @csrf
            <input type="hidden" name="idProduk" value="{{$pembayaran->id}}">
          <div class="mb-3 mt-3">
            <select class="form-select" aria-label="Default select example" name="status">
                <option value="Publish" selected>Publish</option>
                <option value="Belum Publish">Belum Publish</option>
              </select>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn b-primary">Simpan & Perbaharui</button>
          </div>
        </form>
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
        <form action="/c_hub_kelas" method="post">
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