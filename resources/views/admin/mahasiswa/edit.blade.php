@extends('layouts.app')
@section('title', 'Edit Mahasiswa')

@section('content')
  <div class="container-fluid px-4 py-3">
    <div class="d-flex align-items-center justify-content-between my-2">
      <div>
        <h4 class="fw-bold mb-0 text-dark">Edit Data Mahasiswa</h4>
        <small class="text-muted">Perbarui informasi data diri mahasiswa.</small>
      </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-header bg-white py-3 border-bottom-0">
        <h6 class="m-0 fw-bold text-warning">
          <i class="fa-solid fa-pen-to-square me-2"></i>Form Perbarui Data
        </h6>
      </div>

      <div class="card-body p-4">
        <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row g-4">
            <div class="col-md-6">
              <div>
                <label class="form-label fw-semibold text-secondary small text-uppercase">Nomor Induk
                  Mahasiswa (NIM)</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-id-card"></i>
                  </span>
                  <input type="number" name="nim"
                    class="form-control border-start-0 ps-0 @error('nim') is-invalid @enderror"
                    value="{{ old('nim', $mahasiswa->nim) }}" required>
                </div>
                @error('nim')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mt-3">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Alamat
                  Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-envelope"></i>
                  </span>
                  <input type="email" name="email"
                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                    value="{{ old('email', $mahasiswa->email) }}">
                </div>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div>
                <label class="form-label fw-semibold text-secondary small text-uppercase">Nama
                  Lengkap</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-regular fa-user"></i>
                  </span>
                  <input type="text" name="nama"
                    class="form-control border-start-0 ps-0 @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $mahasiswa->nama) }}" required>
                </div>
                @error('nama')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mt-3">
                <label class="form-label fw-semibold text-secondary small text-uppercase">Password
                  Baru</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="fa-solid fa-key"></i>
                  </span>
                  <input type="password" name="password"
                    class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                    placeholder="Biarkan kosong jika tidak ingin mengganti">
                </div>
                <div class="form-text small ms-1 text-muted">Hanya isi jika ingin mereset password mahasiswa
                  ini.</div>
                @error('password')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top">
            <label class="form-label fw-semibold text-secondary small text-uppercase">Foto Profil</label>

            <div class="d-flex align-items-center gap-4">
              @if($mahasiswa->photo)
                <div class="text-center">
                  <img src="{{ asset('storage/' . $mahasiswa->photo) }}" class="rounded-3 border shadow-sm object-fit-cover"
                    width="80" height="80" alt="Foto Lama">
                  <div class="small text-muted mt-1" style="font-size: 0.7rem;">Foto Saat Ini</div>
                </div>
              @else
                <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted"
                  style="width: 80px; height: 80px;">
                  <i class="fa-regular fa-user fs-3"></i>
                </div>
              @endif

              <div class="flex-grow-1">
                <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
                <div class="form-text small ms-1">Upload foto baru untuk mengganti. Format: JPG, JPEG, PNG
                  (Max 2MB).</div>
                @error('photo')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-light border shadow-sm px-4">
              <i class="fa-solid fa-arrow-left me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary shadow-sm px-4">
              <i class="fa-solid fa-floppy-disk me-1"></i> Update Data
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection