<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'store_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:8'],
        ]);

        // Buat user baru dengan status TIDAK AKTIF
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'store_name' => $validated['store_name'],
            'plan' => 'lifetime',
            'is_active' => false, // Menunggu approval admin
            'order_limit' => -1,  // Akan unlimited kalau sudah aktif
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil dibuat. Silakan selesaikan pembayaran.',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'store_name' => $user->store_name
            ]
        ]);
    }
}
