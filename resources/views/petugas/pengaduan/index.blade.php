@extends('layouts.app')
@section('title', 'Daftar Pengaduan')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold text-dark mb-1">Daftar Pengaduan</h4>
        <p class="text-muted small mb-0">Kelola laporan masuk dan perbarui status pengerjaan.</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
              <tr>
                <th class="px-4 py-3 text-uppercase text-secondary small fw-bold" width="5%">No</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="20%">Pelapor & Waktu</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="15%">Lokasi</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold" width="10%">Bukti</th>
                <th class="py-3 text-uppercase text-secondary small fw-bold">Deskripsi</th>
                <th class="px-4 py-3 text-uppercase text-secondary small fw-bold text-center" width="18%">
                  Update Status
                </th>
              </tr>
            </thead>
            <tbody>
              @forelse($pengaduans as $key => $p)
                <tr>
                  <td class="px-4 text-muted fw-bold">
                    {{ $loop->iteration }}
                  </td>

                  <td>
                    <div class="d-flex flex-column">
                      <span class="fw-bold text-dark">{{ $p->mahasiswa->nama }}</span>
                      <small class="text-muted">
                        <i class="bi bi-clock me-1"></i>{{ $p->created_at->format('d M Y, H:i') }}
                      </small>
                    </div>
                  </td>

                  <td>
                    <span class="badge bg-light text-dark border fw-normal px-2 py-1">
                      <i class="bi bi-geo-alt text-danger me-1"></i> {{ $p->lokasi }}
                    </span>
                  </td>

                  <td>
                    @if($p->foto)
                      <img src="{{ asset('storage/' . $p->foto) }}" class="rounded-3 border shadow-sm" width="50" height="50"
                        style="object-fit: cover; cursor: pointer;" data-bs-toggle="modal"
                        data-bs-target="#modalFoto{{ $p->id }}" title="Klik untuk memperbesar">

                      <div class="modal fade" id="modalFoto{{ $p->id }}" tabindex="-1">
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
                      <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-image-alt"></i>
                      </div>
                    @endif
                  </td>

                  <td>
                    <span class="d-inline-block text-truncate text-muted" style="max-width: 250px;"
                      title="{{ $p->deskripsi }}">
                      {{ Str::limit($p->deskripsi, 60) }}
                    </span>
                  </td>

                  <td class="px-4">
                    <form method="POST" action="{{ route('petugas.pengaduan.status', $p->id) }}">
                      @csrf
                      @method('PATCH')

                      @php
                        $statusClass = match ($p->status) {
                          'selesai' => 'border-success text-success bg-success-subtle',
                          'diproses' => 'border-warning text-warning-emphasis bg-warning-subtle',
                          default => 'border-secondary text-secondary bg-light'
                        };
                      @endphp

                      <div class="position-relative">
                        <select name="status"
                          class="form-select form-select-sm fw-bold {{ $statusClass }} border-2 shadow-none"
                          style="cursor: pointer;"
                          onchange="if(confirm('Ubah status pengaduan ini?')) { this.form.submit() } else { location.reload() }">

                          <option value="diajukan" {{ $p->status == 'diajukan' ? 'selected' : '' }}>
                            &#9679; Diajukan
                          </option>
                          <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>
                            &#9679; Diproses
                          </option>
                          <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>
                            &#9679; Selesai
                          </option>
                        </select>
                      </div>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center opacity-50">
                      <i class="bi bi-inbox fs-1 mb-2"></i>
                      <span class="fw-bold">Tidak ada pengaduan baru.</span>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if(isset($pengaduans) && method_exists($pengaduans, 'links'))
          <div class="card-footer bg-white py-3 border-top-0 d-flex justify-content-end">
            {{ $pengaduans->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>

  <style>
    .form-select-sm {
      padding-left: 1rem;
      background-position: right 0.75rem center;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(0, 0, 0, 0.015);
    }
  </style>
@endsection