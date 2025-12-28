@extends('layouts.app')
@section('title', 'Riwayat Pengaduan')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold text-dark mb-1">Riwayat Pengaduan</h4>
        <p class="text-muted small mb-0">Arsip laporan yang telah selesai ditangani atau ditolak.</p>
      </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
      <div class="card-body p-4">
        <form action="{{ route('petugas.pengaduan.riwayat') }}" method="GET">
          <div class="row g-3 align-items-end">

            <div class="col-lg-10 col-md-9">
              <label class="form-label fw-bold text-secondary small">PENCARIAN</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0 bg-light" placeholder="Cari data..."
                  value="{{ request('search') }}">
              </div>
            </div>

            <div class="col-lg-2 col-md-3">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill shadow-sm">
                  <i class="fa-solid fa-filter me-1"></i> Cari
                </button>
                <a href="{{ route('petugas.pengaduan.riwayat') }}" class="btn btn-outline-secondary shadow-sm"
                  title="Reset">
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
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="20%">Pelapor</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="20%">Lokasi</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="5%">Bukti</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold">Deskripsi</th>
                <th class="px-4 py-3 text-uppercase text-secondary small fw-bold text-center" width="10%">Status
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($pengaduans as $key => $p)
                <tr>
                  <td class="px-4 text-muted fw-bold">{{ $pengaduans->firstItem() + $key }}</td>

                  <td>
                    <div class="d-flex flex-column">
                      <span class="fw-semibold text-dark small text-truncate">{{ $p->created_at->format('d M Y') }}</span>
                      <small class="text-muted">{{ $p->created_at->format('H:i') }} WIB</small>
                    </div>
                  </td>

                  <td>
                    <div class="d-flex flex-column">
                      <span class="fw-bold text-dark small text-truncate">{{ $p->mahasiswa->nama }}</span>
                      <small class="text-muted font-monospace">{{ $p->mahasiswa->nim }}</small>
                    </div>
                  </td>

                  <td>
                    <span class="badge bg-light text-dark border fw-normal px-2 py-1 text-wrap text-start lh-sm">
                      <i class="fa-solid fa-location-dot text-danger me-1"></i> {{ $p->lokasi }}
                    </span>
                  </td>

                  <td class="text-center">
                    @if($p->foto)
                      <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-3 border shadow-sm" width="40" height="40"
                        style="object-fit: cover; cursor: pointer;" data-bs-toggle="modal"
                        data-bs-target="#modalRiwayat{{ $p->id }}" title="Lihat Foto">

                      <div class="modal fade" id="modalRiwayat{{ $p->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content bg-transparent border-0">
                            <div class="modal-body text-center position-relative">
                              <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                data-bs-dismiss="modal"></button>
                              <img src="{{ asset('storage/' . $p->foto) }}" class="img-fluid rounded shadow-lg">
                            </div>
                          </div>
                        </div>
                      </div>
                    @else
                      <span class="text-muted opacity-50">-</span>
                    @endif
                  </td>

                  <td>
                    <span class="text-muted small d-inline-block text-truncate" style="max-width: 200px;"
                      title="{{ $p->deskripsi }}">
                      {{ $p->deskripsi }}
                    </span>
                  </td>

                  <td class="text-center px-4">
                    @if($p->status == 'selesai')
                      <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3 py-2">
                        <i class="fa-solid fa-circle-check"></i> Selesai
                      </span>
                    @else
                      <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger px-3 py-2">
                        <i class="fa-solid fa-circle-xmark"></i> Ditolak
                      </span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center opacity-50">
                      <i class="fa-solid fa-file-circle-xmark fs-1 mb-2"></i>
                      <span class="fw-bold">Tidak ada riwayat pengaduan.</span>
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
    .bg-success-subtle {
      background-color: #d1e7dd !important;
    }

    .bg-danger-subtle {
      background-color: #f8d7da !important;
    }
  </style>
@endsection