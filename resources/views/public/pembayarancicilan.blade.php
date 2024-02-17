@extends('public.template.template')

@section('contain')
<div class="top-space">
<form action="/c_pembayaran_cicilan_public" enctype="multipart/form-data" method="post">
    @csrf
    <input type="hidden" name="idProdukCicilan" value="{{$cicilan[0]->IdProdukCicilan}}">
    <input type="hidden" name="idSiswa" value="{{$cicilan[0]->IdSiswa}}">
    <div class="container">
        <h4 class="text-center bold-text mb-3">Form Pembayaran Cicilan</h4>
        <div class="card col-sm-8 mx-auto">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="card-title bold-text mb-3">{{$cicilan[0]->nama_cicilan}}</h5>
                        <p class="card-text mb-3">{{$cicilan[0]->keterangan}}</p>
                        <p class="card-text mb-3">Priode : {{$cicilan[0]->priode_awal}} s.d {{$cicilan[0]->priode_akhir}}</p>
                        <h5>Cicilan : {{number_format($cicilan[0]->nominal,0,',','.')}}</h5>
                        <span class="badge b-primary">{{$cicilan[0]->status}}</span>    
                    </div>
                    <div class="col-3">
                        <p class="card-text mb-3 badge b-primary">Uang Yang telah Dibayarkan</p>
                        <h5 class="card-title bold-text mb-3">{{number_format($totalBayar,0,',','.')}}</h5>
                    </div>
                    <div class="col-sm-3">
                        @php
                            $bayar = $totalBayar;
                            $wajib  = $cicilan[0]->nominal;
        
                            $hasil = $wajib - $totalBayar;
                        @endphp
                        <p class="card-text mb-3 badge b-red">Sisa Yang Harus Dibayarkan</p>
                        <h5 class="card-title bold-text mb-3">{{number_format($hasil,0,',','.')}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-primary col-sm-8 mt-3 mx-auto" role="alert">
            Lakukan Pembayaran ke nomor rekening BJB a.n MTs At - Tarbiyah Dayeuhkolot 727212123476
        </div>
        <div class="card col-sm-8 mt-3 mx-auto">
            <div class="card-body">
                <div class="mb-3">
                    <label for="pengirim" class="form-label">Nama Pengirim</label>
                    <input type="text" class="form-control" id="pengirim" placeholder="Nama Pengirim" name="nama_pengirim" required>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="text" class="form-control" id="nominal" placeholder="Nominal" name="nominal" required>
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
                    <button class="btn b-primary" type="submit">Simpan Bukti dan Bayarkan</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection