<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$title}} | Administrator</title>

    <!-- Custom styles for this template-->
    <link href="{{asset('vendor/css/sb-admin-2.min.css')}}" rel="stylesheet" type="text/css">

    {{-- ficon --}}
    <link rel="shortcut icon" href="{{asset('assets/icons/akunkeun.png')}}" type="image/x-icon">

    {{-- asset --}}
    <link rel="stylesheet" href="{{asset('assets/vanila/Css/main.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.css')}}">

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">




</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav b-white sidebar accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="{{asset('assets/icons/akunkeun.png')}}" alt="logo" style="max-width: 20px">
                </div>
                <div class="sidebar-brand-text mx-3"><b class="color-secound">AKUN</b><b class="color-primary">KEUN</b></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-circle {{ $active == 'dashboard' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading Data Referensi-->
            <div class="sidebar-heading">
                Data Referensi
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/ref-wali">
                    <i class="fas fa-fw fa-circle {{ $active == 'wali' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Data Orang tua Atau Wali</span></a>
            </li>
            
            <li class="nav-item">
                <button class="nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#datasiswa" aria-expanded="false" aria-controls="datasiswa">
                    <i class="fas fa-fw fa-circle {{ $active == 'siswa' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Data Siswa</span>
                </button>
                <div id="datasiswa" class="collapse"  aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="b-grey py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Siswa</h6>
                        <a class="collapse-item" href="/ref-siswa">Data Siswa</a>
                        <a class="collapse-item" href="/ref-kelas">Kelas</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="/ref-guru">
                    <i class="fas fa-fw fa-circle {{ $active == 'guru' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Data Guru</span></a>
            </li>
            
            <li class="nav-item">
                <button class="nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#produk" aria-expanded="false" aria-controls="produk">
                    <i class="fas fa-fw fa-circle {{ $active == 'produk' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Produk Pembayaran</span>
                </button>
                <div id="produk" class="collapse"  aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="b-grey py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Produk Pembayaran</h6>
                        <a class="collapse-item" href="/ref-produk-langsung">Pembayaran Langsung</a>
                        <a class="collapse-item" href="/ref-produk-cicilan">Pembayaran Cicilan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pembayaran
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/transaksi-online">
                    <i class="fas fa-fw fa-circle {{ $active == 'online' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Transaksi Online</span></a>
            </li>
            <li class="nav-item">
                <button class="nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Transaksi" aria-expanded="false" aria-controls="Transaksi">
                    <i class="fas fa-fw fa-circle {{ $active == 'offline' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Transaksi Pembayaran</span>
                </button>
                <div id="Transaksi" class="collapse"  aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="b-grey py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Transaksi Offline</h6>
                        <a class="collapse-item" href="/transaksi-offline">Pembayaran</a>
                        <a class="collapse-item" href="/transaksi-cicilan">Cicilan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengajuan
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <button class="nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengajuanOnline" aria-expanded="false" aria-controls="pengajuanOnline">
                    <i class="fas fa-fw fa-circle {{ $active == 'penunjang' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Pengajuan Online</span>
                </button>
                <div id="pengajuanOnline" class="collapse"  aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="b-grey py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Penunjang</h6>
                        <a class="collapse-item" href="utilities-color.html">Bagian Keuangan</a>
                        <a class="collapse-item" href="utilities-border.html">Kepala Madrasah</a>
                        <a class="collapse-item" href="utilities-border.html">Guru Atau Staf</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <button class="nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengajuanLangsung" aria-expanded="false" aria-controls="pengajuanLangsung">
                    <i class="fas fa-fw fa-circle {{ $active == 'penunjang' ? 'color-primary' : 'color-primary-blur'}}"></i>
                    <span>Pengajuan Langsung</span>
                </button>
                <div id="pengajuanLangsung" class="collapse"  aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="b-grey py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Penunjang</h6>
                        <a class="collapse-item" href="utilities-color.html">Bagian Keuangan</a>
                        <a class="collapse-item" href="utilities-border.html">Kepala Madrasah</a>
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengelolaan Keuangan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Pemasukan</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Pengeluaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Laporan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Laporan Pemasukan</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Laporan Pengeluaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Penaturan Akun</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-circle color-primary-blur"></i>
                    <span>Pengaturan Versi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="mb-2 text-center" src="{{asset('assets/icons/exit.png')}}" alt="..." style="max-width: 70px;">
                <p class="text-center mb-2" style="color: black"><strong>Akses Keluar!</strong> Keluar dari akun untuk masuk akun lain!</p>
                <button type="button" class="btn b-red btn-sm" data-bs-toggle="modal" data-bs-target="#logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </button>
            </div>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn b-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" id="notif-menu" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="notif-menu">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" id="message-menu" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="message-menu">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <button class="nav-link dropdown-toggle" id="profile-menu" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth('guru')->user()->nama }} | {{ auth('guru')->user()->jabatan }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('assets/icons/undraw_profile.svg')}}">
                            </button>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="profile-menu">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </button>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                {{-- toast --}}
                @if (session()->has('success'))
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container top-0 end-0 p-3">
                        <div class="show toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header b-primary">
                            <strong class="me-auto">Pesan Sobat Akunkeun</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Begin Page Content -->
                <div class="container-fluid" style="font-size: 0.9rem">

                    @yield('contain')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Akunkeun - Aplikasi Kegiatan dan Urusan Keuangan 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout -->
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img class="mb-2 text-center" src="{{asset('assets/icons/exit.png')}}" alt="..." style="max-width: 200px;">
                <h4 class="bold-text" style="color: black">Akses Keluar!</h4>
                <p class="mb-2" style="color: black">Keluar dari akun untuk masuk akun lain!</p>
            </div>
            <div class="d-flex justify-content-center mb-3">
            <button type="button" class="btn btn-secondary mr-3" data-bs-dismiss="modal">Batal</button>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn b-red" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </button>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('vendor/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('vendor/js/demo/datatables-demo.js')}}"></script>    
    
</body>

</html>