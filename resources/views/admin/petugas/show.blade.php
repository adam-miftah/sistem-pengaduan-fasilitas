<div class="modal fade ms-5" id="modalDetailPetugas{{ $petugas->id }}" tabindex="-1"
  aria-labelledby="labelDetail{{ $petugas->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="labelDetail{{ $petugas->id }}">
          <i class="fa-solid fa-user-shield me-2"></i> Detail Data Petugas
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-4 text-center border-end">
            <div class="mb-3">
              @if($petugas->photo)
                <img src="{{ asset('storage/' . $petugas->photo) }}" class="img-fluid rounded shadow-sm"
                  style="max-height: 250px; width: 100%; object-fit: cover;">
              @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($petugas->name) }}&size=200"
                  class="img-fluid rounded-circle shadow-sm">
              @endif
            </div>
            <h5 class="fw-bold">{{ $petugas->name }}</h5>
            <span class="badge bg-success">Role: Petugas</span>
          </div>

          <div class="col-md-8">
            <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">Informasi Akun</h6>
            <div class="row mb-2">
              <div class="col-sm-4 fw-bold text-muted">ID System</div>
              <div class="col-sm-8">#{{ $petugas->id }}</div>
            </div>

            <div class="row mb-2">
              <div class="col-sm-4 fw-bold text-muted">Nama Lengkap</div>
              <div class="col-sm-8">{{ $petugas->name }}</div>
            </div>

            <div class="row mb-2">
              <div class="col-sm-4 fw-bold text-muted">Email</div>
              <div class="col-sm-8">{{ $petugas->email }}</div>
            </div>

            <h6 class="text-primary fw-bold mt-4 mb-3 border-bottom pb-2">Log Aktivitas</h6>

            <div class="row mb-2">
              <div class="col-sm-4 fw-bold text-muted">Bergabung Sejak</div>
              <div class="col-sm-8">
                {{ $petugas->created_at ? $petugas->created_at->format('d F Y, H:i') : '-' }} WIB
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-sm-4 fw-bold text-muted">Pembaruan Terakhir</div>
              <div class="col-sm-8">
                {{ $petugas->updated_at ? $petugas->updated_at->format('d F Y, H:i') : '-' }} WIB
                <small
                  class="text-muted">({{ $petugas->updated_at ? $petugas->updated_at->diffForHumans() : '' }})</small>
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