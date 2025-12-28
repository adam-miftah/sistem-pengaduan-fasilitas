<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Mahasiswa\PengaduanController as MahasiswaPengaduanController;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::resource('pengaduan', AdminPengaduanController::class)->except(['create', 'store', 'edit']);
    Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::post('petugas/import', [PetugasController::class, 'import'])->name('petugas.import');
    Route::resource('petugas', PetugasController::class)->parameters([
    'petugas' => 'petugas',]);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.pengaduan');
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak'); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('dashboard');
    Route::get('pengaduan', [PetugasPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::patch('pengaduan/{pengaduan}/status', [PetugasPengaduanController::class, 'updateStatus'])->name('pengaduan.status');
    Route::get('/pengaduan/riwayat', [PetugasPengaduanController::class, 'riwayat'])->name('pengaduan.riwayat');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'mahasiswa'])->name('dashboard');
    Route::get('pengaduan', [MahasiswaPengaduanController::class, 'index'])
        ->name('pengaduan.index');
    Route::get('pengaduan/create', [MahasiswaPengaduanController::class, 'create'])
        ->name('pengaduan.create');
    Route::post('pengaduan', [MahasiswaPengaduanController::class, 'store'])
        ->name('pengaduan.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
