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
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Alias quas autem ratione blanditiis saepe quia, nulla et, modi aliquid aperiam officiis nostrum eaque deleniti dolorum dignissimos ab perspiciatis est obcaecati!
            </div>
        </div>
    </div>
</div>
@endsection