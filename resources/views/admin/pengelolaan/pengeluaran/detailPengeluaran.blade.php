@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/detail_pengeluaran/{{$detail->id_pengeluaran}}" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Pengeluaran / {{$detail->nama_pengeluaran}}</b>
</h1>

<div class="card">
    <div class="card-body">
        <form action="/u_detail_pengeluaran" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="idDetail" value="{{$detail->id}}">
        <input type="hidden" name="idPengeluaran" value="{{$detail->id_pengeluaran}}">
        <div class="row">
            <h5>Detail Pengeluaran</h5>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="pengeluaran" class="form-label">Nama Pengeluaran</label>
                <input type="text" class="form-control" id="pengeluaran" placeholder="Pengeluaran" name="pengeluaran" value="{{$detail->nama_pengeluaran}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah" value="{{$detail->jumlah}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="satuan" placeholder="satuan" name="satuan" value="{{$detail->harga_satuan}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="Total" class="form-label">Harga Total</label>
                <input type="number" class="form-control" id="Total" placeholder="Total" name="total" value="{{$detail->total}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="tglPembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" id="tglPembelian" name="tglPembelian" value="{{$detail->tanggal_pengeluaran}}">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="kakeibo" class="form-label">Jenis Pengeluaran</label>
                <select class="form-select" aria-label="Default select example" name="kakeibo">
                    @foreach ($kakeibos as $kakeibo)
                    @if ($detail->id_kakeibo == $kakeibo->id)
                    <option value="{{$kakeibo->id}}" selected>{{$kakeibo->jenis}}</option>
                    @endif
                    <option value="{{$kakeibo->id}}">{{$kakeibo->jenis}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-12">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan">{{$detail->keterangan}}</textarea>
            </div>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="dana" class="form-label">Sumber Dana</label>
                <select class="form-select" aria-label="Default select example" name="dana">
                    @foreach ($dompets as $dompet)
                    @if ($detail->id_dompet == $dompet->id)
                    <option value="{{$dompet->id}}" selected>{{$dompet->nama_produk_pembayaran}}</option>
                    @endif
                        <option value="{{$dompet->id}}">{{$dompet->nama_produk_pembayaran}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-3">
                <label for="buktiFoto" class="form-label">Bukti Foto Barang
                    @if ($detail->bukti_foto != null)
                    <a href="{{asset('storage/' . $detail->bukti_foto)}}" class="badge b-primary" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                          </svg>
                          <span class="ml-2">Lihat Bukti</span>
                    </a>
                    @endif
                </label>
                <input type="file" class="form-control" id="buktiFoto" accept=".pdf, .jpg, .jpeg" name="bukti_foto">
                <input type="hidden" name="oldbukti_foto"  value="{{$detail->bukti_foto}}">                 
            </div>
            <div class="mb-3 col-sm-3">
                <label for="buktiFoto" class="form-label">Bukti Pembelian
                    @if ($detail->bukti_pembelian != null)
                    <a href="{{asset('storage/' . $detail->bukti_pembelian)}}" class="badge b-primary" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                          </svg>
                          <span class="ml-2">Lihat Bukti</span>
                    </a>
                    @endif
                </label>
                <input type="file" class="form-control" id="buktiFoto" accept=".pdf, .jpg, .jpeg" name="bukti_pembelian"> 
                <input type="hidden" name="oldbukti_pembelian"  value="{{$detail->bukti_pembelian}}">               
            </div>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="atasNama" class="form-label">Atas Nama</label>
                <select class="form-select" aria-label="Default select example" name="atasNama">
                    @foreach ($gurus as $guru)
                    @if ($detail->id_guru == $guru->id)
                    <option value="{{$guru->id}}" selected>{{$guru->nama}}</option>
                    @endif
                    <option value="{{$guru->id}}">{{$guru->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="status" class="form-label">Status Pengeluaran</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="{{$detail->status}}">{{$detail->status}}</option>
                    <option value="Pembelian">Pembelian</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn b-primary">Perbaharui Data</button>
        </div>
        </form>
    </div>
</div>
@endsection