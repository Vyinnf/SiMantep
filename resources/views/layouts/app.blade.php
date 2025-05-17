<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SiMantep-Sistem Informasi PKL Terpadu</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- SiMantep -->
    <link href="{{ asset('assets/img/SiMantep.png') }}" rel="icon">
    <link href="{{ asset('assets/img/SiMantep.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">
    @yield('content')
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div
            class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0">
                <h1 class="sitename">SiMantep</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#features">Fitur Unggulan</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('mahasiswa.login') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 16 16">
                    <path
                        d="M8 0a3 3 0 1 0 3 3 3 3 0 0 0-3-3zm0 1a2 2 0 1 1-2 2 2 2 0 0 1 2-2zm4 7c1.657 0 3 1.343 3 3 0 1.657-1.343 3-3 3H4c-1.657 0-3-1.343-3-3 0-1.657 1.343-3 3-3h8zm0 1H4c-1.103 0-2 .897-2 2 0 1.103.897 2 2 2h8c1.103 0 2-.897 2-2 0-1.103-.897-2-2-2z" />
                </svg>
                Login</a>
        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                            <div class="company-badge mb-4">
                                <i class="bi bi-gear-fill me-2"></i>
                                Working for your success
                            </div>

                            <h1 class="mb-4">
                                Sistem Informasi <br>
                                <span class="accent-text">PKL Terpadu</span>
                            </h1>

                            <p class="mb-4 mb-md-5">
                                SiMantep adalah sistem informasi yang membantu pengelolaan PKL secara terintegrasi.
                                Platform ini memfasilitasi interaksi antara mahasiswa, dosen, dan instansi mitra.
                            </p>

                            <div class="hero-buttons">
                                <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Get Started</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                            <img src="assets/img/illustration-1.webp" alt="Hero Image" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center justify-content-between">

                    <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                        <span class="about-meta">TENTANG KAMI</span>
                        <h2 class="about-title">Sistem Informasi Manajemen PKL Mahasiswa</h2>
                        <p class="about-description">Sistem ini dirancang untuk mempermudah proses pengelolaan kegiatan
                            Praktik Kerja Lapangan (PKL) mahasiswa mulai dari pendaftaran, pengawasan, hingga penilaian.
                            Dengan fitur yang interaktif dan efisien, mahasiswa, dosen pembimbing, dan admin dapat
                            berkolaborasi secara efektif dalam menjalankan proses PKL secara digital.</p>

                        <div class="row feature-list-wrapper">
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Pendaftaran PKL Online</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Manajemen Bimbingan dan Penilian</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Pembuatan Surat Tugas Otomatis</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="feature-list">
                                    <li><i class="bi bi-check-circle-fill"></i> Dashboard Untuk Setiap Role Pengguna
                                    </li>
                                    <li><i class="bi bi-check-circle-fill"></i> Monitoring Status Mahasiswa PKL</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Efisiensi Waktu dan Proses Administrasi
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="info-wrapper">
                            <div class="row gy-4">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-wrapper">
                            <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                                <img src="assets/img/about-5.webp" alt="Business Meeting"
                                    class="img-fluid main-image rounded-4">
                                <img src="assets/img/about-2.webp" alt="Team Discussion"
                                    class="img-fluid small-image rounded-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /About Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Fitur Unggulan</h2>
                <p>Berbagai fitur yang dirancang untuk mempermudah proses pendaftaran, bimbingan, hingga penilaian
                    Praktik Kerja Lapangan mahasiswa secara efisien dan terintegrasi.</p>
            </div>
            <!-- End Section Title -->

            <div class="container">

                <div class="d-flex justify-content-center">

                    <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                                <h4>Pendaftaran</h4>
                            </a>
                        </li>
                        <!-- End tab nav item -->

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                                <h4>Bimbingan</h4>
                            </a>
                            <!-- End tab nav item -->

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                                <h4>Penilaian</h4>
                            </a>
                        </li>
                        <!-- End tab nav item -->
                    </ul>
                </div>

                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                    <div class="tab-pane fade active show" id="features-tab-1">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Pendaftaran PKL Secara Online</h3>
                                <p class="fst-italic">
                                    Mahasiswa dapat dengan mudah melakukan pendaftaran PKL tanpa perlu mengisi formulir
                                    manual. Semua data langsung tersimpan dan dapat diverifikasi oleh admin.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Sistem validasi otomatis data
                                            mahasiswa.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Upload dokumen persyaratan PKL.</span>
                                    </li>
                                    <li><i class="bi bi-check2-all"></i> <span>Status pendaftaran bisa dipantau secara
                                            real-time.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-illustration-1.webp" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                    <div class="tab-pane fade" id="features-tab-2">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Bimbingan dan Monitoring Dosen</h3>
                                <p class="fst-italic">
                                    Dosen pembimbing dapat mencatat bimbingan, memberikan evaluasi, serta melihat
                                    perkembangan mahasiswa selama PKL berlangsung melalui dashboard yang interaktif.
                                </p>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Input catatan bimbingan langsung di
                                            sistem.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Monitoring kegiatan mahasiswa di tempat
                                            PKL.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Sistem notifikasi jika ada perubahan
                                            status.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Terintegrasi dengan logbook PKL.</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-illustration-2.webp" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                    <div class="tab-pane fade" id="features-tab-3">
                        <div class="row">
                            <div
                                class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                                <h3>Penilaian dan Laporan Otomatis</h3>
                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Penilaian terstruktur berdasarkan
                                            indikator kinerja.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Rekap nilai otomatis untuk semua
                                            mahasiswa.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Export laporan akhir dalam format
                                            PDF.</span></li>
                                </ul>
                                <p class="fst-italic">
                                    Setelah PKL selesai, dosen dapat langsung mengisi penilaian secara digital. Sistem
                                    juga membantu menyusun laporan akhir PKL mahasiswa dengan lebih cepat.
                                </p>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="assets/img/features-illustration-3.webp" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div><!-- End tab content item -->

                </div>

            </div>

        </section><!-- /Features Section -->

        <!-- Features Cards Section -->
        <section id="features-cards" class="features-cards section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="feature-box orange">
                            <i class="bi bi-award"></i>
                            <h4>Pendaftaran PKL</h4>
                            <p>Mahasiswa dapat mendaftar PKL secara online dan memantau status pengajuan dengan mudah
                                dan cepat.</p>
                        </div>
                    </div><!-- End Feature Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="feature-box blue">
                            <i class="bi bi-patch-check"></i>
                            <h4>Monitoring Bimbingan</h4>
                            <p>Dosen pembimbing dan mahasiswa dapat melakukan bimbingan secara terstruktur dan
                                terdokumentasi.</p>
                        </div>
                    </div><!-- End Feature Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="feature-box green">
                            <i class="bi bi-sunrise"></i>
                            <h4>Penjadwalan Seminar</h4>
                            <p>Jadwal seminar PKL ditampilkan secara real-time untuk memudahkan koordinasi antar pihak.
                            </p>
                        </div>
                    </div><!-- End Feature Borx-->

                    <div class="col-xl-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="feature-box red">
                            <i class="bi bi-shield-check"></i>
                            <h4>Penilaian Otomatis</h4>
                            <p>Dosen dapat memberikan nilai langsung melalui sistem, dan mahasiswa bisa melihat hasilnya
                                dengan transparan.</p>
                        </div>
                    </div><!-- End Feature Borx-->

                </div>

            </div>

        </section>
        <!-- /Features Cards Section -->

        <!-- Clients Section -->
        {{-- <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Clients Section --> --}}

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimonials</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            <!-- End Section Title -->

            <div class="container">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                    rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam,
                                    risus at semper.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                    cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet
                                    legam anim culpa.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                    veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                    minim.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="testimonial-item">
                            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem
                                    dolore labore illum veniam.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                </div>

            </div>

        </section>
        <!-- /Testimonials Section -->

        <!-- Faq Section -->
        <section class="faq-9 faq section light-background" id="faq">

            <div class="container">
                <div class="row">

                    <div class="col-lg-5" data-aos="fade-up">
                        <h2 class="faq-title">Punya Pertanyaan? Lihat FAQ Kami</h2>
                        <p class="faq-description">Pertanyaan umum seputar penggunaan Sistem Informasi Manajemen PKL
                            Terpadu (SiMantep).</p>
                        <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                            <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>Apa itu SiMantep?</h3>
                                <div class="faq-content">
                                    <p>SiMantep adalah sistem informasi manajemen tempat PKL untuk mahasiswa, dosen, dan
                                        admin. Sistem ini memudahkan proses pemilihan instansi dan pengajuan instansi
                                        non-mitra.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Siapa saja yang bisa menggunakan SiMantep?</h3>
                                <div class="faq-content">
                                    <p>Mahasiswa, dosen pembimbing, dan admin kampus. Masing-masing memiliki hak akses
                                        dan fitur yang berbeda.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Bagaimana cara mengajukan instansi non-mitra?</h3>
                                <div class="faq-content">
                                    <p>Mahasiswa dapat mengisi form pengajuan instansi non-mitra pada dashboard. Setelah
                                        itu, sistem akan memproses dan menampilkan surat pengajuan otomatis dalam format
                                        PDF.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Bagaimana cara mencetak surat pengajuan otomatis?</h3>
                                <div class="faq-content">
                                    <p>Setelah pengajuan disetujui oleh dosen, mahasiswa dapat mencetak surat pengajuan
                                        dengan klik tombol "Cetak Surat" di dashboard.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apakah saya bisa mengganti instansi PKL setelah disetujui?</h3>
                                <div class="faq-content">
                                    <p>Bisa, namun harus ada alasan kuat dan mendapat persetujuan ulang dari dosen
                                        pembimbing dan admin.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Saya lupa password, apa yang harus saya lakukan?</h3>
                                <div class="faq-content">
                                    <p>Gunakan fitur "Lupa Password" di halaman login dan ikuti instruksi untuk reset
                                        password melalui email.x</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /Faq Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Hubungi kami untuk pertanyaan, kerja sama, atau informasi lebih lanjut seputar layanan kami.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-4 g-lg-5">
                    <div class="col-lg-5">
                        <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                            <h3>Contact Info</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante
                                ipsum primis.</p>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="icon-box">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div class="content">
                                    <h4>Our Location</h4>
                                    <p>A108 Adam Street</p>
                                    <p>New York, NY 535022</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="icon-box">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div class="content">
                                    <h4>Phone Number</h4>
                                    <p>+1 5589 55488 55</p>
                                    <p>+1 6678 254445 41</p>
                                </div>
                            </div>

                            <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="icon-box">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div class="content">
                                    <h4>Email Address</h4>
                                    <p>info@example.com</p>
                                    <p>contact@example.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                            <h3>Get In Touch</h3>
                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante
                                ipsum primis.</p>

                            <form action="forms/contact.php" method="post" class="php-email-form"
                                data-aos="fade-up" data-aos-delay="200">
                                <div class="row gy-4">

                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Your Name" required="">
                                    </div>

                                    <div class="col-md-6 ">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Your Email" required="">
                                    </div>

                                    <div class="col-12">
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subject" required="">
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="loading">Loading</div>
                                        <div class="error-message"></div>
                                        <div class="sent-message">Your message has been sent. Thank you!</div>

                                        <button type="submit" class="btn">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="#hero" class="logo d-flex align-items-center">
                        <span class="sitename">iLanding</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Web Design</a></li>
                        <li><a href="#">Web Development</a></li>
                        <li><a href="#">Product Management</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Hic solutasetp</h4>
                    <ul>
                        <li><a href="#">Molestiae accusamus iure</a></li>
                        <li><a href="#">Excepturi dignissimos</a></li>
                        <li><a href="#">Suscipit distinctio</a></li>
                        <li><a href="#">Dilecta</a></li>
                        <li><a href="#">Sit quas consectetur</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Nobis illum</h4>
                    <ul>
                        <li><a href="#">Ipsam</a></li>
                        <li><a href="#">Laudantium dolorum</a></li>
                        <li><a href="#">Dinera</a></li>
                        <li><a href="#">Trodelas</a></li>
                        <li><a href="#">Flexo</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">iLanding</strong> <span>All Rights
                    Reserved</span></p>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed By <a
                    href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
