<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Masuk - SIPFASKA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
      --primary-color: #1D4ED8;
      --primary-hover: #1e40af;
      --navy-overlay: rgba(10, 37, 64, 0.85);
    }

    body {
      font-family: 'Inter', sans-serif;
      height: 100vh;
      overflow: hidden;
    }

    .bg-side {
      background: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1000&auto=format&fit=crop') no-repeat center center;
      background-size: cover;
      position: relative;
    }

    .bg-side::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      background-color: var(--navy-overlay);
      z-index: 1;
    }

    .bg-content {
      position: relative;
      z-index: 2;
    }

    .login-section {
      background-color: #ffffff;
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow-y: auto;
    }

    .form-control {
      padding: 12px 16px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-size: 0.95rem;
    }

    .form-control:focus {
      box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.15);
      border-color: var(--primary-color);
    }

    .btn-login {
      background-color: var(--primary-color);
      border: 1px solid var(--primary-color);
      color: white;
      padding: 12px;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background-color: var(--primary-hover) !important;
      border-color: var(--primary-hover) !important;
      color: white !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
    }

    .btn-login:active,
    .btn-login:focus {
      background-color: var(--primary-hover) !important;
      border-color: var(--primary-hover) !important;
      color: white !important;
      box-shadow: none;
    }

    .brand-icon {
      width: 50px;
      height: 50px;
      background: var(--primary-color);
      color: white;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .footer-link {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
    }

    .footer-link:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>

  <div class="container-fluid g-0">
    <div class="row g-0">
      <div class="col-lg-7 d-none d-lg-flex bg-side align-items-center justify-content-center text-center px-5 vh-100">
        <div class="bg-content text-white">
          <h1 class="fw-bold display-5 mb-3">Selamat Datang di SIPFASKA</h1>
          <p class="lead fw-light opacity-75 mb-0" style="max-width: 500px; margin: 0 auto;">
            Sistem Informasi Pengaduan Fasilitas Kampus. <br>
            Laporkan kendala fasilitas dengan mudah, cepat, dan transparan.
          </p>
        </div>
      </div>

      <div class="col-lg-5 login-section position-relative">
        <div class="d-flex flex-column justify-content-center h-100 px-4 px-md-5 mx-auto"
          style="width: 100%; max-width: 550px;">
          <div class="mb-4">
            <div class="brand-icon shadow-sm">
              <i class="fa-solid fa-city"></i>
            </div>
            <h3 class="fw-bold text-dark">Login Akun</h3>
            <p class="text-secondary">Silakan masuk untuk mengelola laporan.</p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center p-2 mb-4 rounded-3 small" role="alert">
              <i class="fa-solid fa-triangle-exclamation me-2"></i>
              <div>{{ $errors->first() }}</div>
            </div>
          @endif

          <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-3">
              <label class="form-label small fw-bold text-uppercase text-secondary">Email atau NIM</label>
              <input type="text" name="username" class="form-control" placeholder="Masukan email atau nim" required
                autofocus>
            </div>

            <div class="mb-4">
              <div class="d-flex justify-content-between">
                <label class="form-label small fw-bold text-uppercase text-secondary">Password</label>
              </div>
              <div class="input-group">
                <input type="password" name="password" id="password" class="form-control border-end-0"
                  placeholder="Masukkan kata sandi" required>
                <span class="input-group-text bg-white border-start-0" style="cursor: pointer;"
                  onclick="togglePassword()">
                  <i class="fa-solid fa-eye-slash text-muted" id="toggleIcon"></i>
                </span>
              </div>
            </div>

            <button type="submit" class="btn btn-login w-100 shadow-sm">
              Masuk Sekarang
              <i class="fa-solid fa-arrow-right ms-2"></i>
            </button>
          </form>
        </div>

        <div class="text-center py-4">
          <small class="text-muted">
            Published by <a href="https://www.adammiftah.com" target="_blank" class="footer-link">www.adammiftah.com</a>
          </small>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      }
    }
  </script>
</body>

</html>