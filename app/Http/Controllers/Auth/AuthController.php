<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->username;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

            if (Auth::attempt(['email' => $username, 'password' => $password])) {
                $request->session()->regenerate();
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('petugas.dashboard');
            }
        }

        if (Auth::guard('mahasiswa')->attempt([
            'nim' => $username,
            'password' => $password
        ])) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }
        return back()->withErrors([
            'username' => 'Username / Password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
