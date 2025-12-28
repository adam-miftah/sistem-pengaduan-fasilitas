@extends('layouts.app')
@section('title', 'Buat Pengaduan')

@section('content')
  <div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="fw-bold text-dark mb-1">Ajukan Pengaduan Baru</h4>
        <p class="text-muted small mb-0">Isi formulir berikut untuk melaporkan kerusakan atau keluhan fasilitas.</p>
      </div>
      <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-light border text-secondary shadow-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
      </a>
    </div>

    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
        <ul class="mb-0 small">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
      <div class="card-body p-4">

        <form method="POST" action="{{ route('mahasiswa.pengaduan.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="row g-4">
            <div class="col-lg-8">
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-floating">
                    <select name="kategori_id" id="kategori" class="form-select bg-light border-2" required>
                      <option value="" disabled selected>Pilih Kategori.......</option>
                      @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                      @endforeach
                    </select>
                    <label for="kategori" class="fw-bold text-secondary">Kategori Laporan</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="lokasi" id="lokasi" class="form-control bg-light border-2"
                      placeholder="Lokasi" required>
                    <label for="lokasi" class="fw-bold text-secondary">Lokasi Kejadian</label>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                    <textarea name="deskripsi" id="deskripsi" class="form-control bg-light border-2"
                      placeholder="Deskripsi" style="height: 200px" required></textarea>
                    <label for="deskripsi" class="fw-bold text-secondary">Deskripsi Masalah</label>
                  </div>
                  <div class="form-text ms-1 mt-2">
                    <i class="fa-solid fa-circle-info me-1"></i> Ceritakan detail kerusakan agar petugas mudah
                    memahaminya.
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div
                class="h-100 p-4 border rounded-4 bg-light text-center position-relative d-flex flex-column justify-content-center upload-area"
                style="border: 2px dashed #adb5bd !important; min-height: 300px;">

                <h6 class="fw-bold text-secondary mb-3">BUKTI FOTO</h6>

                <input type="file" name="foto" id="fotoInput"
                  class="position-absolute top-0 start-0 w-100 h-100 opacity-0" style="cursor: pointer; z-index: 10;"
                  accept="image/*" onchange="previewImage(this)">

                <div id="uploadPlaceholder">
                  <div class="bg-white p-3 rounded-circle shadow-sm d-inline-block text-primary mb-3">
                    <i class="fa-solid fa-cloud-arrow-up fs-1"></i>
                  </div>
                  <p class="mb-1 fw-bold text-dark">Klik atau Tarik Foto ke Sini</p>
                  <small class="text-muted d-block">Format: JPG, PNG. Maks 2MB.</small>
                </div>

                <div id="imagePreviewContainer" class="d-none position-relative w-100 h-100" style="z-index: 5;">
                  <img id="imagePreview" src="#" class="rounded-3 shadow-sm border w-100 h-100"
                    style="object-fit: contain; max-height: 250px;">
                  <button type="button"
                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle shadow"
                    onclick="resetImage()" style="z-index: 20;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-3 shadow-sm hover-scale">
                <i class="fa-solid fa-paper-plane me-2"></i> KIRIM LAPORAN SEKARANG
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function previewImage(input) {
      const file = input.files[0];
      const placeholder = document.getElementById('uploadPlaceholder');
      const previewContainer = document.getElementById('imagePreviewContainer');
      const previewImage = document.getElementById('imagePreview');

      if (file) {
        if (file.size > 2 * 1024 * 1024) {
          alert("Ukuran file terlalu besar! Maksimal 2MB.");
          input.value = "";
          return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
          previewImage.src = e.target.result;
          placeholder.classList.add('d-none');
          previewContainer.classList.remove('d-none');
        }
        reader.readAsDataURL(file);
      }
    }

    function resetImage() {
      const input = document.getElementById('fotoInput');
      const placeholder = document.getElementById('uploadPlaceholder');
      const previewContainer = document.getElementById('imagePreviewContainer');

      input.value = "";
      placeholder.classList.remove('d-none');
      previewContainer.classList.add('d-none');
    }
  </script>

  <style>
    .form-floating>.form-control:focus,
    .form-floating>.form-control:not(:placeholder-shown),
    .form-floating>.form-select {
      background-color: #f8f9fa;
    }

    .form-floating>.form-control:focus {
      border: 1px solid #0d6efd !important;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }

    .upload-area {
      transition: all 0.2s;
      background-color: #f8f9fa !important;
    }

    .upload-area:hover {
      background-color: #e9ecef !important;
      border-color: #0d6efd !important;
    }

    .hover-scale {
      transition: transform 0.2s;
    }

    .hover-scale:hover {
      transform: scale(1.01);
    }
  </style>
@endsection