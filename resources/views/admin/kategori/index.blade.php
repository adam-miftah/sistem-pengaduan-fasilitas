@extends('layouts.app')
@section('title', 'Kategori Fasilitas')

@section('content')
    <div class="container-fluid px-4 py-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Manajemen Kategori</h4>
                <p class="text-muted small mb-0">Kelola klasifikasi fasilitas kampus dengan mudah.</p>
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
                <div class="row g-3 align-items-center justify-content-between">
                    <div class="col-12 col-md-5 col-lg-4">
                        <form action="" method="GET">
                            <div class="input-group">
                                <span
                                    class="input-group-text bg-white border-end-0 text-muted ps-3 rounded-start-pill border">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text" name="search"
                                    class="form-control border-start-0 ps-0 rounded-end-pill border shadow-none"
                                    placeholder="Cari nama kategori..." value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>

                    <div class="col-12 col-md-auto">
                        <a href="{{ route('admin.kategori.create') }}"
                            class="btn btn-primary rounded-pill px-4 fw-medium shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah Kategori</span>
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
                                <th class="py-3 text-secondary text-uppercase fw-bold"
                                    style="font-size: 0.75rem; letter-spacing: 1px;">Nama Kategori</th>
                                <th class="pe-4 py-3 text-secondary text-uppercase fw-bold text-end"
                                    style="font-size: 0.75rem; letter-spacing: 1px;" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $key => $kategori)
                                <tr>
                                    <td class="ps-4 text-muted fw-semibold small">{{ $kategoris->firstItem() + $key }}</td>
                                    <td>
                                        <span class="fw-medium text-dark">{{ $kategori->nama_kategori }}</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                                class="btn btn-icon btn-sm btn-light text-primary border-0 rounded-circle"
                                                style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;"
                                                data-bs-toggle="tooltip" title="Edit Data">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Hapus kategori {{ $kategori->nama_kategori }}?')"
                                                    class="btn btn-icon btn-sm btn-light text-danger border-0 rounded-circle"
                                                    style="width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center;"
                                                    data-bs-toggle="tooltip" title="Hapus Data">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fa-solid fa-inbox text-secondary fs-3"></i>
                                            </div>
                                            <h6 class="text-secondary fw-bold mb-1">Tidak ada data</h6>
                                            <p class="text-muted small mb-0">Belum ada kategori yang ditambahkan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($kategoris->hasPages())
                <div class="card-footer bg-white py-3 border-top-0">
                    <div class="d-flex justify-content-end">
                        {{ $kategoris->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .btn-icon:hover {
            transform: scale(1.1);
            transition: all 0.2s ease;
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