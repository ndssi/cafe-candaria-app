<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLogin()
    {
        // Kalau sudah login, langsung ke dashboard
        if (session('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Proses login: cek username & password ke tabel tbl_user.
     * FIX: sebelumnya form login cuma GET ke dashboard tanpa validasi apa pun.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = AdminUser::where('username', $credentials['username'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return back()
                ->withInput($request->only('username'))
                ->with('error', 'Username atau password salah.');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_id', $admin->id);
        $request->session()->put('admin_nama', $admin->nama);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout admin.
     */
    public function logout(Request $request)
    {
        $request->session()->forget(['admin_id', 'admin_nama']);
        $request->session()->regenerate();

        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
