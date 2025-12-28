<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPFASKA - Sistem Pengaduan Fasilitas Kampus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy-primary: #0A2540;
            --navy-dark: #081C33;
            --blue-accent: #1D4ED8;
            --blue-soft: #eff6ff;
            --text-body: #334155;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-body);
            overflow-x: hidden;
            background-color: #ffffff;
        }

        .text-accent {
            color: var(--blue-accent) !important;
        }

        .bg-accent {
            background-color: var(--blue-accent) !important;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            transition: all 0.3s;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--navy-primary) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--navy-primary) !important;
            font-weight: 500;
            margin: 0 10px;
            font-size: 0.95rem;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--blue-accent) !important;
        }

        .btn-nav-login {
            background-color: var(--navy-primary);
            color: white !important;
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-nav-login:hover {
            background-color: var(--blue-accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.2);
        }

        .hero {
            padding: 140px 0 80px 0;
            background: linear-gradient(180deg, #ffffff 0%, var(--blue-soft) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.15;
            color: var(--navy-primary);
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2.5rem;
            max-width: 550px;
        }

        .btn-primary-custom {
            background-color: var(--blue-accent);
            color: white;
            padding: 14px 40px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 10px 20px -5px rgba(29, 78, 216, 0.4);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary-custom:hover {
            background-color: #1e40af;
            transform: translateY(-3px);
            color: white;
        }

        .hero-image-container {
            position: relative;
            z-index: 1;
        }

        .hero-image {
            border-radius: 24px;
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: scale(1.02);
        }

        .floating-card {
            position: absolute;
            bottom: 30px;
            left: -20px;
            max-width: 220px;
            z-index: 2;
            background: white;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .stat-card {
            border-left: 4px solid var(--blue-accent);
            padding-left: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--navy-primary);
            line-height: 1;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .feature-card {
            background: var(--blue-soft);
            padding: 40px 30px;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            background-color: var(--blue-soft);
            color: var(--blue-accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .step-item {
            position: relative;
            padding: 20px;
            text-align: center;
        }

        .step-badge {
            width: 50px;
            height: 50px;
            background: white;
            border: 2px solid var(--blue-accent);
            color: var(--blue-accent);
            font-weight: 800;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
        }

        @media (min-width: 992px) {
            .step-item::after {
                content: '';
                position: absolute;
                top: 45px;
                left: 50%;
                width: 100%;
                height: 2px;
                background-color: #e2e8f0;
                z-index: 1;
            }

            .step-item:last-child::after {
                display: none;
            }
        }

        footer {
            background-color: var(--navy-dark);
            color: #cbd5e1;
            padding: 60px 0 30px 0;
        }

        .footer-heading {
            color: white;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .footer-link {
            color: #cbd5e1;
            text-decoration: none;
            margin-bottom: 0.8rem;
            display: block;
            transition: 0.2s;
        }

        .footer-link:hover {
            color: var(--blue-accent);
            padding-left: 5px;
        }

        .social-link {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-link:hover {
            background-color: var(--blue-accent);
            color: white;
            transform: translateY(-3px);
        }

        .maps-container {
            width: 100%;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .maps-container:hover {
            transform: scale(1.02);
        }

        .maps-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .maps-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .maps-container:hover .maps-overlay {
            opacity: 1;
        }

        .maps-frame {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 991px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-section {
                padding-top: 100px;
                text-align: center;
            }

            .hero-subtitle {
                margin: 0 auto 2rem auto;
            }

            .stat-card {
                border-left: none;
                border-bottom: 4px solid var(--blue-accent);
                padding-left: 0;
                padding-bottom: 15px;
                margin-bottom: 20px;
                text-align: center;
            }

            .hero-btn-group {
                justify-content: center;
            }

            .hero-image-container {
                margin-top: 50px;
            }

            .floating-card {
                display: none;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <i class="fa-solid fa-city text-primary"></i> SIPFASKA
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Keunggulan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alur">Alur Laporan</a></li>
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-nav-login px-4">
                            Login Sistem
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <span class="fw-bold text-accent text-uppercase small letter-spacing-2 mb-2 d-block">Sistem
                        Pengaduan Terpadu</span>
                    <h1 class="hero-title">
                        Suara Anda untuk <br>
                        <span class="text-accent position-relative">
                            Fasilitas Kampus
                            <svg class="position-absolute start-0 bottom-0 w-100" height="10" viewBox="0 0 200 9"
                                fill="none" xmlns="http://www.w3.org/2000/svg" style="z-index: -1; opacity: 0.3;">
                                <path
                                    d="M2.00025 6.99997C2.00025 6.99997 23.3659 0.0454665 67.5334 1.26582C111.701 2.48617 183.197 7.61861 197.801 4.48263"
                                    stroke="#2563eb" stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </span>
                        Lebih Baik
                    </h1>
                    <p class="hero-subtitle">
                        Temukan kerusakan? Laporkan sekarang. Kami menjamin setiap laporan diproses secara transparan
                        demi kenyamanan kegiatan belajar mengajar.
                    </p>
                    <div class="d-flex gap-3 hero-btn-group">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            Lapor Kerusakan <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#alur" class="btn btn-light border fw-bold px-4 py-3 rounded-3">
                            Cara Kerja
                        </a>
                    </div>

                    <div class="row mt-5 pt-4">
                        <div class="col-6 col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">1.2K</div>
                                <div class="stat-label">Laporan Masuk</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="stat-card">
                                <div class="stat-number">98%</div>
                                <div class="stat-label">Terselesaikan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-image-container">
                    <div class="position-relative mt-lg-n2" style="margin-top: -200px;">
                        <img src="{{ asset('images/landing-hero.jpg') }}" alt="Ilustrasi SIPFASKA"
                            class="img-fluid hero-image w-100" width="200" height="200">
                        <div class="floating-card">
                            <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px;">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="lh-1">
                                <span class="d-block fw-bold small text-dark">Laporan Selesai</span>
                                <small class="text-muted" style="font-size: 10px;">Baru saja</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <small class="text-primary fw-bold text-uppercase letter-spacing-1">Mengapa SIPFASKA?</small>
                <h2 class="fw-bold text-dark mt-2">Layanan Pengaduan Modern</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-bolt-lightning"></i>
                        </div>
                        <h5 class="fw-bold mb-3 text-dark">Respon Cepat</h5>
                        <p class="text-muted mb-0">
                            Setiap laporan yang masuk akan langsung dinotifikasi ke petugas terkait untuk penanganan
                            segera.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <h5 class="fw-bold mb-3 text-dark">Akses Mudah</h5>
                        <p class="text-muted mb-0">
                            Platform berbasis web yang responsif, dapat diakses melalui Smartphone, Tablet, maupun
                            Laptop.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h5 class="fw-bold mb-3 text-dark">Transparan</h5>
                        <p class="text-muted mb-0">
                            Mahasiswa dapat memantau progres perbaikan fasilitas secara realtime melalui dashboard.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="alur" class="py-5" style="background-color: var(--blue-soft)">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark">Alur Pengaduan</h2>
                <p class="text-muted">4 Langkah mudah melaporkan fasilitas.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <div class="col-md-3 col-6 step-item">
                            <div class="step-badge">1</div>
                            <h6 class="fw-bold">Login</h6>
                            <p class="small text-muted">Masuk ke sistem</p>
                        </div>
                        <div class="col-md-3 col-6 step-item">
                            <div class="step-badge">2</div>
                            <h6 class="fw-bold">Tulis Laporan</h6>
                            <p class="small text-muted">Isi detail & foto</p>
                        </div>
                        <div class="col-md-3 col-6 step-item">
                            <div class="step-badge">3</div>
                            <h6 class="fw-bold">Proses</h6>
                            <p class="small text-muted">Validasi & perbaikan</p>
                        </div>
                        <div class="col-md-3 col-6 step-item">
                            <div class="step-badge bg-accent text-white border-0"
                                style="background: var(--blue-accent); color: white;">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <h6 class="fw-bold text-accent">Selesai</h6>
                            <p class="small text-muted">Laporan ditutup</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-4">
                    <h4 class="text-white fw-bold d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-city text-primary"></i> SIPFASKA
                    </h4>
                    <p class="text-white-50 small" style="line-height: 1.8;">
                        Sistem Informasi Pengaduan Fasilitas Kampus bertujuan untuk menciptakan lingkungan belajar yang
                        nyaman dengan melibatkan peran aktif civitas akademika.
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="https://www.instagram.com/_adammiftah?igsh=MTljeW9la3lqMzA4eg==" class="social-link"
                            title="Instagram" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="http://tiktok.com/@userrr_default" class="social-link" title="TikTok" target="_blank">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/adam-miftah-00789a33b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
                            class="social-link" title="LinkedIn" target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="https://github.com/adam-miftah" class="social-link" title="GitHub" target="_blank">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h6 class="footer-heading">Navigasi</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#home" class="footer-link">Beranda</a></li>
                        <li><a href="#features" class="footer-link">Fitur Utama</a></li>
                        <li><a href="#alur" class="footer-link">Alur Laporan</a></li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h6 class="footer-heading">Hubungi Kami</h6>
                            <ul class="list-unstyled text-white-50 small mb-0">
                                <li class="mb-3">
                                    <a href="https://maps.app.goo.gl/qb2M8itZypbuJH678" target="_blank"
                                        class="text-decoration-none text-white-50 d-flex align-items-start gap-2 hover-text-primary">
                                        <i class="fa-solid fa-location-dot mt-1 text-primary"></i>
                                        <span>Jl. Raya Puspitek, Buaran, Kec. Pamulang, Kota Tangerang Selatan, Banten
                                            15310</span>
                                    </a>
                                </li>
                                <li class="mb-3">
                                    <a href="mailto:suarakampus@gmail.com"
                                        class="text-decoration-none text-white-50 d-flex align-items-center gap-2 hover-text-primary">
                                        <i class="fa-solid fa-envelope text-primary"></i>
                                        <span>suarakampus@gmail.com</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:+6281319310355"
                                        class="text-decoration-none text-white-50 d-flex align-items-center gap-2 hover-text-primary">
                                        <i class="fa-solid fa-phone text-primary"></i>
                                        <span>+62 813-1931-0355</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="footer-heading">Lokasi Kampus</h6>
                            <div class="maps-frame">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8217.727317529689!2d106.69420920768805!3d-6.3476469602049335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e5a6e26dc3cd%3A0xccd6344b8021119d!2sUniversitas%20Pamulang%20Kampus%202%20(UNPAM%20Viktor)!5e0!3m2!1sid!2sid!4v1766830039354!5m2!1sid!2sid"
                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="border-top border-white border-opacity-10 pt-4 mt-5 d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-3">
                <div class="text-white-50 small">
                    <span class="fw-semibold text-white">© {{ date('Y') }} SIPFASKA.</span>
                    <span class="d-none d-md-inline mx-1">|</span>
                    All rights reserved.
                </div>
                <div class="small">
                    <span class="text-white-50 me-1" style="letter-spacing: 0.5px; font-size: 0.7rem;">PUBLISHED
                        BY</span>
                    <a href="https://www.adammiftah.com" target="_blank"
                        class="text-decoration-none fw-bold text-primary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">
                        www.adammiftah.com
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-sm');
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.classList.remove('shadow-sm');
                navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            }
        });
        if (performance.getEntriesByType("navigation")[0].type === "reload") {
            window.location.href = "{{ url('/') }}";
        } else {
            if (window.location.hash) {
                history.replaceState(null, null, ' ');
                window.scrollTo(0, 0);
            }
        }
    </script>
</body>

</html>
</body>

</html>