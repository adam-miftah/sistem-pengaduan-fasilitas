@php
    $user = null;
    $roleLabel = '';
    $identifier = '';
    $profileRoute = '#';

    if (Auth::guard('mahasiswa')->check()) {
        $user = Auth::guard('mahasiswa')->user();
        $roleLabel = 'Mahasiswa';
        $identifier = $user->nim;
        $profileRoute = route('mahasiswa.profile.edit');
        $photo = $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->nama) . '&background=e9ecef&color=0d6efd';
    } elseif (Auth::check()) {
        $user = Auth::user();
        $roleLabel = ucfirst($user->role);
        $identifier = $user->email;
        $profileRoute = $user->role === 'admin' ? route('admin.profile.edit') : route('petugas.profile.edit');
        $photo = $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=e9ecef&color=0d6efd';
    }
@endphp

<div class="d-flex align-items-center justify-content-end w-100">
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-3" id="dropdownUser"
            data-bs-toggle="dropdown" aria-expanded="false">
            <div class="d-none d-md-block text-end lh-1">
                <div class="fw-bold text-dark" style="font-size: 0.9rem;">
                    {{ $user->name ?? $user->nama }}
                </div>
                <small class="text-muted" style="font-size: 0.75rem;">
                    {{ $roleLabel }}
                </small>
            </div>
            <img src="{{ $photo }}" alt="user" width="40" height="40"
                class="rounded-circle border shadow-sm object-fit-cover">
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 p-2" aria-labelledby="dropdownUser"
            style="min-width: 220px;">
            <li class="d-md-none px-3 py-2 border-bottom mb-2">
                <div class="fw-bold text-dark">{{ $user->name ?? $user->nama }}</div>
                <div class="text-muted small">{{ $identifier }}</div>
            </li>
            <li>
                <a class="dropdown-item rounded-2 py-2 d-flex align-items-center" href="{{ $profileRoute }}">
                    <i class="fa-solid fa-user-gear me-2 text-primary opacity-75"
                        style="width: 20px; text-align: center;"></i>
                    Edit Profil
                </a>
            </li>
            <li>
                <hr class="dropdown-divider my-2">
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="dropdown-item rounded-2 py-2 d-flex align-items-center text-danger btn-logout-hover">
                        <i class="fa-solid fa-right-from-bracket me-2" style="width: 20px; text-align: center;"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>

<style>
    .dropdown-toggle::after {
        display: none;
    }

    .btn-logout-hover:hover {
        background-color: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .dropdown-item:hover {
        background-color: #f3f4f6;
    }
</style>