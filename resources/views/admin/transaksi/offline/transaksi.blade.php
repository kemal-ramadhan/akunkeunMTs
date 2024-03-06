@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi / {{$siswa->nama}}</b></h1>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h5>Pembayaran Siswa</h5>
                    <div class="row mt-3">
                        @foreach ($produklangsungs as $produklangsung)
                            @php
                                $adaPasanganSama = false; // Variabel penanda
                            @endphp
                            @foreach ($riwayats as $riwayat)
                                @if ($riwayat->id_produk_langsung == $produklangsung->IdProdukLangsung)
                                    @php
                                      $adaPasanganSama = true; // Ada pasangan yang sama
                                    @endphp
                                    {{-- start card--}}
                                    <div class="col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title bold-text mb-3">{{$produklangsung->nama_produk_pembayaran}}</h5>
                                            @foreach ($kelass as $kelas)
                                                @if ($produklangsung->IdProdukLangsung == $kelas->IdProduk)
                                                    <span class="badge b-primary mb-3">
                                                        {{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}
                                                    </span>
                                                @endif
                                            @endforeach
                                            <p class="card-text mb-3">{{$produklangsung->keterangan}}</p>
                                            <form action="/c_keranjang/{{$produklangsung->IdProdukLangsung}}" method="post">
                                                @csrf
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <input id="" type="hidden" value="{{$siswa->id}}" name="idSiswa">
                                                    <input id="" type="hidden" value="{{$produklangsung->nominal}}" name="nominal">
                                                    <h6 class="bold-text">Rp. {{number_format($produklangsung->nominal,0,',','.')}}</h6>
                                                    <span class="btn b-red">Sudah Membayar</span>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end card --}}
                                @endif
                            @endforeach
                            @if (!$adaPasanganSama)
                            {{-- start card--}}
                            <div class="col-sm-6 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                    <h5 class="card-title bold-text mb-3">{{$produklangsung->nama_produk_pembayaran}}</h5>
                                    @foreach ($kelass as $kelas)
                                        @if ($produklangsung->IdProdukLangsung == $kelas->IdProduk)
                                            <span class="badge b-primary mb-3">
                                                {{$kelas->kelas_romawi_angka_abjad}} - {{$kelas->nama_kelas}}
                                            </span>
                                        @endif
                                    @endforeach
                                    <p class="card-text mb-3">{{$produklangsung->keterangan}}</p>
                                    <form action="/c_keranjang/{{$produklangsung->IdProdukLangsung}}" method="post">
                                        @csrf
                                        <div class="d-flex justify-content-between align-items-center">
                                            <input id="" type="hidden" value="{{$siswa->id}}" name="idSiswa">
                                            <input id="" type="hidden" value="{{$produklangsung->nominal}}" name="nominal">
                                            <h6 class="bold-text">Rp. {{number_format($produklangsung->nominal,0,',','.')}}</h6>
                                            <button type="submit" class="btn b-primary" onclick="return confirm('Konfirmasi Pilihan Pembayaran?')">Keranjang</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- end card --}}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5>Biodata</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <b>Atas Nama</b>
                        <b>{{$siswa->nama}}</b>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b>Kelas</b>
                        <b>{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</b>
                    </div>
                    <hr>
                    <h5>Keranjang</h5>
                    <hr>
                    @forelse ($keranjangs as $keranjang)
                    <div class="d-flex justify-content-between mb-3">
                        <b>{{$keranjang->nama_produk_pembayaran}}</b>
                        <div class="d-flex">
                            <b>{{$keranjang->nominal}}</b>
                            <form action="/h_keranjang/{{$keranjang->id}}" method="post">
                                @method('delete')
                                @csrf
                                <input id="" type="hidden" value="{{$siswa->id}}" name="idSiswa">
                                <span>
                                    <button class="btn-close ml-3" style="text-decoration: none;" onclick="return confirm('Hapus Data?')"></button>
                                </span>
                            </form>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-danger" role="alert">
                        Belum Ada data dikeranjang!
                        </div>
                    @endforelse
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <h5>Total</h5>
                        <h5>{{number_format($sumkeranjang,0,',','.')}}</h5>
                    </div>
                    <hr>
                    <form action="/u_set_keranjang" method="post">
                    @csrf
                    <input id="" type="hidden" value="{{$siswa->id}}" name="idSiswa">
                    <div class="d-grid gap-2">
                        @if ($keranjangs->isEmpty())
                        <span class="btn btn b-red" onclick="return confirm('Tambah Terlebih Dahulu Pembayaran!')">Keranjang Kosong</span>
                        @else
                        <button class="btn b-primary" type="submit" onclick="return confirm('Apakah Sudah Semuanya?')">Bayarkan</button>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection