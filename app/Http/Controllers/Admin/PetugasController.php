<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Imports\PetugasImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $petugas = User::where('role', 'petugas')
            ->when($search, function ($query) use ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })->latest()->paginate(10)->withQueryString();

        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('petugas', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit(User $petugas)
    {
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, User $petugas)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $petugas->id,
            'password' => 'nullable|min:6',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($petugas->photo) {
                Storage::disk('public')->delete($petugas->photo);
            }
            $petugas->photo = $request->file('photo')->store('petugas', 'public');
        }

        $petugas->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $petugas->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diperbarui');
    }

    public function destroy(User $petugas)
    {
        if ($petugas->photo) {
            Storage::disk('public')->delete($petugas->photo);
        }

        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus');
    }
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new PetugasImport, $request->file('file'));
            return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }
}
