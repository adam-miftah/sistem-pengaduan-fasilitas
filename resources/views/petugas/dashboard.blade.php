@extends('layouts.app')
@section('title', 'Dashboard Petugas')

@section('content')
  <div class="container-fluid px-4 py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h4 class="fw-bold text-dark mb-1">Dashboard</h4>
        <p class="text-muted small mb-0">
          Selamat datang, <span class="fw-semibold text-primary">{{ auth()->user()->name }}</span>.
        </p>
      </div>
      <div class="mt-3 mt-md-0">
        <span class="badge bg-white text-secondary border shadow-sm px-3 py-2 fw-normal">
          <i class="fa-solid fa-calendar-day me-2"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </span>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 h-100 position-relative overflow-hidden card-stat">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-square bg-soft-danger text-danger rounded-3 me-3">
              <i class="fa-solid fa-inbox fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Pengaduan Masuk</p>
              <h3 class="fw-bold text-dark mb-0">{{ $masuk }}</h3>
            </div>
          </div>
          <a href="{{ route('petugas.pengaduan.index', ['status' => 'diajukan']) }}" class="stretched-link"></a>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: #dc3545;"></div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 h-100 position-relative overflow-hidden card-stat">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-square bg-soft-warning text-warning rounded-3 me-3">
              <i class="fa-solid fa-arrows-rotate fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Sedang Diproses</p>
              <h3 class="fw-bold text-dark mb-0">{{ $diproses }}</h3>
            </div>
          </div>
          <a href="{{ route('petugas.pengaduan.index', ['status' => 'diproses']) }}" class="stretched-link"></a>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: #ffc107;"></div>
        </div>
      </div>

      <div class="col-12 col-sm-12 col-xl-4">
        <div class="card border-0 shadow-sm rounded-3 h-100 position-relative overflow-hidden card-stat">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-square bg-soft-success text-success rounded-3 me-3">
              <i class="fa-solid fa-circle-check fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Selesai</p>
              <h3 class="fw-bold text-dark mb-0">{{ $selesai }}</h3>
            </div>
          </div>
          <a href="{{ route('petugas.pengaduan.index', ['status' => 'selesai']) }}" class="stretched-link"></a>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: #198754;"></div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 h-100">
          <div class="card-header bg-white py-3 border-bottom-0">
            <h6 class="fw-bold m-0 text-secondary">Akses Cepat</h6>
          </div>
          <div class="card-body">
            <div class="row g-2">

              <div class="col-md-4">
                <a href="{{ route('petugas.pengaduan.index') }}"
                  class="btn btn-outline-light text-dark border w-100 text-start p-3 d-flex align-items-center gap-3 hover-shadow h-100">
                  <div
                    class="bg-soft-primary text-primary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width: 45px; height: 45px;">
                    <i class="fa-solid fa-table fs-5"></i>
                  </div>
                  <div class="lh-1">
                    <span class="d-block fw-semibold text-dark mb-1">Semua Data</span>
                    <small class="text-muted" style="font-size: 0.7rem;">Lihat tabel lengkap</small>
                  </div>
                </a>
              </div>

              <div class="col-md-4">
                <a href="{{ route('petugas.laporan.index') }}"
                  class="btn btn-outline-light text-dark border w-100 text-start p-3 d-flex align-items-center gap-3 hover-shadow h-100">
                  <div
                    class="bg-soft-danger text-danger rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width: 45px; height: 45px;">
                    <i class="fa-solid fa-file-pdf fs-5"></i>
                  </div>
                  <div class="lh-1">
                    <span class="d-block fw-semibold text-dark mb-1">Laporan</span>
                    <small class="text-muted" style="font-size: 0.7rem;">Cetak & Export</small>
                  </div>
                </a>
              </div>

              <div class="col-md-4">
                <a href="{{ route('petugas.profile.edit') }}"
                  class="btn btn-outline-light text-dark border w-100 text-start p-3 d-flex align-items-center gap-3 hover-shadow h-100">
                  <div
                    class="bg-soft-secondary text-secondary rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width: 45px; height: 45px;">
                    <i class="fa-solid fa-user-gear fs-5"></i>
                  </div>
                  <div class="lh-1">
                    <span class="d-block fw-semibold text-dark mb-1">Profil Saya</span>
                    <small class="text-muted" style="font-size: 0.7rem;">Update akun</small>
                  </div>
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 h-100 bg-primary text-white"
          style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
          <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
            <i class="fa-solid fa-shield-halved display-4 mb-3 opacity-50"></i>
            <h5 class="fw-bold">Sistem Aktif</h5>
            <p class="small opacity-75 mb-0">Anda login sebagai Petugas. Pastikan untuk meninjau laporan yang masuk secara
              berkala.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .bg-soft-primary {
      background-color: rgba(13, 110, 253, 0.1) !important;
      color: #0d6efd !important;
    }

    .bg-soft-danger {
      background-color: rgba(220, 53, 69, 0.1) !important;
      color: #dc3545 !important;
    }

    .bg-soft-warning {
      background-color: rgba(255, 193, 7, 0.1) !important;
      color: #ffc107 !important;
    }

    .bg-soft-success {
      background-color: rgba(25, 135, 84, 0.1) !important;
      color: #198754 !important;
    }

    .bg-soft-secondary {
      background-color: rgba(108, 117, 125, 0.1) !important;
      color: #6c757d !important;
    }

    .ls-1 {
      letter-spacing: 1px;
    }

    .icon-square {
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-stat {
      transition: transform 0.2s ease-in-out;
    }

    .card-stat:hover {
      transform: translateY(-3px);
    }

    .hover-shadow {
      transition: all 0.2s;
    }

    .hover-shadow:hover {
      background-color: #f8f9fa;
      border-color: #dee2e6 !important;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
  </style>
@endsection