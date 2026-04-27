@extends('layouts.app')

@section('mobile_header')
<div class="bg-white px-5 pt-5 pb-4 border-b border-gray-100">
    <div class="flex items-center justify-between">
        <h1 class="text-[17px] font-extrabold text-gray-800">Laporan</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('laporan.export', ['period' => $period]) }}"
                class="flex items-center gap-1.5 px-3 py-1.5 bg-[#10B981] text-white text-[11px] font-bold rounded-[10px] shadow-sm active:scale-95 transition-all">
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Print Excel
            </a>
            <form method="GET" action="{{ route('laporan') }}">
                <div class="relative">
                    <select name="period" onchange="this.form.submit()"
                        class="bg-[#F8F5FF] text-[#6C3DE3] text-[11px] font-bold rounded-[10px] pl-3 pr-7 py-1.5 border border-[#E9D5FF] outline-none appearance-none cursor-pointer">
                        <option value="this_month" {{ $period === 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                        <option value="last_month" {{ $period === 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                        <option value="3_months" {{ $period === '3_months' ? 'selected' : '' }}>3 Bulan</option>
                    </select>
                    <svg class="h-3.5 w-3.5 text-[#6C3DE3] absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 pt-4 pb-6 space-y-4">

    {{-- Period badge --}}
    <div class="flex items-center gap-2">
        <div class="flex items-center gap-1.5 bg-[#F8F5FF] px-3 py-1 rounded-full border border-[#E9D5FF]">
            <svg class="h-3 w-3 text-[#6C3DE3]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="text-[11px] font-bold text-[#6C3DE3]">{{ $summary['period_label'] }}</span>
        </div>
        @if($summary['omzet'] == 0)
            <span class="text-[11px] font-medium text-gray-400">Belum ada data pesanan pada periode ini</span>
        @endif
    </div>

    <!-- ─── STAT GRID 2x2 ─── -->
    <div class="grid grid-cols-2 gap-3">
        {{-- Omzet --}}
        <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <p class="text-[11px] font-semibold text-gray-500 mb-1">Omzet</p>
            <p class="text-[15px] font-extrabold text-gray-800 leading-tight">
                Rp {{ number_format($summary['omzet'], 0, ',', '.') }}
            </p>
            <div class="flex items-center gap-1 mt-1.5">
                @if($summary['omzet_growth'] >= 0)
                    <svg class="h-3 w-3 text-[#10B981]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-[10px] font-bold text-[#10B981]">{{ $summary['omzet_growth'] }}%</span>
                @else
                    <svg class="h-3 w-3 text-[#EF4444]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-[10px] font-bold text-[#EF4444]">{{ abs($summary['omzet_growth']) }}%</span>
                @endif
                <span class="text-[10px] text-gray-400 font-medium">vs periode lalu</span>
            </div>
        </div>

        {{-- Total Pesanan --}}
        <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <p class="text-[11px] font-semibold text-gray-500 mb-1">Total Pesanan</p>
            <p class="text-[15px] font-extrabold text-gray-800 leading-tight">{{ $summary['total_orders'] }} Order</p>
            <div class="flex items-center gap-1 mt-1.5">
                <div class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></div>
                <span class="text-[10px] font-bold text-[#10B981]">{{ $summary['selesai'] }} selesai</span>
            </div>
        </div>

        {{-- Proses --}}
        <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <p class="text-[11px] font-semibold text-gray-500 mb-1">Sedang Proses</p>
            <p class="text-[15px] font-extrabold text-[#F59E0B] leading-tight">{{ $summary['pending'] }} Order</p>
            <div class="flex items-center gap-1 mt-1.5">
                <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-[10px] text-gray-400 font-medium">Belum selesai</span>
            </div>
        </div>

        {{-- Avg Margin --}}
        <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <p class="text-[11px] font-semibold text-gray-500 mb-1">Rata-rata Margin</p>
            <p class="text-[15px] font-extrabold text-[#6C3DE3] leading-tight">{{ $summary['avg_margin'] }}%</p>
            <div class="flex items-center gap-1 mt-1.5">
                @if($summary['avg_margin'] >= 30)
                    <div class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></div>
                    <span class="text-[10px] font-bold text-[#10B981]">Margin sehat</span>
                @else
                    <div class="w-1.5 h-1.5 rounded-full bg-[#F59E0B]"></div>
                    <span class="text-[10px] font-bold text-[#F59E0B]">Perlu ditingkatkan</span>
                @endif
            </div>
        </div>
    </div>

    <!-- ─── MENU TERLARIS ─── -->
    <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[13px] font-extrabold text-gray-800">Menu Terlaris</h3>
            <a href="{{ route('pesanan') }}" class="text-[11px] font-bold text-[#6C3DE3]">Lihat Order</a>
        </div>

        @if($summary['top_menus']->isEmpty())
            <div class="text-center py-6">
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-[12px] font-semibold text-gray-400">Belum ada data penjualan</p>
                <p class="text-[11px] text-gray-300 mt-1">Data muncul setelah ada pesanan selesai</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($summary['top_menus'] as $index => $item)
                    @php
                        $rankColors = [
                            0 => ['bg' => 'bg-[#FFF8EB]', 'text' => 'text-[#F59E0B]'],
                            1 => ['bg' => 'bg-gray-100',  'text' => 'text-gray-500'],
                            2 => ['bg' => 'bg-[#FFF7ED]', 'text' => 'text-[#F97316]'],
                        ];
                        $color = $rankColors[$index] ?? ['bg' => 'bg-[#F8F5FF]', 'text' => 'text-[#6C3DE3]'];
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-[10px] flex items-center justify-center text-[12px] font-extrabold shrink-0 {{ $color['bg'] }} {{ $color['text'] }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[12px] font-bold text-gray-800 truncate mb-0.5">{{ $item->menu->name }}</p>
                            <p class="text-[10px] font-medium text-gray-400">{{ number_format($item->total_qty, 0, ',', '.') }} porsi</p>
                        </div>
                        <div class="text-[12px] font-extrabold text-[#6C3DE3]">
                            Rp {{ number_format($item->total_revenue, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- ─── RINGKASAN ORDER ─── -->
    <div class="bg-white rounded-[16px] p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
        <h3 class="text-[13px] font-extrabold text-gray-800 mb-4">Ringkasan Order</h3>
        <div class="grid grid-cols-3 gap-3 text-center">
            <div>
                <p class="text-[10px] font-semibold text-gray-500 mb-1">Total</p>
                <p class="text-[20px] font-extrabold text-gray-800">{{ $summary['total_orders'] }}</p>
            </div>
            <div>
                <p class="text-[10px] font-semibold text-gray-500 mb-1">Selesai</p>
                <p class="text-[20px] font-extrabold text-[#10B981]">{{ $summary['selesai'] }}</p>
            </div>
            <div>
                <p class="text-[10px] font-semibold text-gray-500 mb-1">Proses</p>
                <p class="text-[20px] font-extrabold text-[#F59E0B]">{{ $summary['pending'] }}</p>
            </div>
        </div>

        @if($summary['total_orders'] > 0)
        <div class="mt-4">
            <div class="flex justify-between text-[10px] font-semibold text-gray-500 mb-1.5">
                <span>Tingkat Penyelesaian</span>
                @php $pct = round(($summary['selesai'] / $summary['total_orders']) * 100); @endphp
                <span>{{ $pct }}%</span>
            </div>
            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-[#10B981] rounded-full" style="width: {{ $pct }}%"></div>
            </div>
        </div>
        @endif
    </div>

    <!-- ─── TIPS PERFORMA ─── -->
    @if($summary['avg_margin'] > 0 && $summary['avg_margin'] < 30)
    <div class="bg-[#FFF8EB] rounded-[16px] p-4 border border-[#FEF3C7]">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 bg-[#FEF3C7] rounded-lg flex items-center justify-center shrink-0">
                <svg class="h-4 w-4 text-[#F59E0B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
            </div>
            <div>
                <p class="text-[12px] font-extrabold text-[#F59E0B] mb-1">Tips Meningkatkan Margin</p>
                <p class="text-[11px] font-medium text-[#92400E] leading-relaxed">
                    Rata-rata margin kamu <strong>{{ $summary['avg_margin'] }}%</strong>, sementara margin sehat di atas 30%.
                    Tinjau kembali HPP menu yang paling sering dipesan.
                </p>
                <a href="{{ route('menu') }}?tab=hpp" class="inline-block mt-2 text-[11px] font-bold text-[#F59E0B]">
                    Buka Kalkulator HPP &rarr;
                </a>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
