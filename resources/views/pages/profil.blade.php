@extends('layouts.app')

@section('mobile_header')
<div class="bg-white px-5 pt-5 pb-4 sticky top-0 z-20 shadow-sm border-b border-gray-100">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}"
            class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-100 rounded-full transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-[18px] font-extrabold text-gray-900 tracking-tight">Pengaturan</h1>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 pt-6 pb-24 space-y-8 max-w-xl mx-auto">

    {{-- Success Alert --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-[-10px]"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-[-10px]"
        class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-2xl border border-emerald-200 text-[13px] font-bold flex items-center gap-2 shadow-sm">
        <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Header Profile --}}
    <div class="flex flex-col items-center justify-center pt-2">
        <div class="relative">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-white text-[32px] font-extrabold shadow-lg shadow-violet-200 mb-4 border-4 border-white">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="absolute bottom-4 right-0 w-5 h-5 bg-emerald-500 border-2 border-white rounded-full"></div>
        </div>
        <h2 class="text-[19px] font-extrabold text-gray-900">{{ $user->store_name ?: $user->name }}</h2>
        <p class="text-[13px] text-gray-500 font-medium mt-0.5">{{ $user->email }}</p>
    </div>

    {{-- 1. PROFIL TOKO SECTION --}}
    <div class="space-y-3">
        <h3 class="text-[12px] font-bold text-gray-400 uppercase tracking-wider ml-1">Informasi Bisnis</h3>
        
        <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100">
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Nama Toko / Brand</label>
                    <input type="text" name="store_name" value="{{ old('store_name', $user->store_name) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                        placeholder="Contoh: Dapur Berkah">
                    @error('store_name') <p class="text-[11px] text-rose-500 mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Nama Pemilik <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                        placeholder="Nama lengkap" required>
                    @error('name') <p class="text-[11px] text-rose-500 mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">WhatsApp Bisnis</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[14px] font-bold text-gray-500">+62</span>
                        <input type="text" name="store_phone" value="{{ old('store_phone', $user->store_phone) }}"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                            placeholder="81234567890">
                    </div>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Alamat Utama</label>
                    <textarea name="store_address" rows="2"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all resize-none"
                        placeholder="Masukkan alamat lengkap toko">{{ old('store_address', $user->store_address) }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3.5 bg-violet-600 hover:bg-violet-700 text-white font-bold text-[14px] rounded-xl shadow-[0_4px_12px_rgba(108,61,227,0.25)] active:scale-[0.98] transition-all duration-150">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 2. TEMPLATE INVOICE SECTION --}}
    <div class="space-y-3" x-data='{ 
        template: @json($user->invoice_template ?: "*{store_name}*\n\nHalo Kak *{customer_name}*,\n\nBerikut detail pesanan Anda:\n\n*Nomor PO:* {po_number}\n*Acara:* {event}\n*Jadwal Kirim:* {delivery_date}\n*Alamat:* {address}\n\n*Detail Pesanan:*\n{items}\n\n*Ongkos Kirim:* Rp {shipping_fee}\n*Total Biaya:* Rp {total}\n*DP Dibayar:* Rp {dp}\n*Sisa Tagihan:* Rp {remaining}\n*Metode Bayar:* {payment_method}\n\nTerima kasih telah memesan! 🙏"),
        storeName: @json($user->store_name ?: $user->name),
        getPreview() {
            return this.template
                .replace(/{store_name}/g, this.storeName)
                .replace(/{customer_name}/g, "Budi")
                .replace(/{po_number}/g, "PO-240101-001")
                .replace(/{event}/g, "Ulang Tahun")
                .replace(/{delivery_date}/g, "Selasa, 1 Jan 2025 10:00")
                .replace(/{address}/g, "Jl. Contoh No. 123")
                .replace(/{items}/g, "- 50x Nasi Kuning (@Rp 20.000)")
                .replace(/{shipping_fee}/g, "15.000")
                .replace(/{total}/g, "1.015.000")
                .replace(/{dp}/g, "500.000")
                .replace(/{remaining}/g, "515.000")
                .replace(/{payment_method}/g, "Transfer BCA");
        }
    }'>
        <h3 class="text-[12px] font-bold text-gray-400 uppercase tracking-wider ml-1">Template Invoice WhatsApp</h3>

        <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 space-y-5">
            {{-- Preview Box --}}
            <div class="bg-[#f0f9eb] rounded-xl p-4 border border-[#d3efc2] relative overflow-hidden group cursor-default">
                <div class="absolute top-0 right-0 bg-[#d3efc2] text-[#5c983d] text-[9px] font-extrabold px-2 py-1 rounded-bl-lg uppercase tracking-wider">Preview WA</div>
                <div class="text-[12px] leading-[1.7] text-gray-700 font-medium whitespace-pre-line" x-text="getPreview()">
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="name" value="{{ $user->name }}">
                <input type="hidden" name="store_name" value="{{ $user->store_name }}">
                <input type="hidden" name="store_phone" value="{{ $user->store_phone }}">
                <input type="hidden" name="store_address" value="{{ $user->store_address }}">

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Format Pesan (Template)</label>
                    <textarea name="invoice_template" rows="10" x-model="template"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[13px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all resize-y"
                        placeholder="Format template invoice"></textarea>
                    <div class="mt-2.5 text-gray-500 space-y-1.5 w-full overflow-hidden">
                        <p class="text-[10px] font-medium">Variabel yang bisa digunakan (klik untuk copy):</p>
                        <div class="flex overflow-x-auto no-scrollbar gap-1.5 pb-2">
                            @php
                                $vars = ['{store_name}', '{customer_name}', '{po_number}', '{event}', '{delivery_date}', '{address}', '{items}', '{shipping_fee}', '{total}', '{dp}', '{remaining}', '{payment_method}'];
                            @endphp
                            @foreach($vars as $v)
                            <button type="button" 
                                @click="navigator.clipboard.writeText('{{ $v }}'); notify('Variabel {{ $v }} berhasil disalin!', 'success')"
                                class="bg-white border border-gray-200 px-1.5 py-0.5 rounded text-[9.5px] text-gray-600 font-bold shrink-0 whitespace-nowrap cursor-pointer hover:bg-gray-50 hover:border-emerald-300 hover:text-emerald-600 transition-all active:scale-95">
                                {{ $v }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="pt-1">
                    <button type="submit"
                        class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[14px] rounded-xl shadow-[0_4px_12px_rgba(16,185,129,0.25)] active:scale-[0.98] transition-all duration-150">
                        Simpan Template WA
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 3. KEAMANAN SECTION --}}
    <div class="space-y-3">
        <h3 class="text-[12px] font-bold text-gray-400 uppercase tracking-wider ml-1">Keamanan</h3>

        <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100">
            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Password Saat Ini</label>
                    <input type="password" name="current_password"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-rose-500 focus:ring-4 focus:ring-rose-500/10 transition-all"
                        placeholder="••••••••" required>
                    @error('current_password') <p class="text-[11px] text-rose-500 mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Password Baru</label>
                    <input type="password" name="password"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                        placeholder="Minimal 8 karakter" required>
                    @error('password') <p class="text-[11px] text-rose-500 mt-1 font-bold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation"
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-[14px] font-semibold text-gray-900 focus:bg-white focus:outline-none focus:border-violet-500 focus:ring-4 focus:ring-violet-500/10 transition-all"
                        placeholder="Ulangi password baru" required>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3.5 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 font-bold text-[14px] rounded-xl active:scale-[0.98] transition-all duration-150">
                        Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- PWA Install Button --}}
    <div id="pwa-install-btn" class="hidden">
        <button onclick="installPWA()"
            class="w-full flex items-center justify-center gap-2.5 py-4 bg-violet-50 text-violet-600 font-bold text-[14px] rounded-2xl border border-violet-100 hover:bg-violet-100 transition-all active:scale-[0.98]">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Install Aplikasi di HP
        </button>
    </div>

    {{-- 4. LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}" class="pt-4">
        @csrf
        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar dari aplikasi?')"
            class="w-full flex items-center justify-center gap-2.5 py-4 text-gray-400 font-bold text-[14px] hover:text-rose-600 hover:bg-rose-50 rounded-2xl transition-all">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Keluar Aplikasi
        </button>
    </form>

    <div class="text-center pt-2 pb-6 opacity-50">
        <p class="text-[11px] text-gray-500 font-extrabold tracking-widest uppercase">PO-Management by CuanPilot v1.0.5</p>
    </div>

</div>
@endsection
