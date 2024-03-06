@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Produk Langsung / {{$cicilan->nama_cicilan}}</b></h1>
<form action="/c_setSiswa" method="post">
@csrf
<div class="row">
    <div class="card col-sm-5 ml-3 mb-5 shadow-sm">
        <div class="card-body text-gray-800">
          <h5 class="mb-3"><b>Detail Data</b></h5>
          <div class="d-flex justify-content-between mb-3">
            <b>Nama Produk</b>
            <b>{{$cicilan->nama_cicilan}}</b>
            <input type="hidden" name="IdCicilanProduk" value="{{$cicilan->id}}">
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Nominal</b>
            <b>{{$cicilan->nominal}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Priode</b>
            <b>{{$cicilan->priode_awal}} s.d {{$cicilan->priode_akhir}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Keterangan</b>
            <b class="col-sm-8 text-end">{{$cicilan->keterangan}}</b>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <b>Status</b>
            <div class="col-sm-8">
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="Publish">Publikasikan</option>
                    <option value="Draf">Draf</option>
                  </select>
            </div>
          </div>
        </div>
    </div> 
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="d-flex mb-3 mt-3" style="float: right;">
            <button type="submit" class="btn b-primary"">
                Tambahkan Siswa dan Publish
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN/NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Nama Orang tua</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Keluar</th>
                        <th>Status</th>
                        <th>Pilih Siswa</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                      <th>No</th>
                      <th>NISN/NIS</th>
                      <th>Nama Lengkap</th>
                      <th>Nama Orang tua</th>
                      <th>Tahun Masuk</th>
                      <th>Tahun Keluar</th>
                      <th>Status</th>
                      <th>Pilih Siswa</th>
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
                        <td>{{$siswa->namaSiswa}}</td>
                        <td>{{$siswa->nama}}</td>
                        <td>{{$siswa->tahun_masuk}}</td>
                        <td>{{$siswa->tahun_keluar}}</td>
                        <td>{{$siswa->status}}</td>
                        <td>
                            {{-- <select class="form-select" aria-label="Default select example" name="siswa_{{$num}}">
                                <option selected>Belum Dipilih</option>
                                <option value="{{$siswa->id}}">Pilih</option>
                            </select> --}}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="siswa_{{$num}}" value="{{$siswa->id}}" id="{{$siswa->id}}">
                                <label class="form-check-label" for="{{$siswa->id}}">
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
    </div>
</div>
<input type="hidden" name="TotalSiswa" value="{{$num}}">
</form>
 @endsection