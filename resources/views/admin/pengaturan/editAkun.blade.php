@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>
    Pengaturan Akun Saya</b>
</h1>

<form action="/u_profile_admin" method="post">
@csrf
<input type="hidden" name="idGuru" value="{{$guru->id}}">
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
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nuptk" value="{{$guru->nuptk}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Nama Pengguna</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nama" value="{{$guru->nama}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Tempat Lahir</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="tempat" value="{{$guru->tempat_lahir}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tglLahir" value="{{$guru->tanggal_lahir}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{$guru->email}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Nomor Telephone</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="noTlp" value="{{$guru->no_telepon}}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="">Password Baru</label>
                        <input type="password" class="form-control" id="exampleFormControlInput1" name="newPassword">
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    <button type="submit" class="btn b-primary">Perbaharui</button>
                    <a href="/pengaturan" class="btn b-red">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection