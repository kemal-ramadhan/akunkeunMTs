@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    <a href="/daftar-pengajuan-saya/{{$pengajuan->status_pengajuan}}" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
      </svg>
    </a>
    Pengajuan Saya / {{$pengajuan->nama_pengajuan}}</b>
</h1>

<div class="card">
    <div class="card-body">
        <h5>Detail Pengajuan</h5>
        <hr>
        <div class="row">
            <div class="col-sm-3 mb-3">
                <label for="">Nama Pengaju</label>
                <h6 class="bold-text">{{$guru->nama}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Pengajuan</label>
                <h6 class="bold-text">{{$pengajuan->nama_pengajuan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Jenis</label>
                <h6 class="bold-text">{{$pengajuan->jenis_pengajuan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Tanggal Pengajuan</label>
                <h6 class="bold-text">{{$pengajuan->tanggal_pengajuan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Nominal Pengajuan</label>
                <h6 class="bold-text">{{$pengajuan->nominal}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Nominal Yang Diberi</label>
                <h6 class="bold-text">{{$pengajuan->nominal_diberi}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Keterangan Pengajuan</label>
                <h6 class="bold-text">{{$pengajuan->keterangan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Catatan Pengajuan</label>
                <h6 class="bold-text">{{$pengajuan->catatan}}</h6>
            </div>
        </div>
        <hr>
        <h5>Status</h5>
        <div class="row">
            <div class="col-sm-3 mb-3">
                <label for="">Status Pengaju</label>
                <h6 class="bold-text">{{$pengajuan->status_pengajuan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Verifikasi Keuangan</label>
                <h6 class="bold-text">{{$pengajuan->status_bag_keuangan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="">Verifikasi Kepala Madrasah</label>
                <h6 class="bold-text">{{$pengajuan->status_bag_kamad}}</h6>
            </div>
        </div>
        <hr>
        @if ($detailPengeluaran != null)
        <h5>Laporan</h5>
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Bukti Foto Produk</label><br>
                        <a href="{{asset('storage/' . $detailPengeluaran->bukti_foto)}}" class="btn b-primary" target="_blank">Lihat Bukti</a>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Bukti Pembelian/Kwitansi</label><br>
                        <a href="{{asset('storage/' . $detailPengeluaran->bukti_pembelian)}}" class="btn b-primary" target="_blank">Lihat Bukti</a>
                    </div>
                </div>
            </div>
            @if ($pengajuan->status_pengajuan == 'Pembelian')
            <div class="col-sm-8">
                <form action="/unggah_laporan" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="IdPengajuan" value="{{$pengajuan->id}}">
                    <input type="hidden" name="status" value="{{$pengajuan->status_pengajuan}}">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <label for="Bukti" class="form-label">Bukti Foto Barang (JPG/PNG/PDF)</label>
                        <input type="file" class="form-control" id="BuktiFoto" placeholder="Bukti" name="bukti_foto" accept=".pdf, .jpg, .jpeg" required>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="Bukti" class="form-label">Bukti Pembelian / Kwitansi (JPG/PNG/PDF)</label>
                        <input type="file" class="form-control" id="BuktiKwitansi" placeholder="Bukti" name="bukti_pembelian" accept=".pdf, .jpg, .jpeg" required>
                    </div>
                    <div class="d-grid gap-2 col-sm-12 mb-3">
                        <button class="btn b-primary" type="submit">Unggah Laporan</button>
                    </div>
                </div>
                </form>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>
@endsection