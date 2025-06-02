<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500&display=swap" rel="stylesheet">

    {{-- Link ke CSS Material Design Icons --}}
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">

    {{-- Link ke CSS Admin kustom Anda --}}
    {{-- Pastikan path ini benar, apakah di public/assets-admin/css/ atau hasil build dari resources/css/ --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    @stack('styles')
</head>

<body class="dark-theme"> {{-- Default ke dark-theme, JS akan menghandle --}}
    <div class="container-scroller">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}">
                    {{-- <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo" class="brand-logo"> --}}
                    <span class="brand-text">Admin SiMantep</span> {{-- GANTI NAMA PANEL ANDA --}}
                </a>
            </div>

            <ul class="nav">
                <li
                    class="nav-item {{ request()->routeIs('admin.dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.mahasiswa.*') || request()->is('admin/mahasiswa*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.mahasiswa.index') }}">
                        <i class="mdi mdi-account-group-outline menu-icon"></i>
                        <span class="menu-title">Data Mahasiswa</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.dosen.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dosen.index') }}">
                        <i class="mdi mdi-account-outline menu-icon"></i> <span class="menu-title">Data Dosen</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.dosen.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dosen.create') }}">
                        <i class="mdi mdi-account-plus-outline menu-icon"></i>
                        <span class="menu-title">Tambah Dosen</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.pendaftaran.*') || request()->is('admin/pendaftaran*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
                        <i class="mdi mdi-file-document-edit-outline menu-icon"></i>
                        <span class="menu-title">Pendaftaran PKL</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.instansi.*') || request()->is('admin/instansi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.instansi.index') }}">
                        <i class="mdi mdi-office-building menu-icon"></i>
                        <span class="menu-title">Manajemen Instansi</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.instansi.diminta.index') || request()->is('admin/instansi-diminta*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.instansi.diminta.index') }}">
                        <i class="mdi mdi-clipboard-check-outline menu-icon"></i>
                        <span class="menu-title">Instansi Diminta</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.surat.pkl.index') || request()->is('admin/surat-pkl*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.surat.pkl.index') }}">
                        <i class="mdi mdi-email-edit-outline menu-icon"></i>
                        <span class="menu-title">Pembuatan Surat PKL</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.akun.*') || request()->is('admin/akun*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.akun.index') }}">
                        <i class="mdi mdi-account-supervisor menu-icon"></i>
                        <span class="menu-title">Account Admin</span>
                    </a>
                </li>
                <li
                    class="nav-item {{ request()->routeIs('admin.notifications.*') || request()->is('admin/notifications*') ? 'active' : '' }}">
                    <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                        <i class="mdi mdi-bell-outline menu-icon"></i>
                        <span class="menu-title">Notifikasi</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form action="{{ route('admin.logout') }}" method="POST" style="margin:0; padding:0;">
                        @csrf
                        <button type="submit" class="nav-link"
                            style="background:none; border:none; padding:0; width:100%; text-align:left; cursor:pointer;">
                            <i class="mdi mdi-logout-variant menu-icon"></i>
                            <span class="menu-title">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <div class="main-panel">
            <div class="main-panel-topbar">
                <div class="topbar-content">
                    <div class="topbar-left">
                        {{-- <input type="search" class="topbar-search-input" placeholder="Cari..."> --}}
                    </div>
                    <div class="topbar-right ms-auto">
                        <button id="themeSwitcherGlobal" class="btn btn-icon-only theme-switcher-btn"
                            title="Ganti Tema Tampilan">
                            <i class="mdi mdi-theme-light-dark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show global-alert" role="alert">
                        <i class="mdi mdi-check-circle-outline alert-icon"></i>
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show global-alert" role="alert">
                        <i class="mdi mdi-alert-circle-outline alert-icon"></i>
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Hak Cipta ©
                        {{ date('Y') }}.</span>
                    <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">Admin Panel</span>
                </div>
            </footer>
        </div>
    </div>

    {{-- Pastikan path vendor JS ini benar jika Anda menggunakannya --}}
    <script src="{{ asset('assets-admin/vendors/js/vendor.bundle.base.js') }}"></script>
    {{-- Pastikan path template JS ini benar jika Anda menggunakannya --}}
    <script src="{{ asset('assets-admin/js/template.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeSwitcherBtn = document.getElementById('themeSwitcherGlobal');
            const bodyEl = document.body; // Target body untuk class tema

            window.applyTheme = function(theme) {
                bodyEl.classList.remove('light-theme', 'dark-theme'); // Hapus tema lama dari body
                bodyEl.classList.add(theme + '-theme'); // Tambah tema baru ke body

                if (themeSwitcherBtn) {
                    const icon = themeSwitcherBtn.querySelector('i');
                    if (icon) {
                        icon.className = (theme === 'light') ? 'mdi mdi-weather-night' : 'mdi mdi-weather-sunny';
                    }
                    themeSwitcherBtn.setAttribute('title', (theme === 'light') ? 'Ganti ke Tema Gelap' : 'Ganti ke Tema Terang');
                }
                localStorage.setItem('adminPreferredTheme', theme); // Simpan preferensi tema

                const event = new CustomEvent('themeChanged', { detail: { theme: theme } });
                window.dispatchEvent(event);
            }

            const currentThemeStored = localStorage.getItem('adminPreferredTheme') || 'dark'; // Default ke dark
            window.applyTheme(currentThemeStored);

            if (themeSwitcherBtn) {
                themeSwitcherBtn.addEventListener('click', () => {
                    const newTheme = bodyEl.classList.contains('dark-theme') ? 'light' : 'dark';
                    window.applyTheme(newTheme);
                });
            }

            // Logika jam & kalender
            const clockEl = document.getElementById('realtimeClock');
            const calendarEl = document.getElementById('realtimeCalendar');
            if (clockEl || calendarEl) {
                function updateDateTime() {
                    const now = new Date();
                    const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false, timeZone: 'Asia/Jakarta' };
                    const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', timeZone: 'Asia/Jakarta' };
                    if (clockEl) {
                        clockEl.textContent = now.toLocaleTimeString('id-ID', optionsTime).replace(/\./g, ':');
                    }
                    if (calendarEl) {
                        calendarEl.textContent = now.toLocaleDateString('id-ID', optionsDate);
                    }
                }
                setInterval(updateDateTime, 1000);
                updateDateTime();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
