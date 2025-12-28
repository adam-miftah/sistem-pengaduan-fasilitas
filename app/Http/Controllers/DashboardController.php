<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalPetugas   = User::where('role', 'petugas')->count();
        $totalPengaduan = Pengaduan::count();
        $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();

        $pengaduanPerBulan = Pengaduan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $dataBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulan[] = $pengaduanPerBulan[$i] ?? 0;
        }

        $statusCounts = Pengaduan::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status')->toArray();
        
        $dataStatus = [
            $statusCounts['diajukan'] ?? 0,
            $statusCounts['diproses'] ?? 0,
            $statusCounts['selesai'] ?? 0,
        ];

        return view('admin.dashboard', compact('totalMahasiswa', 'totalPetugas', 'totalPengaduan', 'pengaduanSelesai','dataBulan', 'dataStatus'
        ));
    }

    public function petugas()
    {
        return view('petugas.dashboard', [
            'masuk' => Pengaduan::where('status', 'diajukan')->count(),
            'diproses' => Pengaduan::where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
        ]);
    }

    public function mahasiswa()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        return view('mahasiswa.dashboard', [
            'total' => Pengaduan::where('mahasiswa_id', $mahasiswa->id)->count(),
            'diproses' => Pengaduan::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('status', 'diproses')->count(),
            'selesai' => Pengaduan::where('mahasiswa_id', $mahasiswa->id)
                                   ->where('status', 'selesai')->count(),
        ]);
    }
}
