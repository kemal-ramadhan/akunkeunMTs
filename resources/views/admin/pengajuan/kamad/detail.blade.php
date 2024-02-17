@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    <a href="/daftar-pengajuan-keuangan/{{$pengajuan->status_bag_keuangan}}" class="btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
      </svg>
    </a>
    Daftar Pengajuan Bagian Kepala Madrasah / {{$pengajuan->nama_pengajuan}}</b>
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
                <label for="">Keterangan Pengajuan</label>
                <p>{{$pengajuan->keterangan}}</p>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="" class="badge b-primary">Status Pengaju</label>
                <h6 class="bold-text">{{$pengajuan->status_pengajuan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="" class="badge b-primary">Verifikasi Keuangan</label>
                <h6 class="bold-text">{{$pengajuan->status_bag_keuangan}}</h6>
            </div>
            <div class="col-sm-3 mb-3">
                <label for="" class="badge b-primary">Verifikasi Kepala Madrasah</label>
                <h6 class="bold-text">{{$pengajuan->status_bag_kamad}}</h6>
            </div>
        </div>
        <hr>
        <h5>Verifikasi</h5>
        <div class="row">
            <div class="col-sm-4">
                <h6 class="bold-text">Bukti Pengajuan</h6>
            </div>
            <div class="col-sm-8">
                <form action="/u_pengajuan_kamad" method="post">
                @csrf
                <input type="hidden" name="IdPengajuan" value="{{$pengajuan->id}}">
                <h6 class="bold-text">Pengaturan</h6>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="nominal" class="form-label">Nominal Pengajuan</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" value="{{$pengajuan->nominal}}" readonly>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="nominal" class="form-label">Nominal Yang Disetujui</label>
                        <input type="number" class="form-control" id="nominal" name="nominalDisetujui" required value="{{$pengajuan->nominal_diberi}}">
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan" rows="3" required>{{$pengajuan->catatan}}</textarea>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Verifikasi</label>
                        <select class="form-select" aria-label="Default select example" name="verifikasi">
                            <option value="{{$pengajuan->status_bag_kamad}}" selected>{{$pengajuan->status_bag_kamad}}</option>
                            <option value="Disetujui">Setujui</option>
                            <option value="Tolak">Tolak</option>
                        </select>
                    </div>
                    @if ($pengajuan->status_bag_kamad == 'Pengajuan')
                    <div class="col-sm-6 mb-3">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn b-primary">Perbaharui</button>
                        </div>
                    </div>
                    @endif
                </div>
                </form>
            </div>
        </div>
        <hr>
    </div>
</div>
@endsection