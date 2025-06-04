{{-- filepath: resources/views/layouts/dosen.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Dosen')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('assets-dosen/css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            {{-- Hamburger Toggle --}}
            <div class="col-12 d-md-none d-flex justify-content-between align-items-center bg-light p-2 shadow-sm">
                <span class="sidebar-toggle fs-3 ms-2" id="toggleSidebar">&#9776;</span>
                <strong class="me-3">Dashboard Dosen</strong>
            </div>

            {{-- Sidebar --}}
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-white sidebar shadow-sm py-4 px-0"
                style="min-height:100vh;">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets-admin/img/profile-default.png') }}" alt="Foto Profil"
                        class="rounded-circle mb-2" width="70" height="70">
                    <div class="fw-bold">{{ Auth::user()?->name ?? (Auth::user()?->nama ?? '-') }}</div>
                    <div class="text-muted" style="font-size:0.95rem;">{{ Auth::user()?->email ?? '-' }}</div>
                    <a href="{{ route('dosen.profile') }}" class="btn btn-outline-primary btn-sm mt-2">Lihat Profil</a>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}"
                            href="{{ route('dosen.dashboard') }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.verifikasi') ? 'active' : '' }}"
                            href="{{ route('dosen.verifikasi') }}">
                            <i class="bi bi-person-check"></i> Verifikasi Pendaftaran PKL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.mahasiswa') ? 'active' : '' }}"
                            href="{{ route('dosen.mahasiswa') }}">
                            <i class="bi bi-people"></i> Monitoring Mahasiswa Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.laporan') ? 'active' : '' }}"
                            href="{{ route('dosen.laporan') }}">
                            <i class="bi bi-journal-text"></i> Koreksi & Revisi Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.nilai') ? 'active' : '' }}"
                            href="{{ route('dosen.nilai') }}">
                            <i class="bi bi-clipboard-check"></i> Upload Nilai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.notifikasi') ? 'active' : '' }}"
                            href="{{ route('dosen.notifikasi') }}">
                            <i class="bi bi-bell"></i> Notifikasi & Riwayat
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="nav-link text-danger" href="{{ route('dosen.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('dosen.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>

            {{-- Main Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('assets/dosen/app.js') }}"></script>
</body>

</html>
