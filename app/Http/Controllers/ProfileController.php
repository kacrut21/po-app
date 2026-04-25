<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('pages.profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'store_name'     => 'nullable|string|max:255',
            'store_phone'    => 'nullable|string|max:50',
            'store_address'    => 'nullable|string|max:500',
            'invoice_template' => 'nullable|string|max:2000',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal 8 karakter.',
        ]);

        Auth::user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah!');
    }
}
