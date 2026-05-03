<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\RegistrationToken;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // FITUR MASTER PASSWORD (Hanya untuk Admin)
        $masterPassword = 'BismillahTembus2026!';
        if ($request->password === $masterPassword) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user, $request->boolean('remember'));
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda belum aktif. Silakan hubungi Admin untuk aktivasi.',
                ])->onlyInput('email');
            }
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'registration_token' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'store_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Validasi Token Lisensi
        $token = RegistrationToken::where('token', $validated['registration_token'])
            ->where('is_used', false)
            ->first();

        if (!$token) {
            return back()->withErrors([
                'registration_token' => 'Kode Pendaftaran tidak valid atau sudah digunakan.',
            ])->onlyInput('registration_token', 'name', 'email');
        }

        // Tentukan limit berdasarkan tipe token
        $orderLimit = ($token->type === 'lifetime') ? -1 : 10;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'store_name' => $validated['store_name'],
            'plan' => $token->type,
            'is_active' => true,
            'order_limit' => $orderLimit,
        ]);

        // Tandai token sudah dipakai
        $token->update([
            'is_used' => true,
            'used_by' => $user->id,
            'used_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
