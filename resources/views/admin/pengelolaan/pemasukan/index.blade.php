@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Pemasukan</b></h1>

<div class="card mb-3 col-sm-12">
    <div class="card-body">
        {!! $chart->container() !!}
    </div>
</div>

<form action="/search_pemasukan" method="post">
    @csrf
<div class="card mb-3">
    <div class="card-body">
        <h5 class="bold-text">Filter Data</h5>
        <hr>
        <div class="row">
            <div class="col-sm-2 mb-3">
                <label for="mulai" class="form-label">Mulai Dari</label>
                <input type="date" class="form-control" id="mulai" name="mulai">
            </div>
            <div class="col-sm-2 mb-3">
                <label for="sampai" class="form-label">Sampai</label>
                <input type="date" class="form-control" id="sampai" name="sampai">
            </div>
            <div class="col-sm-4 mb-3">
                <label for="dari" class="form-label">Pemasukan Dari</label>
                <select class="form-select" aria-label="Default select example" name="dana">
                    <option selected>-- Pilih Pemasukan --</option>
                    @foreach ($pembayarans as $pembayaran)
                    <option value="{{$pembayaran->id}}">{{$pembayaran->nama_produk_pembayaran}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 mb-3 d-flex align-items-end">
                <button class="btn b-secound mr-2" type="submit" name="aksi" value="cari">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                      <span class="ml-2">Cari Data</span>
                </button>
                <button type="submit" class="btn b-primary mr-2" name="aksi" value="excel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z"/>
                      </svg>
                      <span class="ml-2">Export Data Ke Excel</span>
                </button>
                <button type="submit" class="btn b-red mr-2" name="aksi" value="pdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                      </svg>
                      <span class="ml-2">Print PDF</span>
                </button>
            </div>
        </div>
    </div>
</div>
</form>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pemasukan</th>
                        <th>Keterangan</th>
                        <th>Dari</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pemasukan</th>
                        <th>Keterangan</th>
                        <th>Dari</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($pemasukans as $pemasukan)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pemasukan->tanggalPemasukan}}</td>
                        <td>{{$pemasukan->nama_produk_pembayaran}}</td>
                        <td>{{$pemasukan->nama}}</td>
                        <td>{{number_format($pemasukan->nominal,0,',','.')}}</td>
                        <td>{{$pemasukan->status}}</td>
                    </tr>
                    @empty
                    <div class="alert alert-danger text-center" role="alert">
                        <h5>Data Tidak Ditemukan</h5>
                        <p>Cari data lain mungkin anda salah memasukan input!</p>
                      </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@endsection