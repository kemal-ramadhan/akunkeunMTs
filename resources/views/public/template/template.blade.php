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
                <a class="nav-link {{ $active == 'beranda' ? 'active' : ''}}" aria-current="page" href="/">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'pembayaran' ? 'active' : ''}}" href="/produk-pembayaran">Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'keranjang' ? 'active' : ''}}" href="/keranjang">Keranjang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'riwayat' ? 'active' : ''}}" href="/riwayat/{{ $status = 'Menunggu Konfirmasi'}}">Riwayat Pembayaran</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $active == 'cicilans' ? 'active' : ''}}" href="/cicilans">Cicilan Saya</a>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 links">
              <div class="dropdown nav-item">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span style="margin-right: 5px;">{{ auth('wali')->user()->nama }}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                  </svg>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item " href="/profile">Profile</a></li>
                  <li><a class="dropdown-item" href="/riwayat/{{ $status = 'Menunggu Konfirmasi'}}">Riwayat Pembayaran</a></li>
                  <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">Akses Keluar</a></li>
                </ul>
              </div>
            </ul>
          </div>
        </div>
    </nav>
    {{-- end navbar --}}

    {{-- toast --}}
    @if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header b-primary">
                <strong class="me-auto">Pesan Sobat Akunkeun</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
    @endif

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
<!-- Logout -->
<div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
      <div class="modal-body text-center">
          <img class="mb-2 text-center" src="{{asset('assets/icons/exit.png')}}" alt="..." style="max-width: 200px;">
          <h4 class="bold-text" style="color: black">Akses Keluar!</h4>
          <p class="mb-2" style="color: black">Keluar dari akun untuk masuk akun lain!</p>
      </div>
      <div class="d-flex justify-content-center mb-3">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-right: 5px;">Batal</button>
      <form action="/logout_public" method="post">
          @csrf
          <button type="submit" class="btn b-red" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
          </button>
      </form>
      </div>
  </div>
  </div>
</div>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>