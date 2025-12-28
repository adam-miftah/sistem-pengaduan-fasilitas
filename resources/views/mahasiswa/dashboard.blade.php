@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
      <div>
        <h4 class="fw-bold text-dark mb-1">Dashboard Mahasiswa</h4>
        <p class="text-muted small mb-0">
          Halo, <span class="fw-semibold text-primary">{{ auth()->guard('mahasiswa')->user()->nama }}</span>. Selamat
          datang kembali!
        </p>
      </div>
      <div class="mt-3 mt-md-0">
        <div class="px-3 py-2 bg-white border rounded-3 shadow-sm text-secondary small">
          <i class="fa-solid fa-calendar-day me-2"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden card-hover">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-box bg-primary-subtle text-primary rounded-4 me-3">
              <i class="fa-solid fa-book-open fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Total Pengaduan</p>
              <h3 class="fw-bold text-dark mb-0">{{ $total }}</h3>
            </div>
          </div>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: var(--primary-color);">
          </div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden card-hover">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-box bg-warning-subtle text-warning rounded-4 me-3">
              <i class="fa-solid fa-hourglass-half fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Sedang Diproses</p>
              <h3 class="fw-bold text-dark mb-0">{{ $diproses }}</h3>
            </div>
          </div>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: #ffc107;"></div>
        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden card-hover">
          <div class="card-body p-4 d-flex align-items-center">
            <div class="icon-box bg-success-subtle text-success rounded-4 me-3">
              <i class="fa-solid fa-circle-check fs-4"></i>
            </div>
            <div>
              <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Selesai</p>
              <h3 class="fw-bold text-dark mb-0">{{ $selesai }}</h3>
            </div>
          </div>
          <div class="position-absolute bottom-0 start-0 w-100" style="height: 4px; background: #198754;"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white overflow-hidden position-relative">
          <div class="card-body p-4 p-lg-5 position-relative" style="z-index: 2;">
            <div class="row align-items-center">
              <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="fw-bold mb-2">Ada fasilitas yang rusak?</h3>
                <p class="mb-0 opacity-75" style="max-width: 600px;">
                  Jangan ragu untuk melapor. Laporan Anda membantu kami menjaga kenyamanan fasilitas kampus untuk semua
                  mahasiswa.
                </p>
              </div>
              <div class="col-lg-4 text-lg-end">
                <a href="{{ route('mahasiswa.pengaduan.create') }}"
                  class="btn btn-light text-primary fw-bold px-4 py-3 rounded-pill shadow-sm hover-scale">
                  <i class="fa-solid fa-plus me-2"></i> Buat Pengaduan Baru
                </a>
              </div>
            </div>
          </div>

          <i class="fa-solid fa-bullhorn position-absolute top-50 start-0 translate-middle-y ms-n5 text-white"
            style="font-size: 10rem; opacity: 0.1;"></i>

          <div class="position-absolute top-0 end-0 mt-n4 me-n4 rounded-circle bg-white"
            style="width: 200px; height: 200px; opacity: 0.1;"></div>
        </div>
      </div>
    </div>

  </div>

  <style>
    .bg-primary-subtle {
      background-color: var(--primary-soft) !important;
      color: var(--primary-color) !important;
    }

    .bg-warning-subtle {
      background-color: #fff3cd !important;
      color: #856404 !important;
    }

    .bg-success-subtle {
      background-color: #d1e7dd !important;
      color: #0f5132 !important;
    }

    .ls-1 {
      letter-spacing: 1px;
    }

    .icon-box {
      width: 56px;
      height: 56px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05) !important;
    }

    .hover-scale {
      transition: transform 0.2s;
    }

    .hover-scale:hover {
      transform: scale(1.05);
    }
  </style>
@endsection