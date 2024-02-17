@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <h2 class="text-center bold-text">Riwayat Pembayaran</h2>
        <div class="col-sm-6 mx-auto">
            <div class="text-center mb-3 mt-5">
                <a href="/riwayat/{{ $status = 'Pembayaran'}}" class="btn {{ $activeStatus == 'Pembayaran' ? 'b-primary' : ''}}">Menunggu Pembayaran</a>
                <a href="/riwayat/{{ $status = 'Menunggu Konfirmasi'}}" class="btn {{ $activeStatus == 'Menunggu Konfirmasi' ? 'b-primary' : ''}}">Proses Pemeriksaan</a>
                <a href="/riwayat/{{ $status = 'Telah Dibayarkan'}}" class="btn {{ $activeStatus == 'Telah Dibayarkan' ? 'b-primary' : ''}}">Selesai</a>
            </div>
            @forelse ($riwayats as $riwayat)
            {{-- card --}}
            <div class="card shadow-sm" style="border: none;">
                <div class="card-body">
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">{{$riwayat->nama_produk_pembayaran}}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Atas Nama : {{$riwayat->nama}}</h6>
                            <h6 class="bold-text">Rp. {{number_format($riwayat->nominal,0,',','.')}},-</h6>
                            <span class="badge b-secound">Status : {{$riwayat->status}}</span>
                        </div>
                        @if ($activeStatus == 'Pembayaran')
                        <div class="d-grid gap-2 mt-3">
                            <a href="/pembayaran" class="btn b-primary">Bayarkan</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- end card --}}
            @empty
            <div class="text-center">
                <img src="{{asset('assets/icons/emptycart.png')}}" alt="emptcart" style="max-width: 300px">
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection