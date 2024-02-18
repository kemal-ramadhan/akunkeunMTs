@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
  <a href="/pengeluaran" class="btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
  </svg>
</a>
  <b>Data Pengeluaran / {{$pengeluaran->nama_pengeluaran}}</b>
</h1>


<div class="card mb-3">
    <div class="card-body">
        <div class="col-sm-12">
            <b>Detail Pengeluaran</b>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Kategori Pengeluaran</label>
                    <h6 class="bold-text">{{$pengeluaran->nama_pengeluaran}}</h6>
                </div>
                <div class="col-sm-2">
                    <label for="">Tahun Anggaran</label>
                    <h6 class="bold-text">{{$pengeluaran->nama_versi}}</h6>
                </div>
                <div class="col-sm-4">
                    <label for="">Keterangan</label>
                    <p>{{$pengeluaran->keterangan}}</p>
                </div>
                <div class="col-sm-1">
                    <label for="" class="badge b-primary">Status</label>
                    <h6 class="bold-text">{{$pengeluaran->status}}</h6>
                </div>
                <div class="col-sm-2">
                    <label for="" class="badge b-red">Total Pengeluaran</label>
                    <h5 class="bold-text">{{number_format($totalKeseluruhan,0,',','.')}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3 col-sm-12">
    <div class="card-body">
        {!! $kakeiboBar->container() !!}
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        
        <div class="d-flex mb-3 flex-row-reverse">
            <button type="button" class="btn b-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
                    <path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>
                  </svg>
                <span class="ml-2">Tambah Pengeluaran</span>
            </button>
            <a href="/unduh_lap_exel/{{$pengeluaran->id}}" class="btn b-primary mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z"/>
                  </svg>
                  <span class="ml-2">Export Data Ke Excel</span>
            </a>
            <a href="/unduh_lap/{{$pengeluaran->id}}" class="btn b-red mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                  </svg>
                  <span class="ml-2">Print PDF</span>
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pengeluaran</th>
                        <th>Kategori</th>
                        <th>Atas Nama</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th>Sumber Dana</th>
                        <th>Bukti Foto</th>
                        <th>Bukti Pembelian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Pengeluaran</th>
                        <th>Kategori</th>
                        <th>Atas Nama</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th>Sumber Dana</th>
                        <th>Bukti Foto</th>
                        <th>Bukti Pembelian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse ($detailPengeluarans as $detailPengeluaran)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$detailPengeluaran->tanggal_pengeluaran}}</td>
                            <td>{{$detailPengeluaran->nama_pengeluaran}}</td>
                            <td>{{$detailPengeluaran->jenis}}</td>
                            <td>{{$detailPengeluaran->atas_nama}}</td>
                            <td>{{$detailPengeluaran->jumlah}}</td>
                            <td>{{number_format($detailPengeluaran->harga_satuan,0,',','.')}}</td>
                            <td>{{number_format($detailPengeluaran->total,0,',','.')}}</td>
                            <td>{{$detailPengeluaran->nama_produk_pembayaran}}</td>
                            <td>
                                @if ($detailPengeluaran->bukti_foto != null)
                                    <a href="{{asset('storage/' . $detailPengeluaran->bukti_foto)}}" class="badge b-primary" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                          </svg>
                                          <span class="ml-2">Lihat Bukti</span>
                                    </a>
                                @endif
                                @if ($detailPengeluaran->bukti_foto == null)
                                <span class="badge b-red">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                      </svg>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($detailPengeluaran->bukti_pembelian != null)
                                <a href="{{asset('storage/' . $detailPengeluaran->bukti_pembelian)}}" class="badge b-primary" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                                        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                      </svg>
                                      <span class="ml-2">Lihat Bukti</span>
                                </a>
                                @endif
                                @if ($detailPengeluaran->bukti_pembelian == null)
                                    <span class="badge b-red">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                          </svg>
                                    </span>
                                @endif
                            </td>
                            <td>{{$detailPengeluaran->status}}</td>
                            <td><a href="/aksi_detail/{{$detailPengeluaran->IdDetail}}" class="badge b-primary">Ubah</a></td>
                        </tr>
                    @empty
                    <div class="alert alert-danger" role="alert">
                        Belum Ada Transaksi
                    </div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengeluaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/c_pengeluaran_detail" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="idPengeluaran" value="{{$pengeluaran->id}}">
        <div class="modal-body">
          <div class="row">
            <h5>Detail Pengeluaran</h5>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="pengeluaran" class="form-label">Nama Pengeluaran</label>
                <input type="text" class="form-control" id="pengeluaran" placeholder="Pengeluaran" name="pengeluaran" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="satuan" class="form-label">Harga Satuan</label>
                <input type="number" class="form-control" id="satuan" placeholder="satuan" name="satuan" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="Total" class="form-label">Harga Total</label>
                <input type="number" class="form-control" id="Total" placeholder="Total" name="total" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="tglPembelian" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" id="tglPembelian" name="tglPembelian" required>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="kakeibo" class="form-label">Jenis Pengeluaran</label>
                <select class="form-select" aria-label="Default select example" name="kakeibo">
                    @foreach ($kakeibos as $kakeibo)
                    <option value="{{$kakeibo->id}}">{{$kakeibo->jenis}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-12">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
            </div>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="dana" class="form-label">Sumber Dana</label>
                <select class="form-select" aria-label="Default select example" name="dana">
                    @foreach ($dompets as $dompet)
                        <option value="{{$dompet->id}}">{{$dompet->nama_produk_pembayaran}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-3">
                <label for="buktiFoto" class="form-label">Bukti Foto Barang</label>
                <input type="file" class="form-control" id="buktiFoto" accept=".pdf, .jpg, .jpeg" name="bukti_foto">                
            </div>
            <div class="mb-3 col-sm-3">
                <label for="buktiFoto" class="form-label">Bukti Pembelian</label>
                <input type="file" class="form-control" id="buktiFoto" accept=".pdf, .jpg, .jpeg" name="bukti_pembelian">                
            </div>
            <hr>
            <div class="mb-3 col-sm-6">
                <label for="atasNama" class="form-label">Atas Nama</label>
                <select class="form-select" aria-label="Default select example" name="atasNama">
                    @foreach ($gurus as $guru)
                    <option value="{{$guru->id}}">{{$guru->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="status" class="form-label">Status Pengeluaran</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="Pembelian">Pembelian</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn b-red" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn b-primary">Tambah Pengeluaran</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
<script src="{{ $kakeiboBar->cdn() }}"></script>
{{ $kakeiboBar->script() }}
@endsection