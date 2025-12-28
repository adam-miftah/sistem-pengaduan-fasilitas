@extends('layouts.app')
@section('title', 'Data Pengaduan')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h4 class="fw-bold mb-1 text-dark">Daftar Pengaduan</h4>
        <p class="text-muted small mb-0">Monitor dan kelola laporan masuk dari mahasiswa.</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
        <div class="d-flex align-items-center">
          <i class="fa-solid fa-circle-check fs-5 me-2"></i>
          <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

      <div class="card-header bg-white py-3 border-bottom-0 mt-2 px-4">
        <div class="row g-3 align-items-center">
          <div class="col-12 col-md-5 col-lg-4">
            <form action="{{ route('admin.pengaduan.index') }}" method="GET">
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-pill border">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search"
                  class="form-control border-start-0 ps-0 rounded-end-pill border shadow-none"
                  placeholder="Cari pelapor, lokasi..." value="{{ request('search') }}">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light border-bottom">
              <tr>
                <th class="ps-4 py-3 text-secondary text-uppercase fw-bold"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="5%">No</th>
                <th class="px-3 py-3 text-secondary text-uppercase fw-bold"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="30%">Pelapor & Tanggal</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Detail Lokasi</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Bukti</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Status</th>
                <th class="pe-4 py-3 text-secondary text-uppercase fw-bold text-end"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="10%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pengaduans as $key => $p)
                <tr>
                  <td class="ps-4 text-muted fw-semibold small">
                    {{ ($pengaduans->currentPage() - 1) * $pengaduans->perPage() + $loop->iteration }}
                  </td>

                  <td class="px-3">
                    <div class="d-flex align-items-center">
                      <div>
                        <div class="fw-bold text-dark text-truncate" style="max-width: 200px;">
                          {{ $p->mahasiswa->nama ?? 'Mahasiswa Dihapus' }}
                        </div>
                        <div class="text-secondary small">
                          <i class="fa-solid fa-calendar me-1"></i>
                          {{ \Carbon\Carbon::parse($p->created_at)->format('d M Y, H:i') }}
                        </div>
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex flex-column">
                      <span class="fw-bold text-dark">{{ $p->kategori->nama_kategori ?? '-' }}</span>
                      <span class="text-secondary small text-truncate" style="max-width: 250px;">
                        <i class="fa-solid fa-location-dot me-1 text-muted"></i> {{ $p->lokasi }}
                      </span>
                    </div>
                  </td>

                  <td>
                    @if($p->foto)
                      <div class="position-relative d-inline-block">
                        <img src="{{ asset('storage/' . $p->foto) }}"
                          class="rounded border shadow-sm object-fit-cover cursor-pointer" width="45" height="45"
                          data-bs-toggle="modal" data-bs-target="#modalFoto{{ $p->id }}" alt="Bukti">
                        <div
                          class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                          style="width: 16px; height: 16px; font-size: 8px; border: 1px solid white;">
                          <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </div>
                      </div>

                      <div class="modal fade" id="modalFoto{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content bg-transparent border-0 shadow-none">
                            <div class="modal-body p-0 text-center position-relative">
                              <button type="button"
                                class="btn-close btn-close-white position-absolute top-0 end-0 m-3 shadow-none"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                              <img src="{{ asset('storage/' . $p->foto) }}" class="img-fluid rounded shadow-lg"
                                style="max-height: 80vh;">
                            </div>
                          </div>
                        </div>
                      </div>
                    @else
                      <span class="badge bg-light text-secondary border fw-normal">Tidak ada foto</span>
                    @endif
                  </td>

                  <td>
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

                  <td class="pe-4 text-end">
                    <button type="button"
                      class="btn btn-icon btn-sm btn-light text-primary border-0 rounded-circle shadow-sm"
                      data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id }}" title="Lihat Detail & Proses">
                      <i class="fa-solid fa-eye fs-6"></i>
                    </button>

                    @include('admin.pengaduan.show', ['p' => $p])
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <div class="py-4">
                      <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-inbox text-secondary fs-3"></i>
                      </div>
                      <h6 class="text-secondary fw-bold mb-1">Tidak ada pengaduan</h6>
                      <p class="text-muted small mb-0">Belum ada laporan masuk yang sesuai dengan pencarian Anda.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($pengaduans->hasPages())
        <div class="card-footer bg-white py-3 border-top-0">
          <div class="d-flex justify-content-end">
            {{ $pengaduans->withQueryString()->links() }}
          </div>
        </div>
      @endif

    </div>
  </div>

  <style>
    .cursor-pointer {
      cursor: pointer;
    }

    .btn-icon {
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .btn-icon:hover {
      transform: translateX(3px);
      background-color: var(--primary-color) !important;
      color: white !important;
    }

    .page-link {
      border-radius: 50% !important;
      margin: 0 3px;
      color: #6c757d;
      border: none;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .page-item.active .page-link {
      background-color: var(--primary-color);
      color: white;
      font-weight: bold;
    }

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