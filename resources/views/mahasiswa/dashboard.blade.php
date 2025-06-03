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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
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
                        <div class="row mb-3">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <div class="alert alert-info">
                                    <h5>Notifikasi Baru</h5>
                                    <ul>
                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            <li>{{ $notification->data['message'] ?? 'Notifikasi baru' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="alert alert-secondary">
                                    Tidak ada notifikasi baru.
                                </div>
                            @endif
                        </div>
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
                    @if (isset($pendaftaran))
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Tanggal Pengajuan:</strong> {{ $pendaftaran->created_at->format('d M Y') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Status:</strong>
                                @if ($pendaftaran->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                @elseif ($pendaftaran->status == 'accepted')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif ($pendaftaran->status == 'rejected')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">Belum Ada Status</span>
                                @endif
                            </li>
                            <li class="list-group-item">
                                <strong>Instansi:</strong>
                                @if ($pendaftaran->instansi)
                                    {{ $pendaftaran->instansi->nama_instansi }}
                                @else
                                    <span class="text-muted">Instansi manual belum disetujui</span>
                                @endif
                            </li>
                            @if ($pendaftaran->status == 'approved')
                                <li class="list-group-item">
                                    <strong>Periode PKL:</strong>
                                    @if ($pendaftaran->tanggal_mulai && $pendaftaran->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_mulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_selesai)->format('d M Y') }}
                                    @else
                                        <span class="text-danger">Tanggal belum diatur oleh admin.</span>
                                    @endif
                                </li>
                            @endif

                        </ul>
                    @else
                        <div class="alert alert-warning">
                            Anda belum melakukan pendaftaran PKL.
                        </div>
                    @endif
                    <li class="list-group-item">
                        <strong>Dosen Pembimbing: </strong>
                        {{ $pendaftaran->dosen ? $pendaftaran->dosen->name : 'Belum ditentukan' }}
                    </li>

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
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
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
