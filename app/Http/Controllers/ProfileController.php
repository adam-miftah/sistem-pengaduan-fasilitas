<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private function currentUser()
    {
        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }

        if (Auth::guard('mahasiswa')->check()) {
            return Auth::guard('mahasiswa')->user();
        }

        abort(403);
    }

    public function edit()
    {
        $user = $this->currentUser();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $this->currentUser();

        $rules = [
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ];

        if (Auth::guard('web')->check()) {
            $rules['name']  = 'required|string|max:255';
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        }

        if (Auth::guard('mahasiswa')->check()) {
            $rules['nama'] = 'required|string|max:255';
            $rules['nim']  = 'required|unique:mahasiswas,nim,' . $user->id;
        }

        $validated = $request->validate($rules);

        if (Auth::guard('web')->check()) {
            $user->name  = $validated['name'];
            $user->email = $validated['email'];
        }

        if (Auth::guard('mahasiswa')->check()) {
            $user->nama = $validated['nama'];
            $user->nim  = $validated['nim'];
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('profile', 'public');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')
                ->with('success', 'Password berhasil diubah. Silakan login kembali.');
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
