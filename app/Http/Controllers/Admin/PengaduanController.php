<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['mahasiswa', 'kategori'])->latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($subQ) use ($search) {
                      $subQ->where('nama', 'like', "%{$search}%"); 
                  })
                  ->orWhereHas('kategori', function($subQ) use ($search) {
                      $subQ->where('nama_kategori', 'like', "%{$search}%");
                  })
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }
        $pengaduans = $query->paginate(10)->withQueryString();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:diajukan,diproses,selesai',
        ]);
        $pengaduan->update([
            'status' => $request->status,
        ]);
        return back()->with('success', 'Status pengaduan diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return back()->with('success', 'Pengaduan berhasil dihapus');
    }
}