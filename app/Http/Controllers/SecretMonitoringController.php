<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RegistrationToken;

class SecretMonitoringController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $unusedTokens = RegistrationToken::where('is_used', false)->latest()->get();

        return view('secret-monitoring', compact('users', 'unusedTokens'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        return back()->with('success', 'Status user ' . $user->name . ' berhasil diupdate!');
    }

    public function upgrade($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'plan' => 'lifetime',
            'is_active' => true,
            'order_limit' => -1
        ]);

        return back()->with('success', 'User ' . $user->name . ' berhasil di-upgrade ke Lifetime!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
