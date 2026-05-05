@extends('layouts.app')

@section('desktop_header_extra')
    <a href="{{ route('form-po') }}"
        class="px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-xs font-semibold rounded-xl transition-colors flex items-center gap-1.5 shadow-sm">
        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
        </svg>
        Tambah Order
    </a>
@endsection

@section('mobile_header')
<div class="bg-white px-5 pt-5 pb-3">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="text-base font-bold text-gray-800">
                    {{ Auth::user()->store_name ?: 'Halo, '.Auth::user()->name }}
                </h1>
                @if(Auth::check() && Auth::user()->plan === 'starter')
                    <button @click="showUpgradeModal = true" class="px-2 py-0.5 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[9px] font-extrabold rounded-md shadow-sm hover:scale-105 transition-transform tracking-wider">FREE</button>
                @endif
            </div>
            <p class="text-[11px] font-medium text-gray-500 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        {{-- Profile Button --}}
        <a href="{{ route('profile.show') }}"
            class="w-9 h-9 rounded-full bg-[#6C3DE3] flex items-center justify-center text-white text-[13px] font-extrabold shadow-[0_4px_12px_-2px_rgba(108,61,227,0.35)] shrink-0">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 md:px-8 space-y-4 pt-2 pb-4 max-w-5xl mx-auto">

    <!-- ─── ONBOARDING FLOW ─── -->
    @if($totalOrders === 0)
    <div x-data="{ showOnboarding: localStorage.getItem('hide_onboarding') !== 'true' }" x-show="showOnboarding" style="display: none;" class="mb-2">
        <div class="bg-white rounded-[16px] p-5 shadow-[0_8px_20px_-6px_rgba(108,61,227,0.15)] border border-violet-100 relative overflow-hidden">
            <!-- Decoration -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-violet-50 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h2 class="text-[15px] font-extrabold text-gray-800">Selamat datang di OrderIn! 🎉</h2>
                        <p class="text-[11px] font-medium text-gray-500 mt-1 leading-relaxed">Mari siapkan aplikasi kamu dalam 2 langkah mudah agar siap menerima orderan pertamamu.</p>
                    </div>
                    <button @click="localStorage.setItem('hide_onboarding', 'true'); showOnboarding = false" class="text-[10px] font-bold text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 px-2.5 py-1.5 rounded-lg transition-colors shrink-0">
                        Lewati
                    </button>
                </div>

                <div class="space-y-3">
                    <!-- Step 1: Menu -->
                    @if($totalMenus === 0)
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-violet-100 bg-violet-50/50">
                            <div class="w-9 h-9 shrink-0 bg-white rounded-full flex items-center justify-center shadow-sm border border-violet-100 text-violet-600 font-extrabold text-[13px]">
                                1
                            </div>
                            <div class="flex-1">
                                <h3 class="text-[12px] font-bold text-gray-800">Buat Katalog Menu</h3>
                                <p class="text-[10px] text-gray-500 font-medium">Tambahkan produk/menu yang kamu jual.</p>
                            </div>
                            <a href="{{ route('menu') }}" class="px-3 py-1.5 bg-[#6C3DE3] hover:bg-violet-700 text-white text-[11px] font-bold rounded-lg shadow-sm transition-colors shrink-0">
                                Buat Menu
                            </a>
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-emerald-100 bg-emerald-50/50 opacity-90">
                            <div class="w-9 h-9 shrink-0 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-[12px] font-bold text-gray-800 line-through">Buat Katalog Menu</h3>
                                <p class="text-[10px] text-emerald-600 font-bold">{{ $totalMenus }} menu berhasil ditambahkan! 🎉</p>
                            </div>
                        </div>
                    @endif

                    <!-- Step 2: Order -->
                    @if($totalMenus === 0)
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50/50 opacity-75">
                            <div class="w-9 h-9 shrink-0 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-200 text-gray-400 font-extrabold text-[13px]">
                                2
                            </div>
                            <div class="flex-1">
                                <h3 class="text-[12px] font-bold text-gray-600">Buat Pesanan Pertama</h3>
                                <p class="text-[10px] text-gray-400 font-medium">Catat orderan dari pelangganmu.</p>
                            </div>
                            <button disabled class="px-3 py-1.5 bg-gray-200 text-gray-400 text-[11px] font-bold rounded-lg cursor-not-allowed shrink-0">
                                Terkunci
                            </button>
                        </div>
                    @else
                        <div class="flex items-center gap-3 p-3 rounded-xl border border-violet-100 bg-violet-50/50">
                            <div class="w-9 h-9 shrink-0 bg-white rounded-full flex items-center justify-center shadow-sm border border-violet-100 text-violet-600 font-extrabold text-[13px]">
                                2
                            </div>
                            <div class="flex-1">
                                <h3 class="text-[12px] font-bold text-gray-800">Buat Pesanan Pertama</h3>
                                <p class="text-[10px] text-gray-500 font-medium">Catat orderan masuk pertamamu sekarang.</p>
                            </div>
                            <a href="{{ route('form-po') }}" class="px-3 py-1.5 bg-[#6C3DE3] hover:bg-violet-700 text-white text-[11px] font-bold rounded-lg shadow-sm transition-colors shrink-0 animate-pulse">
                                Buat Order
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ─── HERO CARD OMZET ─── -->
    <div class="gradient-violet rounded-xl p-5 text-white relative overflow-hidden shadow-[0_8px_20px_-6px_rgba(108,61,227,0.5)]">
        <div class="absolute -top-6 -right-6 w-28 h-28 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-8 -right-12 w-36 h-36 bg-white/5 rounded-full"></div>

        <div class="relative z-10">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-medium text-violet-100">Omzet Bulan Ini</span>
                <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                    </svg>
                </div>
            </div>

            <div class="mb-1">
                <div class="text-3xl font-extrabold tracking-tight">Rp {{ number_format($omzetBulanIni, 0, ',', '.') }}</div>
            </div>
            <div class="flex items-center gap-1.5 text-xs mt-2">
                @if($omzetGrowth >= 0)
                    <div class="flex items-center gap-0.5 text-green-300 font-bold">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $omzetGrowth }}%</span>
                    </div>
                @else
                    <div class="flex items-center gap-0.5 text-red-300 font-bold">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ abs($omzetGrowth) }}%</span>
                    </div>
                @endif
                <span class="text-violet-200 font-medium">dari bulan lalu</span>
            </div>
        </div>
    </div>

    <!-- ─── STAT GRID 2x2 on mobile, 4 cols on desktop ─── -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        {{-- PO Aktif --}}
        <a href="{{ route('pesanan', ['status' => 'semua']) }}"
            class="bg-white rounded-xl p-4 border border-gray-100/50 shadow-sm block active:scale-95 transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-semibold text-gray-500">PO Aktif</span>
                <svg class="h-3.5 w-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <div class="text-[22px] font-extrabold text-gray-800">{{ $activeOrders }}</div>
            <div class="text-[10px] text-gray-400 mt-1 font-medium">Order berjalan</div>
        </a>

        {{-- Margin Rata-rata --}}
        <a href="{{ route('menu') }}?tab=hpp"
            class="bg-white rounded-xl p-4 border border-gray-100/50 shadow-sm block active:scale-95 transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-semibold text-gray-500">Margin Rata-rata</span>
                <svg class="h-3.5 w-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <div class="text-[22px] font-extrabold text-gray-800">{{ round($avgMargin, 1) }}%</div>
            <div class="flex items-center gap-1 mt-1">
                @if($avgMargin >= 30)
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                    <span class="text-[10px] font-bold text-emerald-500">Sehat</span>
                @elseif($avgMargin > 0)
                    <div class="w-1.5 h-1.5 rounded-full bg-amber-400"></div>
                    <span class="text-[10px] font-bold text-amber-500">Perlu ditingkatkan</span>
                @else
                    <span class="text-[10px] text-gray-400">Belum ada data HPP</span>
                @endif
            </div>
        </a>

        {{-- Selesai Bulan Ini --}}
        <a href="{{ route('pesanan', ['status' => 'selesai']) }}"
            class="bg-white rounded-xl p-4 border border-gray-100/50 shadow-sm block active:scale-95 transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-semibold text-gray-500">Selesai Bulan Ini</span>
                <svg class="h-3.5 w-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <div class="text-[22px] font-extrabold text-gray-800">{{ $selesaiBulanIni }}</div>
            <div class="text-[10px] text-gray-400 mt-1 font-medium">Order selesai</div>
        </a>

        {{-- Deadline Dekat --}}
        <a href="{{ route('pesanan', ['status' => 'semua']) }}"
            class="bg-white rounded-xl p-4 border border-gray-100/50 shadow-sm block active:scale-95 transition-all">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-semibold text-gray-500">Deadline Dekat</span>
                <svg class="h-3.5 w-3.5 {{ $upcoming > 0 ? 'text-rose-400' : 'text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
            <div class="text-[22px] font-extrabold {{ $upcoming > 0 ? 'text-rose-500' : 'text-gray-800' }}">{{ $upcoming }}</div>
            <div class="text-[10px] {{ $upcoming > 0 ? 'text-rose-500 font-semibold' : 'text-gray-400 font-medium' }} mt-1">
                {{ $upcoming > 0 ? 'Dalam 2 hari' : 'Tidak ada deadline' }}
            </div>
        </a>
    </div>

    <!-- ─── ALERT DEADLINE ─── -->
    @if($upcoming > 0)
    <div class="bg-[#FFF8F6] border border-[#FFE2D6] rounded-xl p-4">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 bg-[#FFE2D6] rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                <svg class="h-4 w-4 text-[#D93F21]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h4 class="text-[13px] font-bold text-[#D93F21]">Peringatan Deadline</h4>
                <p class="text-[11px] text-[#E0674E] mt-0.5 leading-relaxed">
                    <strong>{{ $upcoming }} order</strong> akan jatuh tempo dalam 2 hari ke depan.
                </p>
                <a href="{{ route('pesanan', ['status' => 'semua']) }}" class="text-[11px] font-bold text-violet-600 mt-1.5 inline-block">Lihat Semua &rarr;</a>
            </div>
        </div>
    </div>
    @endif

    <!-- ─── ORDER AKTIF TERBARU ─── -->
    @if($recentOrders->isNotEmpty())
    <div class="bg-white rounded-xl p-4 border border-gray-100/50 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-[13px] font-bold text-gray-800">Order Aktif</h3>
            <a href="{{ route('pesanan', ['status' => 'semua']) }}" class="text-[11px] font-bold text-[#6C3DE3]">Lihat Semua</a>
        </div>
        <div class="space-y-3">
            @foreach($recentOrders as $order)
            @php
                $statusColors = [
                    'masuk'      => ['bg' => 'bg-[#F1F5F9]', 'text' => 'text-[#64748B]'],
                    'konfirmasi' => ['bg' => 'bg-[#EFF6FF]', 'text' => 'text-[#3B82F6]'],
                    'produksi'   => ['bg' => 'bg-[#FFF8EB]', 'text' => 'text-[#F59E0B]'],
                    'siap'       => ['bg' => 'bg-[#ECFDF5]', 'text' => 'text-[#10B981]'],
                ];
                $sc = $statusColors[$order->order_status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-500'];
                $firstItem = $order->items->first();
            @endphp
            <a href="{{ route('pesanan') }}" class="flex items-center gap-3 block active:scale-[0.99] transition-transform">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($order->customer_name) }}&background=random&color=fff&bold=true"
                    class="w-8 h-8 rounded-full object-cover shrink-0" alt="{{ $order->customer_name }}">
                <div class="flex-1 min-w-0">
                    <p class="text-[12px] font-bold text-gray-800 truncate">{{ $order->customer_name }}</p>
                    <p class="text-[10px] text-gray-400 font-medium truncate">
                        {{ $firstItem ? $firstItem->quantity.' porsi '.$firstItem->menu?->name : '-' }}
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="px-2 py-0.5 rounded-md text-[9px] font-bold {{ $sc['bg'] }} {{ $sc['text'] }}">
                        {{ $order->order_status === 'siap' ? 'Siap Kirim' : ucfirst($order->order_status) }}
                    </span>
                    <p class="text-[10px] font-bold text-gray-600 mt-1">
                        {{ Carbon\Carbon::parse($order->delivery_date)->format('d M') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @else
    {{-- Empty state --}}
    <div class="text-center py-8 text-gray-400">
        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
            <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-gray-500">Belum ada pesanan aktif</p>
        <p class="text-xs text-gray-400 mt-1">Tap tombol + untuk tambah order pertama</p>
        <a href="{{ route('form-po') }}"
            class="inline-block mt-4 px-5 py-2.5 bg-[#6C3DE3] text-white text-[12px] font-bold rounded-xl shadow-[0_4px_12px_-2px_rgba(108,61,227,0.4)] active:scale-95 transition-all">
            Tambah Order Sekarang
        </a>
    </div>
    @endif

</div>
@endsection