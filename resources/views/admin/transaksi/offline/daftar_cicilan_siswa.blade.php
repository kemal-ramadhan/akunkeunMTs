@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi Cicilan / Pembayaran / {{$siswa[0]->nama}}</b></h1>

<div class="row">
        {{-- start card--}}
    <div class="col-sm-4 mb-3">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title bold-text mb-3">{{$cicilan[0]->nama_cicilan}}</h5>
            <p class="card-text mb-3">{{$cicilan[0]->keterangan}}</p>
            <p class="card-text mb-3">Priode : {{$cicilan[0]->priode_awal}} s.d {{$cicilan[0]->priode_akhir}}</p>
            <h5>Cicilan : {{number_format($cicilan[0]->nominal,0,',','.')}}</h5>
            <span class="badge b-primary">{{$cicilan[0]->status}}</span>
                <div class="d-flex justify-content-between align-items-center">
                    <input id="" type="hidden" value="{{$siswa[0]->id}}" name="idSiswa">
                    <input id="" type="hidden" value="{{$cicilan[0]->nominal}}" name="nominal">
                </div>
            </div>
        </div>
    </div>
    {{-- end card --}}
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p class="card-text mb-3 badge b-primary">Uang Yang telah Dibayarkan</p>
                <h5 class="card-title bold-text mb-3">{{number_format($totalBayar,0,',','.')}}</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                @php
                    $bayar = $totalBayar;
                    $wajib  = $cicilan[0]->nominal;

                    $hasil = $wajib - $totalBayar;
                @endphp
                <p class="card-text mb-3 badge b-red">Sisa Yang Harus Dibayarkan</p>
                <h5 class="card-title bold-text mb-3">{{number_format($hasil,0,',','.')}}</h5>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="mb-3 mt-3 float-right">
            <button class="btn btn-primary">Cetak Bukti Pembayaran</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Cicilan
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cicilan</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Cicilan</th>
                        <th>Keterangan</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($riwayats as $riwayat)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$riwayat->nama_cicilan}}</td>
                            <td>{{$riwayat->keterangan}}</td>
                            <td>{{number_format($riwayat->nominal,0,',','.')}}</td>
                            <td>{{$riwayat->tanggal_bayar}}</td>
                            <td>{{$riwayat->status}}</td>
                            <td>
                                <a href="" class="badge b-primary">Detail</a>
                                <a href="" class="badge b-red">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran Cicilan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_cicilans" method="POST">
        @csrf
        <input type="hidden" name="idProduk" value="{{$cicilan[0]->id}}">
        <input type="hidden" name="idSiswa" value="{{$siswa[0]->id}}">
        <input type="hidden" name="IdCicilan" value="{{$cicilan[0]->IdCicilan}}">
        <div class="modal-body">
            <b>Pembayaran Atas Nama : {{$siswa[0]->nama}}</b>
            <hr>
          <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="nama" class="form-label">Nama Pembayaran</label>
                <input type="text" class="form-control" id="nama" readonly name="produk" value="{{$cicilan[0]->nama_cicilan}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="ket" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="ket" name="keterangan">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="nominal" class="form-label">Uang Bayar</label>
                <input type="text" class="form-control" id="nominal" name="nominal">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="tglBayar" class="form-label">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tglBayar" name="tglBayar">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="status" class="form-label">Status Pemabayarn</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="Cicilan">Cicilan</option>
                    <option value="Selesai">Pelunasan</option>
                </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn b-primary">Simpan Dan Bayarkan</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection