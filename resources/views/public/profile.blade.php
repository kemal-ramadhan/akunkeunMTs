@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="bold-text mb-4">Layanan</h5>
                <div class="space-text-30">
                    <a class="nav-link" href="/produk-pembayaran">Pembayaran</a>
                    <a class="nav-link" href="/keranjang">Keranjang</a>
                    <a class="nav-link" href="/riwayat/{{ $status = 'Menunggu Konfirmasi'}}">Riwayat Pembayaran</a>
                    <a class="nav-link" href="/cicilans">Cicilan Saya</a>
                </div>
                
                <h5 class="bold-text mt-5 mb-4">Pengaturan</h5>
                <div class="space-text-30">
                    <a class="nav-link" href="/produk-pembayaran">Akun Saya</a>
                    <a class="nav-link" href="/produk-pembayaran">Siswa / Anak Saya</a>
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Akses Keluar
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <form action="/u_profile_public" method="post">
                        @csrf
                        <input type="hidden" name="idMy" value="{{$biodata->id}}">
                    <div class="card-body">
                        <h5 class="bold-text">Biodata</h5>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" value="{{$biodata->nama}}" name="nama">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" value="{{$biodata->username}}" name="username">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{$biodata->email}}" name="email">
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="telp" class="form-label">No Telepon</label>
                                <input type="text" class="form-control" id="telp" value="{{$biodata->no_telepon}}" name="notlp">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" rows="3" name="alamat">{{$biodata->alamat}}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn b-primary">Perbaharui Data</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="bold-text">Wali Dari</h5>
                        <hr>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kelas</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                <tr>
                                  <th scope="row">{{$loop->iteration}}</th>
                                  <td>{{$siswa->nama}}</td>
                                  <td>{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection