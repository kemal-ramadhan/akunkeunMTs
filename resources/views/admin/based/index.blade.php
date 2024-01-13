@extends('admin.template.template')

@section('contain')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><b>Dashboard</b></h1>
<h1 class="h3 mb-4 text-gray-800">Hallo, Selamat Datang <b>{{ auth('guru')->user()->nama }}</b></h1>


@endsection