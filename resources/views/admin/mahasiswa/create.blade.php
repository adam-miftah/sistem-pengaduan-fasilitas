@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')

@section('content')
  <div class="container-fluid px-4 py-3">
    <div class="d-flex align-items-center justify-content-between my-2">
      <div>
        <h4 class="fw-bold mb-0 text-dark">Registrasi Mahasiswa</h4>
        <small class="text-muted">Tambahkan data mahasiswa baru ke dalam sistem.</small>
      </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="m-0 fw-bold text-primary">
          <i class="fa-solid fa-user-plus me-2"></i>Form Data Mahasiswa
        </h6>
      </div>

      <div class="card-body p-4">
        <form action="{{ route('admin.mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row g-4">
            <div class="col-md-6">
              <div>
                <label class="form-label fw-semibold text-secondary small text-uppercase">Nomor Induk Mahasiswa
                  (NIM)</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-id-card"></i>
                  </span>
                  <input type="number" name="nim"
                    class="form-control border-start-0 ps-0 @error('nim') is-invalid @enderror"
                    placeholder="Contoh: 22101140000" value="{{ old('nim') }}" required>
                </div>
                @error('nim')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mt-3">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Alamat Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-envelope"></i>
                  </span>
                  <input type="email" name="email"
                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                    placeholder="email@mahasiswa.ac.id" value="{{ old('email') }}">
                </div>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div>
                <label class="form-label fw-semibold text-secondary small text-uppercase">Nama Lengkap</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-user"></i>
                  </span>
                  <input type="text" name="nama"
                    class="form-control border-start-0 ps-0 @error('nama') is-invalid @enderror"
                    placeholder="Masukan nama lengkap..." value="{{ old('nama') }}" required>
                </div>
                @error('nama')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mt-3">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Password Default</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-solid fa-key"></i>
                  </span>
                  <input type="password" name="password"
                    class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                    placeholder="Masukan password..." required>
                </div>
                <div class="form-text small ms-1">Minimal 8 karakter kombinasi huruf dan angka.</div>
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mt-4">
            <label class="form-label fw-semibold text-secondary small text-uppercase">Foto Profil</label>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
            <div class="form-text small ms-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
            @error('photo')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-light border shadow-sm px-4">
              <i class="fa-solid fa-arrow-left me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary shadow-sm px-4">
              <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection