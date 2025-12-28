@extends('layouts.app')
@section('title', 'Riwayat Pengaduan')

@section('content')
    <div class="container-fluid px-4 py-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">Riwayat Pengaduan</h4>
                <p class="text-muted small mb-0">Pantau status dan histori laporan yang pernah Anda ajukan.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('mahasiswa.pengaduan.create') }}"
                    class="btn btn-primary shadow-sm rounded-pill px-4 fw-bold">
                    <i class="fa-solid fa-plus me-2"></i> Buat Laporan Baru
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                <i class="fa-solid fa-circle-check fs-4 me-2"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('mahasiswa.pengaduan.index') }}" method="GET">
                    <div class="row g-3 align-items-end">

                        <div class="col-lg-10 col-md-9">
                            <label class="form-label fw-bold text-secondary small">KATA KUNCI</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i
                                        class="fa-solid fa-magnifying-glass"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 bg-light"
                                    placeholder="Cari deskripsi atau lokasi..." value="{{ request('search') }}">
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill shadow-sm">
                                    <i class="fa-solid fa-filter"></i> Cari
                                </button>
                                <a href="{{ route('mahasiswa.pengaduan.index') }}"
                                    class="btn btn-outline-secondary shadow-sm" title="Reset">
                                    <i class="fa-solid fa-rotate-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3 text-uppercase text-secondary small fw-bold" width="5%">No</th>
                                <th class="py-3 text-uppercase text-secondary small fw-bold" width="15%">Waktu</th>
                                <th class="py-3 text-uppercase text-secondary small fw-bold" width="10%">Kategori</th>
                                <th class="py-3 text-uppercase text-secondary small fw-bold" width="20%">Lokasi</th>
                                <th class="py-3 text-uppercase text-secondary small fw-bold" width="5%">Bukti</th>
                                <th class="py-3 text-uppercase text-secondary small fw-bold">Deskripsi</th>
                                <th class="px-4 py-3 text-uppercase text-secondary small fw-bold text-center" width="10%">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduans as $index => $p)
                                <tr>
                                    <td class="px-4 fw-bold text-muted">{{ $pengaduans->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold text-dark">{{ $p->created_at->format('d M Y') }}</span>
                                            <small class="text-muted">{{ $p->created_at->format('H:i') }} WIB</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-normal px-2 py-1">
                                            {{ $p->kategori->nama_kategori ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center text-dark text-wrap lh-sm">
                                            <i class="fa-solid fa-location-dot text-danger me-2 flex-shrink-0"></i>
                                            {{ $p->lokasi }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-3 border shadow-sm"
                                                width="40" height="40" style="object-fit: cover; cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#modalBukti{{ $p->id }}">

                                            <div class="modal fade" id="modalBukti{{ $p->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-transparent border-0">
                                                        <div class="modal-body text-center position-relative">
                                                            <button type="button"
                                                                class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                                                data-bs-dismiss="modal"></button>
                                                            <img src="{{ asset('storage/' . $p->foto) }}"
                                                                class="img-fluid rounded shadow-lg">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border"
                                                style="width: 40px; height: 40px;">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-inline-block text-truncate text-muted" style="max-width: 200px;"
                                            title="{{ $p->deskripsi }}">
                                            {{ $p->deskripsi }}
                                        </span>
                                    </td>
                                    <td class="text-center px-4">
                                        @php
                                            $statusConfig = match ($p->status) {
                                                'diajukan' => ['bg' => 'bg-secondary-subtle', 'text' => 'text-secondary', 'icon' => 'fa-clock'],
                                                'diproses' => ['bg' => 'bg-warning-subtle', 'text' => 'text-warning-emphasis', 'icon' => 'fa-arrows-rotate'],
                                                'selesai' => ['bg' => 'bg-success-subtle', 'text' => 'text-success', 'icon' => 'fa-circle-check'],
                                                default => ['bg' => 'bg-light', 'text' => 'text-muted', 'icon' => 'fa-circle-question']
                                            };
                                        @endphp
                                        <span
                                            class="badge rounded-pill {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} px-3 py-2 border-0">
                                            <i class="fa-solid {{ $statusConfig['icon'] }} me-1"></i> {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center opacity-50">
                                            <i class="fa-solid fa-file-circle-xmark fs-1 mb-2"></i>
                                            <span class="fw-bold">Belum ada riwayat pengaduan.</span>
                                            <small>Silakan buat pengaduan baru jika menemukan fasilitas rusak.</small>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pengaduans->hasPages())
                    <div class="card-footer bg-white py-3 border-top-0 d-flex justify-content-end">
                        {{ $pengaduans->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .bg-secondary-subtle {
            background-color: #e2e3e5 !important;
        }

        .bg-warning-subtle {
            background-color: #fff3cd !important;
        }

        .bg-success-subtle {
            background-color: #d1e7dd !important;
        }

        .text-warning-emphasis {
            color: #664d03 !important;
        }
    </style>
@endsection