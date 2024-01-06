@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <h2 class="text-center bold-text mb-3">FORM PEMBAYARAN!</h2>
        <div class="col-sm-6 mx-auto">
            <div class="alert alert-primary" role="alert">
                Lakukan Pembayaran ke nomor rekening BJB a.n MTs At - Tarbiyah Dayeuhkolot 727212123476
            </div>
            {{-- card --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="bold-text mb-3">Detail Pembayaran</h4>
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">SPP Bulan Juli</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Kelas : VII/7 <span class="badge b-secound">Fulan bin Fulan A</span></h6>
                            <h6 class="bold-text">Rp. 50.000,-</h6>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">SPP Bulan Juli</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>Kelas : VII/7 <span class="badge b-secound">Fulan bin Fulan A</span></h6>
                            <h6 class="bold-text">Rp. 50.000,-</h6>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Nama Pengirim</label>
                        <input type="text" class="form-control" id="pengirim" placeholder="Nama Pengirim">
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="nominal" placeholder="Nominal">
                    </div>
                    <div class="mb-3">
                        <label for="Bank" class="form-label">Bank</label>
                        <input type="text" class="form-control" id="Bank" placeholder="Bank">
                    </div>
                    <div class="mb-3">
                        <label for="Bukti" class="form-label">Bukti Transfer (JPG/PNG/PDF)</label>
                        <input type="file" class="form-control" id="Bukti" placeholder="Bukti">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn b-primary" type="button">Simpan Bukti dan Bayarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection