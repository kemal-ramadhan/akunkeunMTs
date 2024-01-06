@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <div class="col-sm-5 mx-auto mb-5">
            <div class="card">
                <div class="card-body">
                  <h2 class="card-title bold-text mb-3">SPP Bulan Juli</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Kelas : VII/7</h5>
                        <h5 class="bold-text">Rp. 50.000,-</h5>
                    </div>
                  <p class="card-text space-text-20 mb-3">Uang bulanan 1 (Satu) tahun pelajaran 12x pembayaran mulai dari tahun pertama masuk pada bulan juli semester 1 hingga bulan juni semester 2</p>
                  <span class="badge b-secound mb-3">Belum Dibayarkan</span>
                  <hr class="container mb-3">
                  <div class="mb-3">
                    <label for="" class="mb-3">Atas Nama Siswa</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Fulan bin Fulan A</option>
                        <option value="1">Fulan bin Fulan B</option>
                      </select>
                  </div>
                  <div class="d-grid gap-2">
                    <button class="btn b-primary" type="button">Bayarkan</button>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection