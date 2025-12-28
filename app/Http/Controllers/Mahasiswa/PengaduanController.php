<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\KategoriFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('kategori')->where('mahasiswa_id', Auth::id());
        $query->when($request->search, function ($q) use ($request) {
            $q->where(function($sub) use ($request) {
            $sub->where('deskripsi', 'like', '%' . $request->search . '%')
                ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        });

        $pengaduans = $query->latest()->paginate(10)->withQueryString();

        return view('mahasiswa.pengaduan.riwayat', compact('pengaduans'));
    }

    public function create()
    {
        $kategoris = KategoriFasilitas::all();
        return view('mahasiswa.pengaduan.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_fasilitas,id',
            'deskripsi'   => 'required',
            'lokasi'      => 'required',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'mahasiswa_id' => Auth::id(),
            'kategori_id'  => $request->kategori_id,
            'deskripsi'    => $request->deskripsi,
            'lokasi'       => $request->lokasi,
            'foto'         => $pathFoto,
            'status'       => 'diajukan',
        ]);

        return redirect()->route('mahasiswa.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim');
    }
}