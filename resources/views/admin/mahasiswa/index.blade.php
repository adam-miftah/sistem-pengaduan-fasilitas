@extends('layouts.app')
@section('title', 'Data Mahasiswa')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
      <div>
        <h4 class="fw-bold mb-1 text-dark">Data Mahasiswa</h4>
        <p class="text-muted small mb-0">Kelola data induk mahasiswa yang terdaftar dalam sistem.</p>
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

    @if(session('error'))
      <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4 rounded-3" role="alert">
        <div class="d-flex align-items-center">
          <i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i>
          <span>{{ session('error') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

      <div class="card-header bg-white py-3 border-bottom-0 mt-2 px-4">
        <div class="row g-3 align-items-center justify-content-between">

          <div class="col-12 col-md-5 col-lg-4">
            <form action="{{ route('admin.mahasiswa.index') }}" method="GET">
              <div class="input-group">
                <span class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-pill border">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search"
                  class="form-control border-start-0 ps-0 rounded-end-pill border shadow-none"
                  placeholder="Cari NIM, Nama..." value="{{ request('search') }}">
              </div>
            </form>
          </div>

          <div class="col-12 col-md-auto d-flex gap-2 justify-content-md-end">
            <button type="button" class="btn btn-light text-success border fw-medium rounded-pill px-3 shadow-sm"
              data-bs-toggle="modal" data-bs-target="#modalImport">
              <i class="fa-solid fa-file-excel me-1"></i>
              <span class="d-none d-sm-inline">Import Excel</span>
              <span class="d-inline d-sm-none">Import</span>
            </button>

            <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm">
              <i class="fa-solid fa-plus me-1"></i> Tambah
            </a>
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
                  style="font-size: 0.75rem; letter-spacing: 1px;">Mahasiswa</th>
                <th class="py-3 text-secondary text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">
                  Kontak</th>
                <th class="pe-4 py-3 text-secondary text-uppercase fw-bold text-end"
                  style="font-size: 0.75rem; letter-spacing: 1px;" width="15%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($mahasiswas as $mhs)
                <tr>
                  <td class="ps-4 text-muted fw-semibold small">
                    {{ ($mahasiswas->currentPage() - 1) * $mahasiswas->perPage() + $loop->iteration }}
                  </td>

                  <td class="px-3">
                    <div class="d-flex align-items-center">
                      <div class="me-3 flex-shrink-0">
                        @if($mhs->photo)
                          <img src="{{ asset('storage/' . $mhs->photo) }}" alt="Foto"
                            class="rounded-circle object-fit-cover border shadow-sm cursor-pointer"
                            style="width: 45px; height: 45px;" data-bs-toggle="modal"
                            data-bs-target="#modalDetail{{ $mhs->id }}">
                        @else
                          <div
                            class="rounded-circle bg-soft-primary text-primary fw-bold d-flex align-items-center justify-content-center border"
                            style="width: 45px; height: 45px; font-size: 1.1rem; cursor: pointer;" data-bs-toggle="modal"
                            data-bs-target="#modalDetail{{ $mhs->id }}">
                            {{ substr($mhs->nama, 0, 1) }}
                          </div>
                        @endif
                      </div>
                      <div>
                        <div class="fw-bold text-dark text-truncate" style="max-width: 200px;">{{ $mhs->nama }}</div>
                        <div class="text-secondary small font-monospace">{{ $mhs->nim }}</div>
                      </div>
                    </div>
                  </td>

                  <td>
                    @if($mhs->email)
                      <div class="text-secondary small d-flex align-items-center">
                        <i class="fa-solid fa-envelope me-2"></i>{{ $mhs->email }}
                      </div>
                    @else
                      <span class="text-muted small fst-italic">-</span>
                    @endif
                  </td>

                  <td class="pe-4 text-end">
                    <div class="d-flex justify-content-end gap-2">
                      <button type="button" class="btn btn-icon btn-sm btn-light text-secondary border-0 rounded-circle"
                        data-bs-toggle="modal" data-bs-target="#modalDetail{{ $mhs->id }}" title="Lihat Detail">
                        <i class="fa-solid fa-eye"></i>
                      </button>

                      <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}"
                        class="btn btn-icon btn-sm btn-light text-primary border-0 rounded-circle" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>

                      <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus mahasiswa {{ $mhs->nama }}?')"
                          class="btn btn-icon btn-sm btn-light text-danger border-0 rounded-circle" title="Hapus">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    </div>

                    @include('admin.mahasiswa.show', ['mahasiswa' => $mhs])
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-5">
                    <div class="py-4">
                      <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 60px; height: 60px;">
                        <i class="fa-solid fa-user-group text-secondary fs-3"></i>
                      </div>
                      <h6 class="text-secondary fw-bold mb-1">Data tidak ditemukan</h6>
                      <p class="text-muted small mb-0">Silakan tambahkan data baru atau import excel.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      @if($mahasiswas->hasPages())
        <div class="card-footer bg-white py-3 border-top-0">
          <div class="d-flex justify-content-end">
            {{ $mahasiswas->withQueryString()->links() }}
          </div>
        </div>
      @endif
    </div>
  </div>

  <div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-bottom-0 pb-0">
          <h5 class="modal-title fw-bold">Import Data Mahasiswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.mahasiswa.import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body pt-4">
            <div class="alert alert-light border-start border-primary border-3 small text-muted mb-3">
              <i class="fa-solid fa-circle-info text-primary me-1"></i>
              Format Excel (.xlsx) harus memiliki header kolom: <br>
              <strong>nim, nama, email, password</strong>.
            </div>
            <div class="mb-3">
              <label for="fileExcel" class="form-label fw-medium small text-uppercase">Upload File</label>
              <input class="form-control" type="file" id="fileExcel" name="file" required accept=".xlsx, .xls, .csv">
            </div>
          </div>
          <div class="modal-footer border-top-0">
            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary rounded-pill px-4">Import Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <style>
    .btn-icon {
      width: 32px;
      height: 32px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .btn-icon:hover {
      transform: scale(1.1);
      background-color: #e9ecef !important;
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

    .bg-soft-primary {
      background-color: rgba(29, 78, 216, 0.1) !important;
      color: var(--primary-color) !important;
    }
  </style>
@endsection