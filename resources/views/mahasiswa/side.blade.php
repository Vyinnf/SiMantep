<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Dashboard Mahasiswa')</title> {{-- Judul halaman dinamis, default 'Dashboard Mahasiswa' --}}
    <link rel="stylesheet" href="{{ asset('assets/css/mahasiswa_dashboard_styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles') {{-- Untuk CSS tambahan spesifik per halaman --}}
</head>

<body class="light-theme"> {{-- Ganti ke dark-theme jika ingin default gelap --}}

    @if (session('success'))
    <div class="flash-message global-alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="mdi mdi-check-circle-outline"></i></span>
        <div class="alert-content">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="flash-message global-alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="mdi mdi-alert-circle-outline"></i></span>
        <div class="alert-content">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container-scroller">
        {{-- Sidebar --}}
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper">
                <a class="sidebar-brand-link logo-lg" href="{{ route('mahasiswa.dashboard') }}" title="SiMantep - Dashboard">
                    <span class="brand-text">SiMantep</span>
                </a>
                <a class="sidebar-brand-link logo-mini" href="{{ route('mahasiswa.dashboard') }}" title="SiMantep">
                    <span class="brand-text-mini">SM</span>
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item {{ Request::routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('mahasiswa.pendaftaran') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.pendaftaran') }}">
                        <i class="mdi mdi-file-document-edit-outline menu-icon"></i>
                        <span class="menu-title">Pendaftaran PKL</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::routeIs('mahasiswa.laporan') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.laporan') }}">
                        <i class="mdi mdi-upload-outline menu-icon"></i>
                        <span class="menu-title">Upload Laporan</span>
                    </a>
                </li>

                <li class="nav-category">Akun Saya</li>

                <li class="nav-item {{ Request::routeIs('mahasiswa.profil.edit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('mahasiswa.profil.edit') }}">
                        <i class="mdi mdi-account-circle-outline menu-icon"></i>
                        <span class="menu-title">Edit Profile</span>
                    </a>
                </li>
                {{-- Contoh submenu jika diperlukan di masa depan
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#authSubmenu" aria-expanded="false" aria-controls="authSubmenu">
                        <i class="mdi mdi-account-cog-outline menu-icon"></i>
                        <span class="menu-title">Pengaturan Akun</span>
                        <i class="menu-arrow mdi mdi-chevron-down"></i>
                    </a>
                    <div class="collapse" id="authSubmenu">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::routeIs('mahasiswa.profil.edit') ? 'active' : '' }}" href="{{ route('mahasiswa.profil.edit') }}">
                                    Edit Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                --}}
            </ul>
            <div class="sidebar-footer-logout">
                <a class="nav-link logout-link" href="{{ route('mahasiswa.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                    <i class="mdi mdi-logout-variant menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </a>
                <form id="logout-form-sidebar" action="{{ route('mahasiswa.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
        {{-- End Sidebar --}}

        <div class="container-fluid page-body-wrapper">
            {{-- Top Navbar --}}
            <nav class="navbar top-navbar col-lg-12 col-12 p-0 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-end">
                    <button class="navbar-toggler sidebar-toggler align-self-center d-none d-lg-block" type="button" id="sidebarToggler">
                        <i class="mdi mdi-menu-open"></i>
                    </button>

                    <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                </div>
                                <input type="text" class="form-control bg-transparent border-0" placeholder="Search for classes, tasks, etc...">
                            </div>
                        </form>
                    </div>

                    <ul class="navbar-nav navbar-nav-right ms-auto">
                        <li class="nav-item">
                            <button class="theme-switcher-btn" id="themeSwitcher" title="Toggle Theme">
                                <i class="mdi mdi-theme-light-dark"></i>
                            </button>
                        </li>
                        <li class="nav-item dropdown">
                             <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown" title="Notifications">
                                <i class="mdi mdi-bell-outline"></i>
                                @if (auth()->user() && auth()->user()->unreadNotifications->count() > 0)
                                <span class="count-symbol bg-danger"></span>
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0 border-bottom">Notifications</h6>
                                @if (auth()->user()) {{-- Pastikan user terautentikasi --}}
                                    @forelse (auth()->user()->unreadNotifications->take(4) as $notification)
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-success"> <i class="mdi mdi-information-outline"></i> </div>
                                        </div>
                                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject font-weight-normal mb-1">{{ Str::limit($notification->data['message'] ?? 'Notifikasi baru', 35) }}</h6>
                                            <p class="text-gray ellipsis mb-0"> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} </p>
                                        </div>
                                    </a>
                                    @empty
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <p class="text-gray mb-0 text-center w-100">No new notifications</p>
                                        </div>
                                    </a>
                                    @endforelse
                                @else
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <p class="text-gray mb-0 text-center w-100">Login to see notifications</p>
                                        </div>
                                    </a>
                                @endif
                                <h6 class="p-3 mb-0 text-center border-top">See all notifications</h6>
                            </div>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user() && auth()->user()->mahasiswa && auth()->user()->mahasiswa->foto ? asset('uploads/foto/' . auth()->user()->mahasiswa->foto) : asset('https://placehold.co/40x40/EBF4FF/76839A?text=M') }}"
                                    alt="profile" class="profile-pic" />
                                <span class="nav-profile-name d-none d-md-block">{{ auth()->user() ? (auth()->user()->mahasiswa->nama ?? auth()->user()->name) : 'Guest' }}</span>
                                <i class="mdi mdi-chevron-down d-none d-md-block"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('mahasiswa.profil.edit') }}">
                                    <i class="mdi mdi-account-edit-outline"></i> Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
                                    <i class="mdi mdi-logout"></i> Logout
                                </a>
                                <form id="logout-form-nav" action="{{ route('mahasiswa.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler mobile-sidebar-toggler align-self-center d-lg-none" type="button" data-toggle="sidebar-show">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
            </nav>
            {{-- End Top Navbar --}}

            {{-- Main Content Area --}}
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content') {{-- Konten spesifik halaman akan dimuat di sini --}}
                </div>
                {{-- Footer --}}
                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © {{ date('Y') }}.
                            <a href="#" target="_blank">SiMantep</a>. All rights reserved.</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
                {{-- End Footer --}}
            </div>
            {{-- End Main Content Area --}}
        </div>
    </div>

    <script>
        // Sidebar Toggler untuk Desktop (Minimize/Expand)
        const sidebarToggler = document.getElementById('sidebarToggler');
        const body = document.body;
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggler) {
            sidebarToggler.addEventListener('click', function() {
                body.classList.toggle('sidebar-mini');
                const icon = this.querySelector('i');
                if (body.classList.contains('sidebar-mini')) {
                    icon.classList.remove('mdi-menu-open');
                    icon.classList.add('mdi-menu');
                } else {
                    icon.classList.remove('mdi-menu');
                    icon.classList.add('mdi-menu-open');
                }
            });
        }

        // Mobile Sidebar Toggler (Show/Hide)
        const mobileSidebarToggler = document.querySelector('.mobile-sidebar-toggler');
        if (mobileSidebarToggler && sidebar) {
            mobileSidebarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }

        // Theme Switcher
        const themeSwitcher = document.getElementById('themeSwitcher');
        if (themeSwitcher) {
            const currentTheme = localStorage.getItem('theme');
            const icon = themeSwitcher.querySelector('i');

            function applyTheme(theme) {
                document.body.classList.remove('light-theme', 'dark-theme');
                document.body.classList.add(theme + '-theme');
                if (theme === 'dark') {
                    icon.classList.remove('mdi-weather-night'); // Ikon untuk light mode (malam)
                    icon.classList.add('mdi-weather-sunny'); // Ikon untuk dark mode (matahari)
                    if(themeSwitcher) themeSwitcher.title = "Switch to Light Theme";
                } else {
                    icon.classList.remove('mdi-weather-sunny');
                    icon.classList.add('mdi-weather-night');
                    if(themeSwitcher) themeSwitcher.title = "Switch to Dark Theme";
                }
                localStorage.setItem('theme', theme);
            }

            // Terapkan tema yang tersimpan atau default
            let initialTheme = 'light'; // Default ke light
            if (document.body.classList.contains('dark-theme') && !currentTheme) { // Jika default di body adalah dark dan belum ada di local storage
                initialTheme = 'dark';
            }
            applyTheme(currentTheme || initialTheme);


            themeSwitcher.addEventListener('click', () => {
                let newTheme = document.body.classList.contains('light-theme') ? 'dark' : 'light';
                applyTheme(newTheme);
            });
        }

        // Bootstrap JS Initialization (jika menggunakan komponennya)
        // Pastikan Bootstrap JS dimuat, bisa di sini atau di app.js Laravel Anda
        // Kode ini akan mencoba memuatnya jika belum ada.
        var SCRIPT_URL_BOOTSTRAP = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js';
        var scriptBootstrapExists = document.querySelector('script[src="' + SCRIPT_URL_BOOTSTRAP + '"]');

        function initializeBootstrapComponents() {
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'));
            dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'));
            collapseElementList.map(function (collapseEl) {
                // Hindari inisialisasi ulang jika sudah dikontrol oleh parent (seperti accordion)
                if (!collapseEl.closest('[data-bs-parent]')) {
                    // Periksa apakah sudah ada instance, jika belum, buat baru
                    var instance = bootstrap.Collapse.getInstance(collapseEl);
                    if (!instance) {
                         // Inisialisasi dengan toggle: false agar tidak otomatis terbuka/tertutup saat load
                        return new bootstrap.Collapse(collapseEl, { toggle: false });
                    }
                    return instance;
                }
                return null;
            }).filter(el => el !== null);

            var alertElementList = [].slice.call(document.querySelectorAll('.alert-dismissible'));
            alertElementList.map(function (alertEl) {
                return new bootstrap.Alert(alertEl);
            });
        }

        if (!scriptBootstrapExists) {
            var scriptBootstrap = document.createElement('script');
            scriptBootstrap.src = SCRIPT_URL_BOOTSTRAP;
            scriptBootstrap.onload = initializeBootstrapComponents;
            document.head.appendChild(scriptBootstrap);
        } else {
            // Jika Bootstrap sudah dimuat, mungkin perlu inisialisasi manual jika DOM berubah
            // atau jika script ini dijalankan setelah event DOMContentLoaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initializeBootstrapComponents);
            } else {
                initializeBootstrapComponents();
            }
        }
    </script>
    @stack('scripts') {{-- Untuk JS tambahan spesifik per halaman --}}
</body>
</html>
