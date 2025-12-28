@extends('layouts.app')
@section('title', 'Edit Profil')

@section('content')
  @php
    $actionUrl = '#';
    $user = null;
    $guard = '';

    if (auth()->guard('mahasiswa')->check()) {
      $actionUrl = route('mahasiswa.profile.update');
      $user = auth()->guard('mahasiswa')->user();
      $guard = 'mahasiswa';
      $photoPath = $user->photo ? asset('storage/' . $user->photo) : null;
    } elseif (auth()->check()) {
      $actionUrl =
        auth()->user()->role === 'admin'
        ? route('admin.profile.update')
        : route('petugas.profile.update');
      $user = auth()->user();
      $guard = 'web';
      $photoPath = $user->photo ? asset('storage/' . $user->photo) : null;
    }
  @endphp

  <div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold text-dark mb-1">Pengaturan Profil</h4>
        <p class="text-muted small mb-0">Kelola informasi akun dan keamanan Anda.</p>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ $actionUrl }}">
      @csrf

      <div class="row g-4">

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 text-center h-100">
            <div class="card-body p-5">
              <div class="position-relative d-inline-block mb-3">
                <img id="preview"
                  src="{{ $photoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? $user->nama) . '&background=random&size=150' }}"
                  class="rounded-circle border border-white shadow"
                  style="width: 150px; height: 150px; object-fit: cover;">

                <label for="photoInput"
                  class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow-sm"
                  style="cursor: pointer; width: 40px; height: 40px; transition: 0.3s;" title="Ganti Foto">
                  <i class="fa-solid fa-camera position-absolute top-50 start-50 translate-middle"></i>
                </label>
                <input type="file" id="photoInput" name="photo" class="d-none" accept="image/*"
                  onchange="previewImage(this)">
              </div>

              <h5 class="fw-bold mb-1">{{ $user->name ?? $user->nama }}</h5>
              <p class="text-muted small mb-3">{{ $guard === 'mahasiswa' ? 'Mahasiswa' : ucfirst($user->role) }}</p>

              <div class="d-grid">
                <small class="text-muted fst-italic">Format: JPG, JPEG, PNG. Maks 2MB.</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
              <h6 class="m-0 fw-bold text-primary">
                <i class="fa-solid fa-address-card me-2"></i>Informasi Pribadi
              </h6>
            </div>
            <div class="card-body p-4">

              @if($guard === 'web')
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                        placeholder="Nama Lengkap">
                      <label for="name">Nama Lengkap</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        placeholder="Email">
                      <label for="email">Alamat Email</label>
                    </div>
                  </div>
                </div>
              @endif

              @if($guard === 'mahasiswa')
                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}"
                        placeholder="Nama Mahasiswa">
                      <label for="nama">Nama Mahasiswa</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control bg-light" id="nim" name="nim" value="{{ $user->nim }}"
                        placeholder="NIM" readonly>
                      <label for="nim">NIM (Tidak dapat diubah)</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                        placeholder="Email">
                      <label for="email">Alamat Email</label>
                    </div>
                  </div>
                </div>
              @endif

              <hr class="my-4 text-muted">

              <h6 class="fw-bold text-primary mb-3">
                <i class="fa-solid fa-shield-halved me-2"></i>Keamanan Akun
              </h6>
              <div class="alert alert-light border small text-muted mb-3">
                <i class="fa-solid fa-circle-info me-1"></i> Kosongkan jika tidak ingin mengubah password.
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru">
                    <label for="password">Password Baru</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                      placeholder="Konfirmasi Password">
                    <label for="password_confirmation">Ulangi Password Baru</label>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="reset" class="btn btn-light border px-4">Batal</button>
                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                  <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan
                </button>
              </div>

            </div>
          </div>
        </div>

      </div>
    </form>
  </div>

  <script>
    function previewImage(input) {
      const preview = document.getElementById('preview');
      const file = input.files[0];

      if (file) {
        if (file.size > 2 * 1024 * 1024) {
          alert('Ukuran file terlalu besar! Maksimal 2MB.');
          input.value = "";
          return;
        }

        const objectUrl = URL.createObjectURL(file);
        preview.src = objectUrl;

        preview.onload = () => {
          URL.revokeObjectURL(objectUrl);
        }
      }
    }
  </script>

  <style>
    .form-floating>.form-control:focus,
    .form-floating>.form-control:not(:placeholder-shown) {
      padding-top: 1.625rem;
      padding-bottom: .625rem;
    }

    label[for="photoInput"]:hover {
      background-color: #0b5ed7 !important;
      transform: scale(1.1);
    }
  </style>
@endsection