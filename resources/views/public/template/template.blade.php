<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Akunkeun MTs At - Tarbiyah Dayeuhkolot</title>

    {{-- ficon --}}
    <link rel="shortcut icon" href="{{asset('assets/icons/akunkeun.png')}}" type="image/x-icon">

    {{-- asset --}}
    <link rel="stylesheet" href="{{asset('assets/vanila/Css/main.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.min.css')}}">
</head>
<body>
    
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
          <a class="navbar-brand" href="#"><b class="color-secound">AKUN</b><b class="color-primary">KEUN</b></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 links">
              <li class="nav-item">
                <a class="nav-link {{ $active == 'beranda' ? 'active' : ''}}" aria-current="page" href="/beranda">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'pembayaran' ? 'active' : ''}}" href="/produk-pembayaran">Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'keranjang' ? 'active' : ''}}" href="/keranjang">Keranjang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'riwayat' ? 'active' : ''}}" href="/riwayat">Riwayat Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'cicilan' ? 'active' : ''}}" href="/cicilan
                ">Cicilan Saya</a>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 links">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#">
                    <b>Kemal Ramadhan</b>
                    <img src="{{asset('assets/icons/user.png')}}" alt="avatar" style="max-width: 20px; margin-left: 10px">
                  </a>
                </li>
            </ul>
          </div>
        </div>
    </nav>
    {{-- end navbar --}}

    {{-- content --}}
    @yield('contain')
    {{-- end content --}}

{{-- Footer --}}
<div class="bg-footer">
    <div class="container color-white">
        <div class="row">
          {{-- state1 --}}
          <div class="col-lg-6">
            <div class="row">
              <div class="col-sm-6">
                  <div class="d-flex align-items-center justify-content-between">
                    <h5><b class="color-secound">AKUN</b><b class="color-primary">KEUN</b></h5>
                  </div>
                  <p class="small mt-3 space-text-20">Akunkeun atau Aplikasi Kegiatan dan Urusan Keuangan adalah sebuah aplikasi yang dirancang untuk memudahkan proses pembayaran uang sekolah di MTs At - Tarbiyah Dayeuhkolot serta pengelolaan keuangan di sekolah.</p>
              </div>
              <div class="col-sm-6 mb-3">
                  <h5 class="fw-bold">Layanan</h5>
                  <ul class="list-group text-secondary mt-3">
                      <li class="list-group-item small small"><a href="" class="nav-link">Beranda</a></li>
                      <li class="list-group-item small"><a href="" class="nav-link">Pembayaran</a></li>
                      <li class="list-group-item small"><a href="" class="nav-link">Keranjang</a></li>
                      <li class="list-group-item small"><a href="" class="nav-link">Riwayat Pembayaran</a></li>
                      <li class="list-group-item small"><a href="" class="nav-link">Cicilan Saya</a></li>
                    </ul>
              </div>
            </div>
          </div>
          {{-- state2 --}}
          <div class="col-lg-6">
            <div class="row">
              <div class="col-sm-6 mb-3">
                  <h5 class="fw-bold">Link</h5>
                  <ul class="list-group text-secondary mt-3">
                      <li class="list-group-item small small"><a href="" class="nav-link">Instagram : @MTs AT - Tarbiyah</a></li>
                      <li class="list-group-item small small"><a href="" class="nav-link">Facebook : @MTs AT - Tarbiyah</a></li>
                  </ul>
              </div>
              <div class="col-sm-6">
                  <h5 class="fw-bold">Informasi Kontak</h5>
                  <div class="row small">
                    <div class="col-sm-12 mb-2">
                      Phone: +628986004677
                    </div>
                    <div class="col-sm-12 mb-2">
                      Email: mtsattarbiyah666@gmaial.com
                    </div>
                    <div class="col-sm-12 mb-2 space-text-20">
                      Kp. Sayuran No 118 Desa Cangkuang Kulon Kecamatan Dayeuhkolot Kabupaten Bandung
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <hr class="container mt-5">
    <div class="container mb-3 text-center">
        <p class="small">copyright @2024, Akunkeun - Aplikasi Kegiatan dan Urusan Keuangan</p>
    </div>
</div>

<script src="{{asset('vendor/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>