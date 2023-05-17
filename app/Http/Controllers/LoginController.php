<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('guest.auth.login');
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'password.required' => 'Password harus diisi!'
        ]);
        if(Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            if(auth()->user()->role == User::ADMIN_ROLE) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home');
            }
        }

        return back()->with('error', 'Login gagal!');
    }

    public function register()
    {
        return view('guest.auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'sex' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'avatar' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed']
        ]);

        $filename = uniqid() . $request->avatar->getClientOriginalName();
        $request->avatar->storeAs('public/avatar', $filename);

        User::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'avatar' => $filename,
            'address' => $request->address,
            'email' => $request->email,
            'role' => User::USER_ROLE,
            'password' => password_hash($request->password, PASSWORD_DEFAULT)
        ]);
        return redirect()->route('login')->with('success', 'Pendaftaran akun berhasil!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
