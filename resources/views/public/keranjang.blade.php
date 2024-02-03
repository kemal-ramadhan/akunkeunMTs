@extends('public.template.template')

@section('contain')
    <div class="top-space">
        <form action="/c_pesanan_public" method="post">
        @csrf
        <div class="container">
            <h2 class="text-center bold-text mb-3">Keranjang Saya!</h2>
            <div class="col-sm-8 mx-auto mb-5">
                @php
                    $numcheck = 0;
                @endphp
                @forelse ($keranjangs as $keranjang)
                {{-- start --}}
                <div class="card mb-3 shadow-sm" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="form-check" style="margin-right: 10px;">
                                <input class="form-check-input" type="checkbox" value="{{$keranjang->nominal}}" id="keranjang_{{$numcheck}}" name="keranjang_{{$numcheck}}">
                            </div>
                            <div style="width: 95%;">
                                <h5 class="card-title bold-text mb-3" for="juli">{{$keranjang->nama_produk_pembayaran}}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Atas Nama : {{$keranjang->nama}} | Rp. {{number_format($keranjang->nominal,0,',','.')}},-</h6>
                                    <input type="hidden" name="idSiswa_{{$numcheck}}" value="{{$keranjang->idSiswa}}">
                                    <input type="hidden" name="nominal_{{$numcheck}}" value="{{$keranjang->nominal}}">
                                    <input type="hidden" name="idProduk_{{$numcheck}}" value="{{$keranjang->idProduk}}">
                                    <input type="hidden" name="idKeranjang_{{$numcheck}}" value="{{$keranjang->idKeranjang}}">
                                    <a href="/h_keranjang_public/{{$keranjang->idKeranjang}}" class="btn-close ml-3" style="text-decoration: none;" onclick="return confirm('Hapus Data?')"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end --}}
                @php
                    $numcheck++;
                @endphp
                @empty
                    <div class="text-center">
                        <img src="{{asset('assets/icons/emptycart.png')}}" alt="emptcart" style="max-width: 300px">
                    </div>
                @endforelse
            </div>

            <div class="col-sm-8 mx-auto mt-5">
                <div class="card mb-3 shadow-sm" style="border: none;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h5>Total</h5>
                                <h4 class="bold-text"><span id="totalNilai">0</span></h4>
                            </div>
                            <div class="d-grid col-6">
                                <input type="hidden" name="numTotal" value="{{$numcheck}}">
                                <button class="btn b-primary btn-lg" type="submit">Bayarkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <script>
        function updateTotal() {
            var total = 0;

            // Loop melalui semua checkbox
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    // Tambahkan nilai checkbox yang dicentang ke total
                    total += parseInt(checkbox.value);
                }
            });

            // Format total menjadi uang rupiah dengan titik sebagai pemisah ribuan
            var formattedTotal = total.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            // Tampilkan total yang diformat pada elemen dengan id "totalNilai"
            document.getElementById('totalNilai').innerText = formattedTotal;
        }

        // Tambahkan event listener untuk setiap checkbox
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateTotal);
        });
    </script>
@endsection