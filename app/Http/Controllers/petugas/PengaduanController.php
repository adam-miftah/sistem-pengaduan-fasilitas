<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['mahasiswa', 'kategori'])->whereIn('status', ['diajukan', 'diproses'])->latest()->get();

        return view('petugas.pengaduan.index', compact('pengaduans'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diproses,selesai',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui menjadi ' . ucfirst($request->status));
    }

    public function riwayat(Request $request)
    {
        $query = Pengaduan::with('mahasiswa')->whereIn('status', ['selesai', 'ditolak'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function ($subQ) use ($search) {
                      $subQ->where('nama', 'like', "%{$search}%")
                           ->orWhere('nim', 'like', "%{$search}%");
                  });
            });
        }

        $pengaduans = $query->paginate(10)->withQueryString();

        return view('petugas.pengaduan.riwayat', compact('pengaduans'));
    }
}