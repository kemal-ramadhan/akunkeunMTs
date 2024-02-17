@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Formulir Pengajuan</b></h1>

<div class="card">
    <form action="/c_pengajuan_guru" method="post">
    @csrf
    <input type="hidden" name="idPengaju" value="{{ auth('guru')->user()->id }}">
    <div class="card-body">
        <h5>Formulir Pengajuan Guru</h5>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label for="pengajuan" class="form-label">Nama Pengajuan</label>
                <input type="text" class="form-control" id="pengajuan" name="namaPengajuan" placeholder="Nama Pembelian/penggantian Barang">
            </div>
            <div class="mb-3 col-sm-6">
                <label for="pengajuan" class="form-label">Jenis Pengajuan</label>
                <select class="form-select" aria-label="Default select example" name="jenis">
                    <option value="Pengajuan">Pengajuan</option>
                    <option value="Penggantian">Penggantian</option>
                </select>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3"></textarea>
            </div>
            <div class="mb-3 col-sm-6">
                <label for="nominal" class="form-label">Nominal Yang Diajukan</label>
                <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Nominal yang ingin diajukan">
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn b-primary" type="submit">Ajukan</button>
        </div>
    </div>
    </form>
</div>

@endsection