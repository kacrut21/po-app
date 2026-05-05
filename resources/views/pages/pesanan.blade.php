@extends('layouts.app')

@section('desktop_header_extra')
    <a href="{{ route('form-po') }}"
        class="px-4 py-2 bg-[#6C3DE3] hover:bg-violet-700 text-white text-xs font-semibold rounded-xl transition-colors flex items-center gap-1.5">
        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd" />
        </svg>
        Tambah Order
    </a>
@endsection

@section('desktop_header_filters')
    <div class="hidden md:flex items-center gap-1"
        x-data="{cur: new URLSearchParams(window.location.search).get('status') || 'masuk'}"
        @status-change.window="cur=$event.detail">
        <template x-for="s in ['semua','masuk','konfirmasi','produksi','siap','selesai']" :key="s">
            <button @click="$dispatch('status-change', s)"
                class="px-3 py-1.5 rounded-lg text-[11px] font-bold transition-all"
                :class="cur===s ? 'bg-violet-100 text-violet-700' : 'text-gray-400 hover:text-gray-700 hover:bg-gray-50'">
                <span x-text="s==='semua'?'Semua':s==='siap'?'Siap Kirim':s.charAt(0).toUpperCase()+s.slice(1)"></span>
            </button>
        </template>
    </div>
@endsection

@section('mobile_header')
    <div class="bg-white px-5 pt-5 pb-2">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-[17px] font-extrabold text-gray-800 tracking-tight">Daftar Pre-Order</h1>
            <div class="flex items-center gap-3">
                <button class="w-8 h-8 flex items-center justify-center text-gray-600 active:scale-95 transition-transform">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <button class="w-8 h-8 flex items-center justify-center text-gray-600 active:scale-95 transition-transform">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="overflow-x-auto no-scrollbar -mx-2 px-2 pb-2" x-data="{cur: new URLSearchParams(window.location.search).get('status') || 'masuk'}"
            @status-change.window="cur=$event.detail">
            <div class="flex gap-2 min-w-max">
                <template x-for="s in ['semua','masuk','konfirmasi','produksi','siap','selesai']" :key="s">
                    <button @click="$dispatch('status-change',s)"
                        class="px-3.5 py-1.5 rounded-[14px] text-[11px] font-bold transition-all flex items-center gap-1.5"
                        :class="cur===s ? 'bg-[#6C3DE3] text-white shadow-[0_2px_8px_-2px_rgba(108,61,227,0.4)]' : 'bg-gray-50 text-gray-500 border border-gray-100 hover:bg-gray-100'">
                        <span
                            x-text="s==='semua'?'Semua':s==='siap'?'Siap Kirim':s.charAt(0).toUpperCase()+s.slice(1)"></span>
                        <span x-show="s!=='semua'" class="px-1.5 rounded-full text-[9px] font-extrabold"
                            :class="cur===s ? 'bg-white/20 text-white' : 'bg-gray-200 text-gray-600'"
                            x-text="poData.filter(p=>p.status===s).length"></span>
                    </button>
                </template>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div x-data="{ localOrders: @js($orders) }" x-init="poData = localOrders" @status-change.window="cur=$event.detail" class="px-4 md:px-6 pb-4 pt-4 md:pt-6">

        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-100 text-[12px] font-bold transition-all duration-500 mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
        <template x-for="po in poData.filter(p=>cur==='semua'||p.status===cur)" :key="po.id">
            <div @click="activePo=po; showDetailModal=true"
                class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50 cursor-pointer active:scale-[0.99] transition-all duration-150">

                <!-- Header: PO Number & Badge -->
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-extrabold text-gray-800" x-text="po.poNumber || 'PO-NEW'"></span>
                    <span class="px-2 py-0.5 rounded-lg text-[9px] font-bold tracking-wide" :class="{
                                          'bg-[#F1F5F9] text-[#64748B] border border-[#E2E8F0]': po.status==='masuk',
                                          'bg-[#EFF6FF] text-[#3B82F6] border border-[#DBEAFE]': po.status==='konfirmasi',
                                          'bg-[#FFF8EB] text-[#F59E0B] border border-[#FEF3C7]': po.status==='produksi',
                                          'bg-[#ECFDF5] text-[#10B981] border border-[#D1FAE5]': po.status==='siap',
                                          'bg-[#F3E8FF] text-[#A855F7] border border-[#E9D5FF]': po.status==='selesai'
                                      }"
                        x-text="po.status==='siap' ? 'Siap Kirim' : po.status.charAt(0).toUpperCase() + po.status.slice(1)"></span>
                </div>

                <!-- Info: Avatar, Name, Event -->
                <div class="flex items-start gap-3 mb-2">
                    <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(po.name||'User')}&background=random&color=fff&bold=true`"
                        :alt="po.name" class="w-8 h-8 rounded-full object-cover shrink-0">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-[12px] font-bold text-gray-800 truncate" x-text="po.name"></h4>
                        <p class="text-[10px] text-gray-500 font-medium" x-text="po.event || 'Acara'"></p>
                    </div>
                </div>

                <!-- Menu Info & Price -->
                <div class="flex items-end justify-between mb-3">
                    <p class="text-[10px] text-gray-500 truncate mt-1 font-medium"
                        x-html="(po.items&&po.items[0] ? po.items[0].qty+' Porsi &bull; '+po.items[0].menu : '') + (po.items&&po.items.length>1?' + '+(po.items.length-1)+' menu':'')">
                    </p>
                    <div class="text-[12px] font-bold text-gray-800" x-text="'Rp '+format(po.total || 0)"></div>
                </div>

                <!-- Footer: Date & Progress -->
                <div class="flex items-center justify-between text-[10px] text-gray-400 font-semibold mb-1">
                    <div class="flex items-center gap-1">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span
                            x-text="po.date ? new Date(po.date).toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric'}) : '-'"></span>
                    </div>
                    <span class="text-gray-800 font-bold" x-text="statusPercent(po)+'%'"></span>
                </div>
                <div class="w-full h-[5px] bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-500" :class="{
                                          'bg-gray-300': po.status==='masuk',
                                          'bg-[#6C3DE3]': ['konfirmasi','produksi'].includes(po.status),
                                          'bg-[#10B981]': ['siap','selesai'].includes(po.status)
                                      }" :style="`width: ${statusPercent(po)}%`"></div>
                </div>
            </div>
        </template>
        </div><!-- /grid -->

        <!-- Empty State -->
        <div x-show="poData.filter(p=>cur==='semua'||p.status===cur).length===0"
            class="flex flex-col items-center justify-center py-16 text-gray-400">
            <div
                class="w-16 h-16 bg-white border border-gray-100 shadow-sm rounded-xl flex items-center justify-center mb-3">
                <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <p class="text-[13px] font-bold text-gray-700">Belum Ada Pesanan</p>
            <p class="text-[11px] mt-1 text-gray-400">Pesanan yang sesuai filter akan muncul di sini</p>
        </div>

    </div>
@endsection