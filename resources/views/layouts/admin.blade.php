{{-- filepath: resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS & Icon -->
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/admin.css') }}">
    @stack('styles')
</head>

<body>
    <div class="container-scroller">
        <!-- Sidebar -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                            class="mdi mdi-grid-large menu-icon"></i><span class="menu-title">Dashboard</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.mahasiswa.index') }}"><i
                            class="mdi mdi-account-multiple menu-icon"></i><span class="menu-title">Data
                            Mahasiswa</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dosen.index') }}"><i
                            class="mdi mdi-account-star menu-icon"></i><span class="menu-title">Data Dosen</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dosen.create') }}"><i
                            class="mdi mdi-account-plus menu-icon"></i><span class="menu-title">Tambah Dosen</span></a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.pendaftaran.index') }}"><i
                            class="mdi mdi-file-document-box menu-icon"></i><span class="menu-title">Pendaftaran
                            PKL</span></a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                        <i class="mdi mdi-domain menu-icon"></i>
                        <span class="menu-title">Manajemen Instansi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                        <i class="mdi mdi-bell-ring menu-icon"></i>
                        <span class="menu-title">Notifikasi</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form action="{{ route('admin.logout') }}" method="POST" style="margin:0; padding:0;">
                        @csrf
                        <button type="submit" class="nav-link"
                            style="background:none; border:none; padding:0; width:100%; text-align:left;">
                            <i class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- Main Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets-admin/js/template.js') }}"></script>
    @stack('scripts')
</body>

</html>
