@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
  <div class="container-fluid px-4 mt-2">
    <div class="d-flex align-items-center justify-content-between my-4">
      <div>
        <h4 class="fw-bold mb-0 text-dark">Tambah Kategori Baru</h4>
        <small class="text-muted">Silakan isi form di bawah untuk menambahkan kategori fasilitas.</small>
      </div>
    </div>

    <div class="row justify-content-start">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-header bg-white py-3 border-bottom-0">
            <h6 class="m-0 fw-bold text-primary">
              <i class="fa-solid fa-pen-to-square me-2"></i>Form Input Kategori
            </h6>
          </div>

          <div class="card-body p-4">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
              @csrf

              <div class="mb-4">
                <label for="nama_kategori" class="form-label fw-semibold text-secondary">
                  Nama Kategori <span class="text-danger">*</span>
                </label>

                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-solid fa-tag"></i>
                  </span>
                  <input type="text" id="nama_kategori" name="nama_kategori"
                    class="form-control border-start-0 ps-0 @error('nama_kategori') is-invalid @enderror"
                    value="{{ old('nama_kategori') }}" placeholder="Contoh: Gedung, Laboratorium, Parkiran..." required>

                  @error('nama_kategori')
                    <div class="invalid-feedback d-block ps-2">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-text small text-muted mt-1 ms-1">
                  Pastikan nama kategori belum pernah terdaftar sebelumnya.
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-5">
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-light border shadow-sm px-4">
                  <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                  <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection