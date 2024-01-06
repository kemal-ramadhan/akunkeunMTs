@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <h2 class="text-center bold-text">Riwayat Pembayaran</h2>
        <div class="col-sm-6 mx-auto">
            <div class="text-center mb-3 mt-5">
                <a href="" class="btn">Menunggu Pembayaran</a>
                <a href="" class="btn b-primary">Proses Pemeriksaan</a>
                <a href="" class="btn">Selesai</a>
            </div>
            {{-- card --}}
            <div class="card shadow-sm" style="border: none;">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">SPP Bulan Juli</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Kelas : VII/7 Fulan bin Fulan</h6>
                            <h6 class="bold-text">Rp. 50.000,-</h6>
                            <span class="badge b-secound">Status : Sedang Diperiksa</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">SPP Bulan Juli</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Kelas : VII/7 Fulan bin Fulan</h6>
                            <h6 class="bold-text">Rp. 50.000,-</h6>
                            <span class="badge b-secound">Status : Sedang Diperiksa</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card --}}
        </div>
    </div>
</div>
@endsection