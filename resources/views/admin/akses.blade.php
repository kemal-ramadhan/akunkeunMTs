<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akses Masuk | Akunkeun MTs At - Tarbiyah Dayeuhkolot</title>

    {{-- ficon --}}
    <link rel="shortcut icon" href="{{asset('assets/icons/akunkeun.png')}}" type="image/x-icon">

    {{-- asset --}}
    <link rel="stylesheet" href="{{asset('assets/vanila/Css/main.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}">
</head>
<body>
    
    {{-- toast --}}
    @if (session()->has('LoginError'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header b-primary">
                <strong class="me-auto">Pesan Sobat Akunkeun</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('LoginError') }}
                </div>
            </div>
        </div>
    </div>
    @endif

{{-- container --}}
<div class="container">
    <div class="box-center">
        <div class="row">
            <div class="col-sm-6 hiden-mobile">
                <div class="image-box">
                    <img src="{{asset('assets/icons/welcome.png')}}" class="welcome-login" alt="welcome">
                </div>
            </div>
            <div class="col-sm-6">
                {{-- card box login --}}
                <div class="card shadow card-login" style="border: none;">
                    <div class="card-body px-5">
                      <h3 class="text-center bold-text mb-5 mt-5">Akses Masuk</h3>
                      <form action="/akses" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label bold-text">Email</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label bold-text">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label bold-text">Tahun Versi</label>
                            <select class="form-select" name="versi" aria-label="Default select example">
                                <option selected>2023/2024</option>
                                <option value="1">2022/2023</option>
                              </select>
                        </div>
                        <div class="d-grid gap-2 col-12 mx-auto mb-5">
                            <button class="bold-text btn b-primary" type="submit">Masuk</button>
                            <a href="" class="text-center">Bantuan!</a>
                        </div>
                      </form>
                    </div>
                </div>
                {{-- end card box login --}}

            </div>
        </div>
    </div>
</div>

<script src="{{asset('vendor/bootstrap/js/bootstrap.js')}}"></script>
</body>
</html>