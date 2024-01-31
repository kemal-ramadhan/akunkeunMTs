@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Transaksi / Checkout / {{$siswa[0]->nama}}</b></h1>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5>Checkout Pembayaran</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <b>Atas Nama</b>
                        <b>{{$siswa[0]->nama}}</b>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <b>Kelas</b>
                        <b>{{$siswa[0]->kelas_romawi_angka_abjad}} - {{$siswa[0]->nama_kelas}}</b>
                    </div>
                    <hr>
                    <h5>Keranjang</h5>
                    <hr>
                    <form action="/u_end_keranjang" method="post" id="formD" name="formD">
                    @csrf
                    @php
                        $num = 0;
                    @endphp
                    @forelse ($keranjangs as $keranjang)
                    <div class="d-flex justify-content-between mb-3">
                        <input type="hidden" name="idProduk_{{$num}}" value="{{$keranjang->idProduk}}">
                        <input type="hidden" name="idKeranjang_{{$num}}" value="{{$keranjang->id}}">
                        <input type="hidden" name="nominal_{{$num}}" value="{{$keranjang->nominal}}">
                        <b>{{$keranjang->nama_produk_pembayaran}}</b>
                        <b>{{$keranjang->nominal}}</b>
                    </div>
                    @php
                        $num++;
                    @endphp
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
                    <div class="mb-3">
                        <input id="" type="hidden" value="{{$sumkeranjang}}" name="nominal" id="nominal">
                        <label for="uangbayar" class="form-label">Uang Bayar</label>
                        <input type="text" class="form-control" id="uangbayar" name="uangbayar" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)" placeholder="Masukan Nominal" required>
                    </div>
                    <div class="mb-3">
                        <label for="kembalian" class="form-label">Uang Kembalian</label>
                        <input type="text" class="form-control" id="kembalian" name="kembalian" readonly>
                    </div>
                    <input type="hidden" name="totalProduk" value="{{$num}}">
                    <input id="" type="hidden" value="{{$siswa[0]->id}}" name="idSiswa">
                    <div class="d-grid gap-2">
                        <button class="btn b-primary" type="submit" onclick="return confirm('Apakah Sudah Sesuai?')">Selesai dan Bayarkan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="Javascript">
    nominal = document.formD.nominal.value;
    document.formD.kembalian.value = total;
    bayar_uang = document.formD.uangbayar.value;
    document.formD.kembalian.value = bayar_uang;
    function OnChange(value){
      total = document.formD.nominal.value;
      bayar_uang = document.formD.uangbayar.value;
      ts = bayar_uang - total;
      document.formD.kembalian.value = ts;
    }
</script>
@endsection