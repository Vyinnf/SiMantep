<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Mahasiswa</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light copy/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"></div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <!-- Navbar Right Profile Dropdown -->
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- Foto profil dari database --}}
                            <img src="{{ auth()->user()->mahasiswa && auth()->user()->mahasiswa->foto
                                ? asset('uploads/foto/' . auth()->user()->mahasiswa->foto)
                                : asset('images/faces/default-profile.png') }}"
                                alt="profile" />
                        </a>
                        <form id="logout-form" action="{{ route('mahasiswa.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
            </div>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
    </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas d-flex flex-column justify-content-between" id="sidebar">
            <div>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa.pendaftaran') }}">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">Pendaftaran PKL</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mahasiswa.laporan') }}">
                            <i class="icon-upload menu-icon"></i>
                            <span class="menu-title">Upload Laporan Magang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">User Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('mahasiswa.profil.edit') }}">
                                        Edit Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="sidebar-logout mb-3 px-3">
                <a class="btn btn-danger w-100" href="{{ route('mahasiswa.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('mahasiswa.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                @php
                                    $mahasiswa = \App\Models\Mahasiswa::where('email', auth()->user()->email)->first();
                                @endphp
                                <h3 class="font-weight-bold">
                                    Welcome {{ $mahasiswa->nama ?? 'User' }}
                                </h3>
                                <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have
                                    <span class="text-primary">3 unread alerts!</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Bimbingan Hari Ini</p>
                                <p class="font-weight-500">Halaman ini akan menampilkan bimbingan/revisi dari dosen
                                    pembimbing anda masing-masing.</p>
                                <div class="d-flex flex-wrap mb-5">
                                    {{-- <div class="mr-5 mt-3">
                      <p class="text-muted">Order value</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Orders</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Users</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Downloads</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div>  --}}
                                </div>
                                <canvas id="order-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">Sales Report</p>
                                    <a href="#" class="text-info">View all</a>
                                </div>
                                <p class="font-weight-500">The total number of sessions within the date range. It
                                    is
                                    the period time a user is actively engaged with your website, page or app, etc
                                </p>
                                <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                                <canvas id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin
                                template</a> from BootstrapDash. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted &
                            made
                            with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by
                            <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendor/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src=') }}{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
</body>

</html>
