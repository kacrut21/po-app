@extends('layouts.auth')

@section('title', 'Masuk - PO-Management by CuanPilot')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500 font-medium">Silakan masukkan detail login toko Anda.</p>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-red-50 text-red-500 px-4 py-3 rounded-xl border border-red-100 text-[12px] font-bold">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Email Toko</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="contoh@toko.com">
        </div>

        <div class="mb-4">
            <div class="flex items-center justify-between mb-2">
                <label class="block text-xs font-bold text-gray-700">Password</label>
            </div>
            <input type="password" name="password" required
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="••••••••">
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full py-3.5 px-4 bg-violet-600 hover:bg-violet-700 text-white font-bold text-[14px] rounded-xl active:scale-[0.98] transition-all duration-150 shadow-[0_4px_12px_-2px_rgba(108,61,227,0.3)]">
                Masuk ke Dashboard
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-[12px] font-medium text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}"
                class="font-extrabold text-violet-600 hover:text-violet-700 transition-colors ml-1">Daftar Sekarang</a>
        </p>
    </div>
@endsection