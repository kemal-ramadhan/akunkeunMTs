@extends('public.template.template')

@section('contain')
<div class="top-space">
    <div class="container">
        <div class="card col-sm-12">
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
    </div>

    <div class="container mt-3">
        <div class="card shadow">
            <div class="card-body">
                <div class="mb-3 mt-3 float-right">
                    <!-- Button trigger modal -->
                    <a href="{{route('PembayaranCicilanPublic', ['idcicilan' => $cicilan[0]->IdProdukCicilan, 'idSiswa' => $cicilan[0]->IdSiswa])}}" class="btn b-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" style="margin-right: 5px;" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                          </svg>
                          Bayar Cicilan
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Cicilan</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Cicilan</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse ($riwayats as $riwayat)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$riwayat->nama_cicilan}}</td>
                                    <td>{{$riwayat->keterangan}}</td>
                                    <td>{{number_format($riwayat->nominal,0,',','.')}}</td>
                                    <td>{{$riwayat->tanggal_bayar}}</td>
                                    <td>{{$riwayat->status}}</td>
                                    <td>
                                        <a href="" class="badge b-primary">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection