@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Produk Langsung / Tambah Baru</b></h1>

<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

      <form action="/c_produk_langsung" method="post">
      @csrf
      <div class="row">
        <div class="col-sm-6 mb-3">
          <label for="produk" class="form-label">Nama Pembayaran</label>
          <input type="text" class="form-control" id="produk" name="pembayaran" placeholder="Nama Pembayaran">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="nominal" class="form-label">Nominal</label>
          <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal Pembayaran">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAwal" class="form-label">Priode Awal</label>
          <input type="date" class="form-control" id="priodeAwal" name="priodeAwal" placeholder="Priode Awal Pembayaran">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="priodeAkhir" class="form-label">Priode Akhir</label>
          <input type="date" class="form-control" id="priodeAkhir" name="priodeAkhir" placeholder="Priode Akhir Pembayaran">
        </div>
        <div class="col-sm-6 mb-3">
          <label for="ket" class="form-label">Keterangan</label>
          <textarea class="form-control" id="ket" name="keterangan" rows="3"></textarea>
        </div>
        <div class="col-sm-6 mb-3">
          <label for="tahun" class="form-label">Tahun Anggaran</label>
          <select class="form-select" id="tahun" name="versi" aria-label="Default select example">
            @foreach ($versis as $versi)
            @if ($versi->status == 'Aktif')
            <option value="{{$versi->id}}" selected>{{$versi->nama_versi}} [{{$versi->status}}]</option>
            @endif
            <option value="{{$versi->id}}">{{$versi->nama_versi}} [{{$versi->status}}]</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="text-center mt-3">
        <a href="/ref-produk-langsung" class="btn b-red">Batal</a>
        <button type="submit" class="btn b-primary">Selanjutnya</button>
      </div>
      </form>
    
    </div>
</div>


@endsection