@extends('layouts.auth')

@section('title', 'Daftar - PO-Management by CuanPilot')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 font-medium">Mulai kelola pesanan toko Anda hari ini.</p>
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

    <form action="{{ route('register') }}" method="POST" class="space-y-5">
        @csrf

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Kode Pendaftaran / Token <span class="text-rose-500">*</span></label>
            <input type="text" name="registration_token" value="{{ old('registration_token') }}" required autofocus
                class="block w-full px-5 py-3.5 bg-violet-50 border border-violet-200 rounded-xl text-[13px] font-bold text-violet-800 placeholder-violet-300 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all uppercase tracking-widest"
                placeholder="XXXX-XXXX">
            <p class="text-[10px] text-gray-500 mt-1.5 font-medium leading-relaxed">
                Untuk mendapatkan token uji coba (Starter Pack), silakan hubungi Admin via 
                <a href="https://wa.me/6287825530343?text=Halo%20Admin,%20saya%20mau%20minta%20token%20uji%20coba%20untuk%20daftar%20PO-Management%20dong" 
                   target="_blank" class="text-violet-600 font-bold hover:underline">WhatsApp Admin</a>.
            </p>
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Nama Pemilik / Admin</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="Budi Santoso">
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Email Toko</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="email@toko.com">
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Password</label>
            <input type="password" name="password" required
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="Minimal 8 karakter">
        </div>

        <div class="mb-4">
            <label class="block text-xs font-bold text-gray-700 mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="block w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-[13px] font-semibold text-gray-800 placeholder-gray-400 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                placeholder="Ulangi password">
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full py-3.5 px-4 bg-violet-600 hover:bg-violet-700 text-white font-bold text-[14px] rounded-xl active:scale-[0.98] transition-all duration-150 shadow-[0_4px_12px_-2px_rgba(108,61,227,0.3)]">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <p class="text-[12px] font-medium text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}"
                class="font-extrabold text-violet-600 hover:text-violet-700 transition-colors ml-1">Masuk di sini</a>
        </p>
    </div>
@endsection