@auth
  @if(auth()->user()->role === 'admin')
    <small class="text-uppercase text-secondary fw-bold px-3 mt-0 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">MENU UTAMA</small>
    <a href="{{ route('admin.dashboard') }}"
      class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-gauge-high"></i>
      <span>Dashboard</span>
    </a>

    <small class="text-uppercase text-secondary fw-bold px-3 mt-4 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">MASTER DATA</small>
    <a href="{{ route('admin.kategori.index') }}"
      class="sidebar-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-tags"></i>
      <span>Kategori</span>
    </a>
    <a href="{{ route('admin.mahasiswa.index') }}"
      class="sidebar-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-user-group"></i>
      <span>Data Mahasiswa</span>
    </a>
    <a href="{{ route('admin.petugas.index') }}"
      class="sidebar-link {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-user-shield"></i>
      <span>Data Petugas</span>
    </a>

    <small class="text-uppercase text-secondary fw-bold px-3 mt-4 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">SIRKULASI</small>
    <a href="{{ route('admin.pengaduan.index') }}"
      class="sidebar-link {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-inbox"></i>
      <span>Data Pengaduan</span>
    </a>
    <a href="{{ route('admin.laporan.pengaduan') }}"
      class="sidebar-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-file-lines"></i>
      <span>Laporan & Arsip</span>
    </a>
  @endif
@endauth

@auth
  @if(auth()->user()->role === 'petugas')
    <small class="text-uppercase text-secondary fw-bold px-3 mt-0 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">MENU UTAMA</small>
    <a href="{{ route('petugas.dashboard') }}"
      class="sidebar-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-gauge-high"></i>
      <span>Dashboard</span>
    </a>

    <small class="text-uppercase text-secondary fw-bold px-3 mt-4 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">PENGADUAN</small>
    <a href="{{ route('petugas.pengaduan.index') }}"
      class="sidebar-link {{ request()->routeIs('petugas.pengaduan.index') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-inbox"></i>
      <span>Pengaduan Masuk</span>
    </a>
    <a href="{{ route('petugas.pengaduan.riwayat') }}"
      class="sidebar-link {{ request()->routeIs('petugas.pengaduan.riwayat') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-clock-rotate-left"></i>
      <span>Riwayat & Arsip</span>
    </a>

    <small class="text-uppercase text-secondary fw-bold px-3 mt-4 mb-2 d-block"
      style="font-size: 0.7rem; letter-spacing: 1px;">LAPORAN</small>
    <a href="{{ route('petugas.laporan.index') }}"
      class="sidebar-link {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}" onclick="closeSidebar()">
      <i class="fa-solid fa-print"></i>
      <span>Cetak Laporan</span>
    </a>
  @endif
@endauth

@auth('mahasiswa')
  <small class="text-uppercase text-secondary fw-bold px-3 mt-0 mb-2 d-block"
    style="font-size: 0.7rem; letter-spacing: 1px;">MENU UTAMA</small>
  <a href="{{ route('mahasiswa.dashboard') }}"
    class="sidebar-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}" onclick="closeSidebar()">
    <i class="fa-solid fa-gauge-high"></i>
    <span>Dashboard</span>
  </a>
  <small class="text-uppercase text-secondary fw-bold px-3 mt-4 mb-2 d-block"
    style="font-size: 0.7rem; letter-spacing: 1px;">AKTIVITAS</small>
  <a href="{{ route('mahasiswa.pengaduan.create') }}"
    class="sidebar-link {{ request()->routeIs('mahasiswa.pengaduan.create') ? 'active' : '' }}" onclick="closeSidebar()">
    <i class="fa-solid fa-circle-plus"></i>
    <span>Buat Pengaduan</span>
  </a>
  <a href="{{ route('mahasiswa.pengaduan.index') }}"
    class="sidebar-link {{ request()->routeIs('mahasiswa.pengaduan.index') ? 'active' : '' }}" onclick="closeSidebar()">
    <i class="fa-solid fa-clock-rotate-left"></i>
    <span>Riwayat Saya</span>
  </a>
@endauth