<div class="modal fade ms-5" id="detailModal{{ $p->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $p->id }}"
  aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold" id="detailModalLabel{{ $p->id }}">
          <i class="fa-solid fa-circle-info me-2"></i> Detail Pengaduan {{ $p->mahasiswa->nama }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4">
        <div class="row g-4">
          <div class="col-md-5">
            <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Bukti Lampiran</h6>
            <div class="mb-3 text-center">
              @if($p->foto)
                <div class="ratio ratio-4x3 shadow-sm rounded overflow-hidden">
                  <img src="{{ asset('storage/' . $p->foto) }}" class="object-fit-cover" alt="Bukti Pengaduan"
                    onclick="window.open('{{ asset('storage/' . $p->foto) }}', '_blank')" style="cursor: zoom-in;"
                    title="Klik untuk melihat ukuran penuh">
                </div>
                <small class="text-muted d-block mt-2 fst-italic">
                  <i class="fa-solid fa-magnifying-glass-plus"></i> Klik gambar untuk memperbesar
                </small>
              @else
                <div
                  class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center rounded border border-dashed">
                  <div class="text-center text-muted">
                    <i class="fa-regular fa-image fs-1"></i>
                    <p class="mb-0 small">Tidak ada foto dilampirkan</p>
                  </div>
                </div>
              @endif
            </div>

            <div class="card bg-light border-0">
              <div class="card-body">
                <h6 class="fw-bold mb-2">Update Status</h6>
                <form action="{{ route('admin.pengaduan.update', $p->id) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="d-flex gap-2">
                    <select name="status"
                      class="form-select form-select-sm {{ $p->status == 'selesai' ? 'border-success text-success fw-bold' : ($p->status == 'diproses' ? 'border-warning text-warning fw-bold' : '') }}">
                      <option value="diajukan" {{ $p->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                      <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                      <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">
                      <i class="fa-solid fa-check"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-7">
            <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Informasi Pelapor</h6>
            <table class="table table-borderless table-sm mb-4">
              <tr>
                <td width="35%" class="text-muted">Nama Mahasiswa</td>
                <td class="fw-bold"> {{ $p->mahasiswa->nama }}</td>
              </tr>
              <tr>
                <td class="text-muted">NIM</td>
                <td> {{ $p->mahasiswa->nim }}</td>
              </tr>
              <tr>
                <td class="text-muted">Email</td>
                <td> {{ $p->mahasiswa->email ?? '-' }}</td>
              </tr>
            </table>

            <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">Detail Kejadian</h6>
            <table class="table table-borderless table-sm">
              <tr>
                <td width="35%" class="text-muted">Kategori</td>
                <td>
                  <span class="badge bg-info text-dark">{{ $p->kategori->nama_kategori }}</span>
                </td>
              </tr>
              <tr>
                <td class="text-muted">Lokasi</td>
                <td> {{ $p->lokasi }}</td>
              </tr>
              <tr>
                <td class="text-muted">Tanggal Lapor</td>
                <td> {{ $p->created_at->format('d F Y') }} <small
                    class="text-muted">({{ $p->created_at->format('H:i') }} WIB)</small></td>
              </tr>
              <tr>
                <td class="text-muted">Terakhir Update</td>
                <td> {{ $p->updated_at->format('d F Y H:i') }}</td>
              </tr>
            </table>

            <div class="mt-3">
              <label class="small text-muted fw-bold">Deskripsi Masalah</label>
              <div class="p-3 bg-light rounded border mt-1" style="min-height: 80px; text-align: justify;">
                {{ $p->deskripsi }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer bg-light">
        <form action="{{ route('admin.pengaduan.destroy', $p->id) }}" method="POST" class="me-auto">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger btn-sm"
            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')">
            <i class="fa-solid fa-trash"></i> Hapus Pengaduan
          </button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>