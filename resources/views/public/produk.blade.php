@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container mt-5">
        <div class="card col-sm-9 mx-auto shadow-sm" style="border: none">
            <div class="card-body">
                <div class="input-group input-group-lg mb-3">
                    <input type="text" class="form-control" placeholder="Cari Sesuatu ..." aria-label="Cari Sesuatu ..." aria-describedby="button-addon2">
                    <button class="btn b-primary" type="button" id="button-addon2">Cari</button>
                </div>

            </div>
        </div>           
    </div>

    
    {{-- categori 1 --}}
    <div class="container mt-5">
        <span class="badge b-primary mb-3">Pembayaran Bulanan</span>
        <h4 class="bold-text">Sumbangan Pembinaan Pendidikan (SPP)</h4>
        <div class="row mt-5 mb-3">
            {{-- start card--}}
            <a href="/detail-pembayaran" class="nav-link">
            <div class="col-sm-4 mb-5">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title bold-text mb-3">SPP Bulan Juli</h5>
                      <h6>Kelas : VII/7</h6>
                      <p class="card-text mb-3">Uang bulanan 1 (Satu) tahun pelajaran 12x pembayaran mulai dari tahun pertama masuk pada bulan juli semester 1 hingga bulan juni semester 2</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="bold-text">Rp. 50.000,-</h6>
                          <a href="/detail-pembayaran" class="btn b-primary">Bayarkan</a>
                      </div>
                    </div>
                </div>
            </div>
            </a>
            {{-- end card --}}
        </div>
    </div>

    {{-- categori 2 --}}
    <div class="container mt-5">
        <span class="badge b-primary mb-3">Rangkaian Ujian</span>
        <h4 class="bold-text">Pembayaran Rangkaian Ujian</h4>
        <div class="row mt-5 mb-3">
            {{-- start card--}}
            <div class="col-sm-4 mb-5">
                <a href="/detail-pembayaran" class="nav-link">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title bold-text mb-3">Penilaian Tengah Semester (PTS) 2024</h5>
                      <h6>Kelas : VII/7, VIII/8, IX/9</h6>
                      <p class="card-text mb-3">Pembayaran uang rangkaian ujian, Penilaian Tengah Semester (PTS 2024) Semester 2 (Dua) tahun pelajaran 2023/2024.</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="bold-text">Rp. 100.000,-</h6>
                          <a href="#" class="btn b-primary">Bayarkan</a>
                      </div>
                    </div>
                </div>
                </a>
            </div>
            {{-- end card --}}
            {{-- start card--}}
            <div class="col-sm-4 mb-5">
                <a href="/detail-pembayaran" class="nav-link">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title bold-text mb-3">Penilaian AKhir Semester (PAS) 2024</h5>
                      <h6>Kelas : VII/7, VIII/8, IX/9</h6>
                      <p class="card-text mb-3">Pembayaran uang rangkaian ujian, Penilaian Tengah Semester (PTS 2024) Semester 2 (Dua) tahun pelajaran 2023/2024.</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <h6 class="bold-text">Rp. 150.000,-</h6>
                          <a href="#" class="btn b-primary">Bayarkan</a>
                      </div>
                    </div>
                </div>
                </a>
            </div>
            {{-- end card --}}
        </div>
    </div>
</div>
@endsection