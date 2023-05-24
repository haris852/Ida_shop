<?php

namespace App\Http\Controllers;

use App\Mail\ResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            // check if user is active
            if(auth()->user()->is_active == false) {
                Auth::logout();
                return back()->with('error', 'Akun anda tidak aktif!');
            }
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
        return redirect()->route('home')->with('success', 'Logout berhasil!');
    }

    public function forgotPassword()
    {
        return view('guest.auth.forgot-password');
    }

    public function forgotPasswordStore(Request $request) {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'email.exists' => 'Email tidak terdaftar!'
        ]);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => uniqid(),
            'created_at' => now()
        ]);

        $token = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if($this->sendResetEmail($request->email, $token->token)) {
            return back()->with('success', 'Email reset password telah dikirim!');
        } else {
            return back()->with('error', 'Email reset password gagal dikirim!');
        }
    }

    private function sendResetEmail($email, $token) {
        $user = User::where('email', $email)->first();
        $link = route('reset-password', ['token' => $token]);

        $mail = Mail::to($email)->send(new ResetMail($token, $email, $link));
        if($mail) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPassword(Request $request, $token) {
        $token = DB::table('password_reset_tokens')->where('token', $token)->first();
        if(!$token) {
            return redirect()->route('forgot-password')->with('error', 'Token tidak valid!');
        }
        return view('guest.auth.reset-password', compact('token'));
    }

    public function resetPasswordUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed']
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Email tidak valid!',
            'email.exists' => 'Email tidak terdaftar!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Password tidak sama!'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }

}
