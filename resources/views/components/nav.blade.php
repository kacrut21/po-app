<nav class="fixed bottom-0 left-0 right-0 z-50 md:hidden shadow-[0_-4px_24px_rgba(0,0,0,0.04)]">
    <div class="max-w-lg mx-auto">
        <div class="bg-white/95 backdrop-blur-lg border-t border-gray-100/50 relative">
            <!-- Cutout effect for FAB -->
            <div class="flex items-center justify-between px-3 pt-2 pb-safe" style="padding-bottom: max(0.75rem, env(safe-area-inset-bottom))">

                <!-- Home -->
                <a href="{{ route('dashboard') }}"
                   class="flex flex-col items-center justify-center w-[4rem] h-12 relative transition-all duration-200
                          {{ request()->routeIs('dashboard') ? 'text-[#6C3DE3]' : 'text-gray-400 hover:text-[#6C3DE3]/70' }}">
                    @if(request()->routeIs('dashboard'))
                        <!-- Solid Home -->
                        <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                    @else
                        <!-- Outline Home -->
                        <svg class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    @endif
                    <span class="text-[10px] font-bold">Home</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="absolute bottom-[-6px] w-5 h-[3px] bg-[#6C3DE3] rounded-t-full"></div>
                    @endif
                </a>

                <!-- Pesanan -->
                <a href="{{ route('pesanan') }}"
                   class="flex flex-col items-center justify-center w-[4rem] h-12 relative transition-all duration-200
                          {{ request()->routeIs('pesanan') ? 'text-[#6C3DE3]' : 'text-gray-400 hover:text-[#6C3DE3]/70' }}">
                    @if(request()->routeIs('pesanan'))
                        <!-- Solid Order -->
                        <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <!-- Outline Order -->
                        <svg class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    @endif
                    <span class="text-[10px] font-bold">Pesanan</span>
                    @if(request()->routeIs('pesanan'))
                        <div class="absolute bottom-[-6px] w-5 h-[3px] bg-[#6C3DE3] rounded-t-full"></div>
                    @endif
                </a>

                <!-- FAB CENTER -->
                <div class="flex flex-col items-center justify-center w-[4.5rem] h-12 relative">
                    <a href="{{ route('form-po') }}"
                        class="absolute bottom-2 w-14 h-14 bg-[#6C3DE3] text-white rounded-full flex items-center justify-center shadow-[0_8px_16px_-4px_rgba(108,61,227,0.4)] active:scale-95 transition-all duration-150 border-4 border-white">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                    </a>
                </div>

                <!-- Katalog & HPP -->
                <a href="{{ route('menu') }}"
                   class="flex flex-col items-center justify-center w-[4rem] h-12 relative transition-all duration-200
                          {{ request()->routeIs('menu') ? 'text-[#6C3DE3]' : 'text-gray-400 hover:text-[#6C3DE3]/70' }}">
                    @if(request()->routeIs('menu'))
                        <!-- Solid Menu -->
                        <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <!-- Outline Menu -->
                        <svg class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    @endif
                    <span class="text-[10px] font-bold">Katalog</span>
                    @if(request()->routeIs('menu'))
                        <div class="absolute bottom-[-6px] w-5 h-[3px] bg-[#6C3DE3] rounded-t-full"></div>
                    @endif
                </a>

                <!-- Laporan -->
                <a href="{{ route('laporan') }}"
                   class="flex flex-col items-center justify-center w-[4rem] h-12 relative transition-all duration-200
                          {{ request()->routeIs('laporan') ? 'text-[#6C3DE3]' : 'text-gray-400 hover:text-[#6C3DE3]/70' }}">
                    @if(request()->routeIs('laporan'))
                        <!-- Solid Laporan -->
                        <svg class="h-6 w-6 mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    @else
                        <!-- Outline Laporan -->
                        <svg class="h-6 w-6 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                    <span class="text-[10px] font-bold">Laporan</span>
                    @if(request()->routeIs('laporan'))
                        <div class="absolute bottom-[-6px] w-5 h-[3px] bg-[#6C3DE3] rounded-t-full"></div>
                    @endif
                </a>

            </div>
            
            <!-- Safe area bottom bar for iOS -->
            <div class="h-1 bg-gray-300 w-1/3 mx-auto rounded-full mt-1 mb-1 hidden ios-indicator"></div>
        </div>
    </div>
</nav>
