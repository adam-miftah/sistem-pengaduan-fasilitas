@extends('layouts.app')
@section('title', 'Laporan Pengaduan')

@section('content')
  @php
    $role = strtolower(auth()->user()->role);
    $isAdmin = $role === 'admin';
    $urlFilter = $isAdmin ? route('admin.laporan.pengaduan') : route('petugas.laporan.index');
    $urlCetak = $isAdmin ? route('admin.laporan.cetak') : route('petugas.laporan.cetak');
  @endphp

  <div class="container-fluid px-4 py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h4 class="fw-bold mb-1 text-dark">Laporan & Arsip</h4>
        <p class="text-muted small mb-0">Rekapitulasi data pengaduan untuk keperluan arsip dan cetak.</p>
      </div>
      <div class="mt-3 mt-md-0">
        <form action="{{ $urlCetak }}" method="POST" target="_blank" class="d-inline">
          @csrf
          <input type="hidden" name="tgl_awal" id="print_tgl_awal" value="{{ request('tgl_awal', $tglAwal) }}">
          <input type="hidden" name="tgl_akhir" id="print_tgl_akhir" value="{{ request('tgl_akhir', $tglAkhir) }}">
          <input type="hidden" name="status" id="print_status" value="{{ request('status') }}">

          <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm fw-medium">
            <i class="fa-solid fa-file-pdf me-2"></i>Cetak PDF
          </button>
        </form>
      </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
      <div class="card-body py-3 px-4">
        <form action="{{ $urlFilter }}" method="GET">
          <div class="row g-3 align-items-center">
            <div class="col-12 col-md-auto text-secondary fw-bold small d-none d-md-block">
              <i class="fa-solid fa-filter me-1"></i> FILTER:
            </div>

            <div class="col-12 col-md">
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted ps-3 rounded-start-pill border">
                  <span class="small">Dari</span>
                </span>
                <input type="date" id="tgl_awal" name="tgl_awal"
                  class="form-control border-start-0 ps-2 rounded-end-pill border shadow-none text-secondary"
                  value="{{ request('tgl_awal', $tglAwal) }}" onchange="syncToPrint()">
              </div>
            </div>

            <div class="col-12 col-md">
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted ps-3 rounded-start-pill border">
                  <span class="small">Sampai</span>
                </span>
                <input type="date" id="tgl_akhir" name="tgl_akhir"
                  class="form-control border-start-0 ps-2 rounded-end-pill border shadow-none text-secondary"
                  value="{{ request('tgl_akhir', $tglAkhir) }}" onchange="syncToPrint()">
              </div>
            </div>

            <div class="col-12 col-md">
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted ps-3 rounded-start-pill border">
                  <i class="fa-solid fa-tag"></i>
                </span>
                <select id="status" name="status"
                  class="form-select border-start-0 ps-2 rounded-end-pill border shadow-none text-secondary"
                  onchange="syncToPrint()">
                  <option value="">- Semua Status -</option>
                  <option value="diajukan" {{ request('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                  <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                  <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
              </div>
            </div>

            <div class="col-12 col-md-auto">
              <button type="submit" class="btn btn-primary rounded-pill px-4 w-100 shadow-sm fw-medium">
                Terapkan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="bg-light border-bottom">
              <tr>
                <th class="ps-4 py-3 text-secondary text-uppercase fw-bold"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="5%">No</th>
                <th class="px-3 py-3 text-secondary text-uppercase fw-bold"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="10%">Foto</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Info Laporan</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Deskripsi</th>
                <th class="pe-4 py-3 text-secondary text-uppercase fw-bold text-center"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="15%">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pengaduans as $key => $p)
                <tr>
                  <td class="ps-4 text-muted fw-semibold small">
                    {{ $pengaduans->firstItem() + $key }}
                  </td>

                  <td class="px-3">
                    @if($p->foto)
                      <img src="{{ asset('storage/' . $p->foto) }}"
                        class="rounded shadow-sm border object-fit-cover cursor-pointer" width="45" height="45"
                        data-bs-toggle="modal" data-bs-target="#modalImg{{ $p->id }}" alt="Bukti">

                      <div class="modal fade" id="modalImg{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content bg-transparent border-0 shadow-none">
                            <div class="modal-body p-0 text-center position-relative">
                              <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                data-bs-dismiss="modal"></button>
                              <img src="{{ asset('storage/' . $p->foto) }}" class="img-fluid rounded shadow-lg"
                                style="max-height: 80vh;">
                            </div>
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border"
                        style="width: 45px; height: 45px;">
                        <i class="fa-regular fa-image"></i>
                      </div>
                    @endif
                  </td>

                  <td>
                    <div class="d-flex flex-column">
                      <span class="fw-bold text-dark">{{ $p->mahasiswa->nama ?? 'User Dihapus' }}</span>
                      <div class="text-secondary small mt-1">
                        <i class="fa-solid fa-calendar me-1"></i> {{ $p->created_at->format('d M Y') }}
                        <span class="mx-1">•</span>
                        <i class="fa-solid fa-location-dot me-1 text-danger"></i> {{ $p->lokasi }}
                      </div>
                    </div>
                  </td>

                  <td>
                    <span class="text-secondary small d-block text-truncate" style="max-width: 350px;">
                      {{ $p->deskripsi }}
                    </span>
                  </td>

                  <td class="pe-4 text-center">
                    @php
                      $statusData = match ($p->status) {
                        'selesai' => ['bg' => 'success', 'label' => 'Selesai'],
                        'diproses' => ['bg' => 'warning', 'label' => 'Diproses'],
                        'diajukan' => ['bg' => 'secondary', 'label' => 'Diajukan'],
                        default => ['bg' => 'light', 'label' => '-']
                      };
                    @endphp
                    <span
                      class="badge bg-{{ $statusData['bg'] }} bg-opacity-10 text-{{ $statusData['bg'] }} border border-{{ $statusData['bg'] }} border-opacity-10 px-3 py-2 rounded-pill fw-medium">
                      {{ $statusData['label'] }}
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div class="py-4">
                      <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-box-archive text-secondary fs-3"></i>
                      </div>
                      <h6 class="text-secondary fw-bold mb-1">Data Laporan Kosong</h6>
                      <p class="text-muted small mb-0">Tidak ada data yang sesuai dengan filter tanggal atau status yang
                        dipilih.</p>
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

  <script>
    function syncToPrint() {
      document.getElementById('print_tgl_awal').value = document.getElementById('tgl_awal').value;
      document.getElementById('print_tgl_akhir').value = document.getElementById('tgl_akhir').value;
      document.getElementById('print_status').value = document.getElementById('status').value;
    }
  </script>

  <style>
    .cursor-pointer {
      cursor: pointer;
    }

    .text-truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
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
  </style>
@endsection