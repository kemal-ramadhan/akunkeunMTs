@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/ref-produk-cicilan" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
  </a>
  <b>Data Referensi / Riwayat Pembayaran / {{$cicilan->nama_cicilan}}</b>
</h1>
<input type="hidden" name="idProdukCicilan" value="{{$cicilan->id}}">
<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="produk" class="form-label">Nama Cicilan Pembayaran</label><br>
                <h5>{{$cicilan->nama_cicilan}}</h5>
              </div>
              <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="nominal" class="form-label">Nominal</label><br>
                        <h5>{{number_format($cicilan->nominal,0,',','.')}}/siswa</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="nominal" class="form-label badge b-primary">Pendapatan</label><br>
                        <h5>{{number_format($totalCicilan,0,',','.')}}</h5>
                    </div>
                  </div>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="priodeAwal" class="form-label">Priode</label><br>
                <h5>{{$cicilan->priode_awal}} s.d {{$cicilan->priode_akhir}}</h5>
              </div>
              <div class="col-sm-6 mb-3">
                <label for="ket" class="form-label">Keterangan</label><br>
                <h5>{{$cicilan->keterangan}}</h5>
              </div>
              <div class="col-sm-6">   
                    <label for="tahun" class="form-label">Tahun Anggaran</label>
                      @foreach ($versis as $versi)
                      @if ($versi->id == $cicilan->versi)
                      <h5>{{$versi->nama_versi}} [{{$versi->status}}]</h5>
                      @endif
                    @endforeach
              </div>
              <div class="col-sm-6 mb-3">
                <label for="status" class="form-label">Status</label><br>
                <h5 class="badge b-primary">{{$cicilan->status}}</h5>
              </div>
        </div>
      <hr>
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
                    <th>Detial Pembayaran</th>
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
                    <th>Detial Pembayaran</th>
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
                        <a href="/daftar-cicilan-siswa/{{$siswa->idcheck}}" class="badge b-primary">Lihat Detail</a>
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
    </div>

    </div>
</div>
@endsection