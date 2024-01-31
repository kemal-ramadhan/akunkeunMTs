@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Data Referensi / Data Orang Tua Atau Wali / {{$wali->nama}}</b></h1>

<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Detail Data</b></h5>

    <form action="/u_wali" method="post">
        @csrf
      <div class="row mt-3">
        <div class="col-sm-4 mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="{{$wali->nama}}">
            <input type="hidden" name="idWali" value="{{$wali->id}}">
        </div>
        <div class="col-sm-4 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{$wali->email}}">
        </div>
        <div class="col-sm-4 mb-3">
            <label for="no_telp" class="form-label">Nomor Telepon / WhatsApp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{$wali->no_telepon}}">
        </div>
        <div class="col-sm-4 mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" rows="3">{{$wali->alamat}}</textarea>
        </div>
        <div class="col-sm-4 mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="{{$wali->username}}">
        </div>
        <div class="col-sm-4 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password Baru">
        </div>
        <div class="col-sm-4 mb-3">
            <label for="password" class="form-label">Status</label>
            <select class="form-select" name="status" aria-label="Default select example">
                <option selected>{{$wali->status}}</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>
        
      </div>

      <div class="text-center mt-3">
        <a href="/ref-wali" class="btn b-red">Kembali</a>
        <button type="submit" class="btn b-primary">Perbaharui Data</button>
      </div>
      </form>
    </div>
</div>

<div class="card col-sm-12 mb-5 shadow-sm">
    <div class="card-body text-gray-800">
      <h5 class="mb-3"><b>Data Anak</b></h5>
    
      <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN/NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>No Telephone</th>
                        <th>Email</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>NISN/NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>No Telephone</th>
                        <th>Email</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach ($siswas as $siswa)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$siswa->nisn}}/{{$siswa->nis}}</td>
                        <td>{{$siswa->nama}}</td>
                        <td>{{$siswa->kelas_romawi_angka_abjad}} - {{$siswa->nama_kelas}}</td>
                        <td>{{$siswa->no_telepon}}</td>
                        <td>{{$siswa->email}}</td>
                        <td>{{$siswa->tahun_masuk}}</td>
                        <td>{{$siswa->tahun_keluar}}</td>
                        <td>{{$siswa->status}}</td>
                        <td>
                        <a href="/d_siswa/{{$siswa->IdSiswa}}" class="badge b-primary">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection