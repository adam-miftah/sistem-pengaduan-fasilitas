@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
    <div class="container-fluid px-4 py-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Dashboard Overview</h4>
                <p class="text-muted small mb-0">Ringkasan performa sistem pengaduan fasilitas kampus.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <div
                    class="d-inline-flex align-items-center bg-white border rounded-pill px-3 py-2 shadow-sm text-secondary small">
                    <i class="fa-solid fa-calendar-day me-2 text-primary"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="icon-box bg-soft-primary text-primary rounded-4 me-3">
                            <i class="fa-solid fa-user-graduate fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Mahasiswa</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalMahasiswa }}</h3>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100"
                        style="height: 3px; background: var(--bs-primary);">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-4 me-3">
                            <i class="fa-solid fa-user-shield fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Petugas</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalPetugas }}</h3>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100"
                        style="height: 3px; background: var(--bs-warning);"></div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-4 me-3">
                            <i class="fa-solid fa-clipboard-list fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Total Laporan</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $totalPengaduan }}</h3>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: var(--bs-info);">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden card-hover">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-4 me-3">
                            <i class="fa-solid fa-circle-check fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small text-uppercase fw-bold mb-1 ls-1">Selesai</p>
                            <h3 class="fw-bold text-dark mb-0">{{ $pengaduanSelesai }}</h3>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100"
                        style="height: 3px; background: var(--bs-success);"></div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-dark m-0">
                            <i class="fa-solid fa-chart-column text-primary me-2"></i> Statistik Bulanan ({{ date('Y') }})
                        </h6>
                        <button class="btn btn-sm btn-light text-muted border-0 rounded-circle" title="Unduh Data">
                            <i class="fa-solid fa-download"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div style="position: relative; height: 300px; width: 100%;">
                            <canvas id="chartBulanan"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="fw-bold text-dark m-0">
                            <i class="fa-solid fa-chart-pie text-primary me-2"></i> Distribusi Status
                        </h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">

                        <div style="position: relative; height: 200px; width: 100%;" class="mb-4">
                            <canvas id="chartStatus"></canvas>
                            <div class="position-absolute top-50 start-50 translate-middle text-center">
                                <h5 class="fw-bold text-dark mb-0">{{ $totalPengaduan }}</h5>
                                <small class="text-muted" style="font-size: 0.7rem;">Total</small>
                            </div>
                        </div>

                        <div class="w-100 px-2">
                            <div
                                class="d-flex justify-content-between align-items-center mb-2 p-2 rounded-3 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle text-secondary me-2" style="font-size: 8px;"></i>
                                    <span class="small fw-semibold text-muted">Diajukan</span>
                                </div>
                                <span class="fw-bold text-dark small">{{ $dataStatus[0] ?? 0 }}</span>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center mb-2 p-2 rounded-3 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle text-warning me-2" style="font-size: 8px;"></i>
                                    <span class="small fw-semibold text-muted">Diproses</span>
                                </div>
                                <span class="fw-bold text-dark small">{{ $dataStatus[1] ?? 0 }}</span>
                            </div>
                            <div
                                class="d-flex justify-content-between align-items-center p-2 rounded-3 bg-light bg-opacity-50">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-circle text-success me-2" style="font-size: 8px;"></i>
                                    <span class="small fw-semibold text-muted">Selesai</span>
                                </div>
                                <span class="fw-bold text-dark small">{{ $dataStatus[2] ?? 0 }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        .ls-1 {
            letter-spacing: 0.5px;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }

        .bg-soft-primary {
            background-color: rgba(29, 78, 216, 0.1) !important;
            color: var(--primary-color) !important;
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.15) !important;
            color: #856404 !important;
        }

        .bg-soft-success {
            background-color: rgba(25, 135, 84, 0.1) !important;
            color: #0f5132 !important;
        }

        .bg-soft-info {
            background-color: rgba(13, 202, 240, 0.1) !important;
            color: #0dcaf0 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxBulan = document.getElementById('chartBulanan').getContext('2d');

        const gradient = ctxBulan.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 110, 253, 0.7)');
        gradient.addColorStop(1, 'rgba(13, 110, 253, 0.1)');

        new Chart(ctxBulan, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pengaduan',
                    data: {{ json_encode($dataBulan) }},
                    backgroundColor: gradient,
                    borderRadius: 4,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [2, 4],
                            color: '#f0f0f0'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        const ctxStatus = document.getElementById('chartStatus');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Diajukan', 'Diproses', 'Selesai'],
                datasets: [{
                    data: {{ json_encode($dataStatus) }},
                    backgroundColor: ['#6c757d', '#ffc107', '#198754'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection