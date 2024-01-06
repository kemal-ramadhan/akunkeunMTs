@extends('public.template.template')

@section('contain')
    <div class="top-space">
        <div class="container">
            <h2 class="text-center bold-text mb-3">Keranjang Saya!</h2>
            <div class="col-sm-8 mx-auto mb-5">
                {{-- start --}}
                <div class="card mb-3 shadow-sm" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="form-check" style="margin-right: 10px;">
                                <input class="form-check-input" type="checkbox" value="" id="juli">
                            </div>
                            <div style="width: 95%;">
                                <h5 class="card-title bold-text mb-3" for="juli">SPP Bulan Juli</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Kelas : VII/7 | Rp. 50.000,- | Fulan bin Fulan A</h6>
                                    <a href="" class="badge b-red">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}
                {{-- start --}}
                <div class="card mb-3 shadow-sm" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="form-check" style="margin-right: 10px;">
                                <input class="form-check-input" type="checkbox" value="" id="juli">
                            </div>
                            <div style="width: 95%;">
                                <h5 class="card-title bold-text mb-3" for="juli">SPP Bulan Juli</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Kelas : VII/7 | Rp. 50.000,- | Fulan bin Fulan A</h6>
                                    <a href="" class="badge b-red">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}
            </div>

            <div class="col-sm-8 mx-auto mt-5">
                <div class="card mb-3 shadow-sm" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h5>Total</h5>
                                <h4 class="bold-text">Rp. 100.000,-</h4>
                            </div>
                            <div class="d-grid col-6">
                                <a href="/pembayaran" class="btn b-primary btn-lg">Bayarkan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection