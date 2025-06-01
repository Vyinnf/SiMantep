@extends('layouts.admin') {{-- Pastikan nama layout ini sesuai dengan milik Anda --}}

@section('title', 'Dashboard Admin')

@section('content')

    {{-- Baris Atas untuk Widget Dinamis --}}
    <div class="dashboard-header-widgets mb-4">
        <div class="widget-group-left">
            <div class="widget clock" id="realtimeClock" title="Waktu Saat Ini (Jakarta)">--:--:-- WIB</div>
            <div class="widget calendar" id="realtimeCalendar" title="Tanggal Hari Ini">Memuat tanggal...</div>
        </div>
        <div class="widget-group-right">
            <div class="widget weather" id="weatherWidget" title="Cuaca di Sumenep">
                <i class="mdi mdi-weather-partly-cloudy"></i> Sumenep: Memuat...
            </div>
            {{-- Tombol Theme Switcher sekarang ada di layouts/admin.blade.php (main-panel-topbar) --}}
            {{-- Jika Anda ingin tombol khusus di halaman ini juga, Anda bisa menambahkannya di sini dengan ID berbeda --}}
            {{-- atau biarkan kosong jika tombol global sudah cukup --}}
        </div>
    </div>

    <h2 class="mb-4 text-center dashboard-title">Dashboard Statistik Admin</h2>

    <div class="dashboard-grid">
        <div class="dashboard-card mahasiswa">
            <i class="mdi mdi-account-multiple"></i> {{-- Ikon --}}
            <div class="label-value-group"> {{-- Grup untuk teks --}}
                <div class="label">Total Mahasiswa</div>
                <div class="value">{{ $totalMahasiswa ?? 0 }}</div>
            </div>
        </div>
        <div class="dashboard-card dosen">
            <i class="mdi mdi-account-star"></i>
            <div class="label-value-group">
                <div class="label">Total Dosen</div>
                <div class="value">{{ $totalDosen ?? 0 }}</div>
            </div>
        </div>
        <div class="dashboard-card pendaftaran">
            <i class="mdi mdi-file-document-box"></i>
            <div class="label-value-group">
                <div class="label">Pendaftar PKL</div>
                <div class="value">{{ $totalPendaftaran ?? 0 }}</div>
            </div>
        </div>
        <div class="dashboard-card notifikasi">
            <i class="mdi mdi-bell-ring"></i>
            <div class="label-value-group">
                <div class="label">Notifikasi Baru</div>
                <div class="value">{{ $totalNotifikasi ?? 0 }}</div>
            </div>
        </div>
    </div>

    {{-- Area Grafik Baru untuk Dosen & Mahasiswa --}}
    <div class="row mt-4 gx-4"> {{-- Menggunakan class .row dari Bootstrap untuk grid, gx-4 untuk gutter --}}
        <div class="col-lg-6 mb-4"> {{-- col-lg-6 agar menjadi 1 kolom di layar kecil/medium --}}
            <div class="card shadow-sm border-0 chart-card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Mahasiswa <span class="card-subtitle">(Contoh per Semester)</span></h5>
                    <div class="chart-container">
                        <canvas id="mahasiswaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 chart-card">
                <div class="card-body">
                    <h5 class="card-title">Statistik Dosen <span class="card-subtitle">(Contoh per Fakultas)</span></h5>
                    <div class="chart-container">
                        <canvas id="dosenChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Variabel untuk menyimpan instance chart agar bisa di-destroy/update
            let mahasiswaChartInstance = null;
            let dosenChartInstance = null;
            // pklChartInstance jika ada

            // Fungsi untuk mendapatkan warna tema saat ini
            function getThemeColors() {
                const rootStyles = getComputedStyle(document.documentElement);
                return {
                    textColor: rootStyles.getPropertyValue('--text-secondary').trim() || '#B0BEC5',
                    accentColor: rootStyles.getPropertyValue('--accent-primary').trim() || '#FE7743',
                    accentColorRgb: rootStyles.getPropertyValue('--accent-primary-rgb').trim() || '254, 119, 67',
                    borderColor: rootStyles.getPropertyValue('--border-color').trim() || '#1E2D38',
                    mainFont: rootStyles.getPropertyValue('--font-main').trim().split(',')[0].replace(/"/g, '') ||
                        'Roboto Mono',
                    // Warna spesifik untuk grafik jika berbeda
                    dosenChartAccentColor: '#4CAF50', // Contoh: hijau dari palet sebelumnya
                    dosenChartAccentColorRgb: '76, 175, 80',
                    pendaftaranChartAccentColor: '#2196F3', // Biru
                    pendaftaranChartAccentColorRgb: '33, 150, 243',
                    notifikasiChartAccentColor: getComputedStyle(document.documentElement).getPropertyValue(
                        '--warning-color').trim() || '#FFA000',
                    notifikasiChartAccentColorRgb: getComputedStyle(document.documentElement).getPropertyValue(
                        '--warning-color-rgb').trim() || '255, 160, 0',
                };
            }

            function createMahasiswaChart() {
                const ctx = document.getElementById('mahasiswaChart');
                if (!ctx) return;

                if (mahasiswaChartInstance) {
                    mahasiswaChartInstance.destroy();
                }
                const themeColors = getThemeColors();
                mahasiswaChartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Smt 1', 'Smt 2', 'Smt 3', 'Smt 4', 'Smt 5', 'Smt 6', 'Smt 7', 'Smt 8+'],
                        datasets: [{
                            label: 'Jumlah Mahasiswa',
                            data: [{{ $totalMahasiswaSmt1 ?? 12 }}, {{ $totalMahasiswaSmt2 ?? 19 }},
                                {{ $totalMahasiswaSmt3 ?? 23 }},
                                {{ $totalMahasiswaSmt4 ?? 15 }},
                                {{ $totalMahasiswaSmt5 ?? 28 }},
                                {{ $totalMahasiswaSmt6 ?? 10 }},
                                {{ $totalMahasiswaSmt7 ?? 20 }},
                                {{ $totalMahasiswaSmt8Plus ?? 5 }}
                            ],
                            backgroundColor: `rgba(${themeColors.accentColorRgb}, 0.45)`,
                            borderColor: themeColors.accentColor,
                            borderWidth: 1.5,
                            borderRadius: 3,
                            hoverBackgroundColor: `rgba(${themeColors.accentColorRgb}, 0.65)`,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: themeColors.textColor,
                                    font: {
                                        family: themeColors.mainFont
                                    }
                                },
                                grid: {
                                    color: themeColors.borderColor,
                                    drawBorder: false
                                }
                            },
                            x: {
                                ticks: {
                                    color: themeColors.textColor,
                                    font: {
                                        family: themeColors.mainFont
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            function createDosenChart() {
                const ctx = document.getElementById('dosenChart');
                if (!ctx) return;

                if (dosenChartInstance) {
                    dosenChartInstance.destroy();
                }
                const themeColors = getThemeColors();
                dosenChartInstance = new Chart(ctx, {
                    type: 'pie', // Diubah ke pie untuk variasi
                    data: {
                        labels: ['Teknik', 'Ekonomi', 'Hukum', 'ISIP'],
                        datasets: [{
                            label: 'Jumlah Dosen',
                            data: [{{ $dosenTeknik ?? 12 }}, {{ $dosenEkonomi ?? 8 }},
                                {{ $dosenHukum ?? 5 }}, {{ $dosenIsip ?? 10 }}
                            ],
                            backgroundColor: [
                                `rgba(${themeColors.dosenChartAccentColorRgb}, 0.8)`,
                                `rgba(${themeColors.accentColorRgb}, 0.8)`,
                                `rgba(${themeColors.pendaftaranChartAccentColorRgb}, 0.8)`,
                                `rgba(${themeColors.notifikasiChartAccentColorRgb}, 0.8)`
                            ],
                            borderColor: themeColors.borderColor, // atau var(--bg-surface-1)
                            borderWidth: 1,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: themeColors.textColor,
                                    font: {
                                        family: themeColors.mainFont
                                    },
                                    padding: 15
                                }
                            }
                        }
                    }
                });
            }

            // Inisialisasi chart
            createMahasiswaChart();
            createDosenChart();

            // Dengarkan event perubahan tema untuk menggambar ulang chart dengan warna baru
            window.addEventListener('themeChanged', function(e) {
                // console.log('Dashboard theme changed to:', e.detail.theme); // Untuk debug
                // Hancurkan dan buat ulang chart agar mengambil warna CSS terbaru
                if (mahasiswaChartInstance) mahasiswaChartInstance.destroy();
                if (dosenChartInstance) dosenChartInstance.destroy();
                createMahasiswaChart();
                createDosenChart();
            });


            // --- Weather Widget (Placeholder - Implementasikan dengan API Key Anda) ---
            const weatherWidget = document.getElementById('weatherWidget');
            if (weatherWidget) {
                const city = 'Sumenep';
                // const apiKey = 'YOUR_OPENWEATHERMAP_API_KEY'; // GANTI DENGAN API KEY ANDA
                // const weatherApiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city},ID&appid=${apiKey}&units=metric&lang=id`;
                //
                // fetch(weatherApiUrl)
                //     .then(response => {
                //         if (!response.ok) { throw new Error('Cuaca: Gagal mengambil data.'); }
                //         return response.json();
                //     })
                //     .then(data => {
                //         if (data.main && data.weather && data.weather.length > 0) {
                //             const temp = Math.round(data.main.temp);
                //             const description = data.weather[0].description.replace(/\b\w/g, l => l.toUpperCase()); // Capitalize
                //             const iconCode = data.weather[0].icon;
                //             let mdiIcon = 'mdi-weather-cloudy'; // Default
                //             if (iconCode.includes('01')) mdiIcon = 'mdi-weather-sunny';
                //             else if (iconCode.includes('02')) mdiIcon = 'mdi-weather-partly-cloudy';
                //             else if (iconCode.includes('03') || iconCode.includes('04')) mdiIcon = 'mdi-weather-cloudy';
                //             else if (iconCode.includes('09') || iconCode.includes('10')) mdiIcon = 'mdi-weather-pouring';
                //             else if (iconCode.includes('11')) mdiIcon = 'mdi-weather-lightning';
                //             else if (iconCode.includes('13')) mdiIcon = 'mdi-weather-snowy';
                //             else if (iconCode.includes('50')) mdiIcon = 'mdi-weather-fog';
                //
                //             weatherWidget.innerHTML = `<i class="mdi ${mdiIcon}"></i> ${city}: ${temp}°C`;
                //             weatherWidget.title = `${description} di ${city}`;
                //         } else {
                //             weatherWidget.innerHTML = `<i class="mdi mdi-alert-circle-outline"></i> Cuaca: N/A`;
                //         }
                //     })
                //     .catch(error => {
                //         console.error('Error fetching weather:', error);
                //         if (weatherWidget) weatherWidget.innerHTML = `<i class="mdi mdi-alert-circle-outline"></i> Cuaca: Error`;
                //     });
                // Hapus baris ini jika sudah mengaktifkan fetch di atas
                weatherWidget.innerHTML = `<i class="mdi mdi-weather-partly-cloudy"></i> Sumenep: 29°C`;
            }

        }); // Penutup DOMContentLoaded
    </script>
@endpush
