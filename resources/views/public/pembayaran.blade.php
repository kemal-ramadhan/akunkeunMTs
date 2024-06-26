@extends('public.template.template')

@section('contain')
<div class="top-space">
    <form action="/c_pembayaran" enctype="multipart/form-data" method="post">
    @csrf
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
                    <hr>
                    @php
                        $num = 0;
                    @endphp
                    @foreach ($pembayarans as $pembayaran)
                    <div class="mb-2">
                        <h5 class="card-title bold-text mb-3">{{$pembayaran->nama_produk_pembayaran}}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="hidden" name="idPesanan_{{$num}}" value="{{$pembayaran->idPesanan}}">
                            <h6>Atas Nama : {{$pembayaran->nama}} | <span class="badge b-primary">{{$pembayaran->status}}</span></h6>
                            <h6 class="bold-text">Rp. {{number_format($pembayaran->nominal,0,',','.')}},-</h6>
                        </div>
                    </div>
                    @php
                        $num++;
                    @endphp
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between mt-3">
                        <h6 class="bold-text">Total</h6>
                        <h6 class="bold-text">Rp. {{number_format($sumTotal,0,',','.')}},-</h6>
                    </div>
                </div>
            </div>
            {{-- end card --}}
            <div class="card mt-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Nama Pengirim</label>
                        <input type="text" class="form-control" id="pengirim" placeholder="Nama Pengirim" name="nama_pengirim" required>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" class="form-control" id="nominal" placeholder="Nominal" name="nominal" value="{{$sumTotal}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="Bank" class="form-label">Bank</label>
                        <input type="text" class="form-control" id="Bank" placeholder="Bank" name="bank" required>
                    </div>
                    <div class="mb-3">
                        <label for="Bukti" class="form-label">Bukti Transfer (JPG/PNG/PDF)</label>
                        <input type="file" class="form-control" id="Bukti" placeholder="Bukti" name="bukti" accept=".pdf, .jpg, .jpeg" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan" required></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <input type="hidden" name="numPesanan" value="{{$num}}">
                        <button class="btn b-primary" type="submit">Simpan Bukti dan Bayarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection