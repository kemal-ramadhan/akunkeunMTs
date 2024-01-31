@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/ref-produk-cicilan" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
  </a>
  <b>Data Referensi / Produk Cicilan Pembayaran / {{$cicilan->nama_cicilan}}</b>
</h1>
<form action="/u_detail_cicilan" method="post">
@csrf
<input type="hidden" name="idProdukCicilan" value="{{$cicilan->id}}">
<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

      <div class="row">
        <div class="col-sm-6 mb-3">
          <label for="produk" class="form-label">Nama Cicilan Pembayaran</label>
          <input type="text" class="form-control" id="produk" name="cicilan" value="{{$cicilan->nama_cicilan}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="text" class="form-control" id="nominal" name="nominal" value="{{$cicilan->nominal}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAwal" class="form-label">Priode Awal</label>
          <input type="date" class="form-control" id="priodeAwal" name="priodeAwal" value="{{$cicilan->priode_awal}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAkhir" class="form-label">Priode Akhir</label>
          <input type="date" class="form-control" id="priodeAkhir" name="priodeAkhir" value="{{$cicilan->priode_akhir}}">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="ket" class="form-label">Keterangan</label>
          <textarea class="form-control" id="ket" name="keterangan" rows="3">{{$cicilan->keterangan}}</textarea>
        </div>
        <div class="col-sm-6">   
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <label for="tahun" class="form-label">Tahun Anggaran</label>
                    <select class="form-select" id="tahun" name="versi" aria-label="Default select example">
                    @foreach ($versis as $versi)
                    @if ($versi->id == $cicilan->versi)
                    <option value="{{$versi->id}}" selected>{{$versi->nama_versi}} [{{$versi->status}}]</option>
                    @endif
                    <option value="{{$versi->id}}">{{$versi->nama_versi}} [{{$versi->status}}]</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="{{$cicilan->status}}" selected>{{$cicilan->status}}</option>
                        <option value="Publish">Publikasikan</option>
                        <option value="Draf">Draf</option>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <hr>
        <div class="d-flex justify-content-between mb-3">
            <h4>Daftar Siswa Pembayaran</h4>
            <a href="/add_hub_siswa/{{$cicilan->id}}" class="btn b-primary">+ Tambah Siswa Baru</a>
        </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN/NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Tahun Masuk</th>
                    <th>Status CIcilan</th>
                    <th>Status</th>
                    <th>Hapus Dari Daftar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>NISN/NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Tahun Masuk</th>
                    <th>Status CIcilan</th>
                    <th>Status</th>
                    <th>Hapus Dari Daftar</th>
                </tr>
            </tfoot>
            <tbody>
                @php
                    $num = 0;
                @endphp
              @foreach ($siswas as $siswa)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$siswa->nisn}}/{{$siswa->nis}}</td>
                    <td>{{$siswa->nama}}</td>
                    <td>{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</td>
                    <td>{{$siswa->tahun_masuk}}</td>
                    <td>{{$siswa->statusCicilan}}</td>
                    <td>{{$siswa->status}}</td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="siswa_{{$num}}" value="{{$siswa->idcheck}}" id="{{$siswa->idcheck}}" onclick="return confirm('Apakah anda yakin memilih siswa ini untuk dihapus dari daftar cicilan?')">
                            <label class="form-check-label" for="{{$siswa->idcheck}}">
                                Pilih
                            </label>
                        </div>
                    </td>
                  </tr>
                  @php
                      $num++;
                  @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <input type="hidden" name="TotalSiswa" value="{{$num}}">
    <div class="text-center mt-3">
        <a href="/ref-produk-cicilan" class="btn b-red">Kembali </a>
        <button type="submit" class="btn b-primary">Perbaharui</button>
    </div>

    </div>
</div>
</form>
@endsection