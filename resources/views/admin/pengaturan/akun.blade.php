@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    Pengaturan Akun Saya</b>
</h1>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <img src="{{asset('assets/icons/profile.svg')}}" style="max-width: 350px;" alt="" srcset="">
                </div>
            </div>
            <div class="col-sm-8">
                <h5 class="bold-text"># Profile Saya</h5>
                <hr>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="">NIK/NUPTK</label>
                        <h5 class="bold-text">{{$guru->nuptk}}</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Nama Pengguna</label>
                        <h5 class="bold-text">{{$guru->nama}}</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Jabatan</label>
                        <h5 class="bold-text">{{$guru->jabatan}}</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Tempat Lahir</label>
                        <h5 class="bold-text">{{$guru->tempat_lahir}}</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Tanggal Lahir</label>
                        <h5 class="bold-text">{{$guru->tanggal_lahir}}</h5>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Nomor Telephone</label>
                        <h5 class="bold-text">{{$guru->no_telepon}}</h5>
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <a href="/detail_akun/{{$guru->id}}" class="btn b-primary">Ubah Profile Saya</a>
                    <button type="button" class="btn b-red" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar Akun
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection