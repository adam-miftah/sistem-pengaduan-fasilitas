<div class="modal fade ms-5" id="modalDetail{{ $mahasiswa->id }}" tabindex="-1"
  aria-labelledby="modalDetailLabel{{ $mahasiswa->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailLabel{{ $mahasiswa->id }}">
          <i class="fa-solid fa-address-card me-2"></i> Detail Data Mahasiswa
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-4 text-center border-end">
            <div class="mb-3">
              @if($mahasiswa->photo)
                <img src="{{ asset('storage/' . $mahasiswa->photo) }}" alt="Foto {{ $mahasiswa->nama }}"
                  class="img-fluid rounded shadow-sm object-fit-cover" style="width: 200px; height: 250px;">
              @else
                <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center mx-auto"
                  style="width: 200px; height: 250px;">
                  <i class="fa-solid fa-user display-1 text-muted"></i>
                </div>
              @endif
            </div>
            <h5 class="fw-bold mb-1">{{ $mahasiswa->nama }}</h5>
            <span class="badge bg-primary rounded-pill px-3">{{ $mahasiswa->nim }}</span>
          </div>

          <div class="col-md-8">
            <h6 class="text-uppercase text-muted fw-bold mb-3 border-bottom pb-2">Informasi Pribadi</h6>
            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">ID Database</label>
              <div class="col-sm-8 text-dark">{{ $mahasiswa->id }}</div>
            </div>

            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">Nomor Induk Mahasiswa</label>
              <div class="col-sm-8 text-dark fw-bold">{{ $mahasiswa->nim }}</div>
            </div>

            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">Nama Lengkap</label>
              <div class="col-sm-8 text-dark">{{ $mahasiswa->nama }}</div>
            </div>

            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">Alamat Email</label>
              <div class="col-sm-8 text-dark">
                @if($mahasiswa->email)
                  <a href="mailto:{{ $mahasiswa->email }}" class="text-decoration-none">{{ $mahasiswa->email }}</a>
                @else
                  <span class="text-muted fst-italic">Tidak ada email</span>
                @endif
              </div>
            </div>
            <h6 class="text-uppercase text-muted fw-bold mt-4 mb-3 border-bottom pb-2">Informasi Sistem</h6>
            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">Dibuat Pada</label>
              <div class="col-sm-8 text-dark">
                {{ $mahasiswa->created_at ? $mahasiswa->created_at->format('d F Y, H:i') . ' WIB' : '-' }}
              </div>
            </div>

            <div class="row mb-2">
              <label class="col-sm-4 fw-bold text-secondary">Terakhir Diupdate</label>
              <div class="col-sm-8 text-dark">
                {{ $mahasiswa->updated_at ? $mahasiswa->updated_at->format('d F Y, H:i') . ' WIB' : '-' }}
                <small
                  class="text-muted ms-1">({{ $mahasiswa->updated_at ? $mahasiswa->updated_at->diffForHumans() : '' }})</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>