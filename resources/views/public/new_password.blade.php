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
                    <a class="nav-link" href="/new_password">Ubah Password</a>
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Akses Keluar
                    </a>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <form action="/new_password" method="post">
                        @csrf
                    <div class="card-body">
                        <h5 class="bold-text">Buat Password Baru</h5>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <label for="password" class="form-label">Masukan Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn b-primary">Perbaharui Password</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection