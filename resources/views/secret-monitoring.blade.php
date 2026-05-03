<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring — CuanPilot Secret</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 pb-10" x-data="{ tab: 'users' }">

    <!-- Header Compact -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-violet-600 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h1 class="text-sm font-black tracking-tight uppercase">Admin Console</h1>
            </div>
            <a href="/" class="text-[10px] font-bold text-slate-400 hover:text-violet-600 px-3 py-1.5 bg-slate-50 rounded-lg transition-all border border-slate-100 uppercase tracking-widest">
                Exit
            </a>
        </div>

        <!-- Tabs Navigation -->
        <div class="max-w-4xl mx-auto px-4 flex gap-6">
            <button @click="tab = 'users'" 
                class="pb-3 text-xs font-black uppercase tracking-widest transition-all relative"
                :class="tab === 'users' ? 'text-violet-600' : 'text-slate-400'">
                Pengguna ({{ $users->count() }})
                <div x-show="tab === 'users'" class="absolute bottom-0 left-0 right-0 h-1 bg-violet-600 rounded-t-full"></div>
            </button>
            <button @click="tab = 'tokens'" 
                class="pb-3 text-xs font-black uppercase tracking-widest transition-all relative"
                :class="tab === 'tokens' ? 'text-violet-600' : 'text-slate-400'">
                Tokens ({{ $unusedTokens->count() }})
                <div x-show="tab === 'tokens'" class="absolute bottom-0 left-0 right-0 h-1 bg-violet-600 rounded-t-full"></div>
            </button>
        </div>
    </header>

    <main class="max-w-4xl mx-auto p-4 mt-4">
        
        @if(session('success'))
            <div class="mb-4 bg-emerald-600 text-white px-4 py-3 rounded-xl text-[11px] font-bold shadow-lg shadow-emerald-200 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="$el.parentElement.remove()" class="text-white/50 hover:text-white">✕</button>
            </div>
        @endif

        <!-- TAB: USERS -->
        <div x-show="tab === 'users'" x-cloak class="space-y-3">
            @forelse($users as $user)
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                    <div class="flex justify-between items-start gap-4">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 mb-1 flex-wrap">
                                <span class="text-xs font-black text-slate-900 truncate tracking-tight">{{ $user->name }}</span>
                                <span class="px-1.5 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest 
                                    {{ $user->plan === 'lifetime' ? 'bg-amber-100 text-amber-600' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $user->plan }}
                                </span>
                                @if($user->is_active)
                                    <span class="px-1.5 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-600">Active</span>
                                @else
                                    <span class="px-1.5 py-0.5 rounded-md text-[8px] font-black uppercase tracking-widest bg-red-100 text-red-600">Inactive</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-slate-500 font-bold truncate tracking-tight mb-1 opacity-70">{{ $user->email }}</p>
                            <p class="text-[9px] text-violet-600 font-black uppercase tracking-widest">{{ $user->store_name ?: 'NO STORE NAME' }}</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <form action="{{ url('/kukanganonim/delete/' . $user->id) }}" method="POST" onsubmit="return confirm('Hapus user?')">
                                @csrf @method('DELETE')
                                <button class="p-2 bg-red-50 text-red-400 rounded-lg hover:text-red-600">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-4">
                        <form action="{{ url('/kukanganonim/toggle/' . $user->id) }}" method="POST" class="w-full">
                            @csrf
                            <button class="w-full py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all border 
                                {{ $user->is_active ? 'bg-red-50 text-red-600 border-red-100' : 'bg-emerald-50 text-emerald-600 border-emerald-100' }}">
                                {{ $user->is_active ? 'Suspend' : 'Activate' }}
                            </button>
                        </form>
                        @if($user->plan !== 'lifetime')
                            <form action="{{ url('/kukanganonim/upgrade/' . $user->id) }}" method="POST" class="w-full">
                                @csrf
                                <button class="w-full py-2.5 bg-violet-600 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-md shadow-violet-200">
                                    Upgrade
                                </button>
                            </form>
                        @else
                           <div class="w-full py-2.5 bg-slate-50 text-slate-400 text-[9px] font-black uppercase tracking-widest border border-slate-100 rounded-xl text-center flex items-center justify-center gap-1">
                               <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                               Full Member
                           </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em]">Belum ada pendaftar bro.</p>
                </div>
            @endforelse
        </div>

        <!-- TAB: TOKENS -->
        <div x-show="tab === 'tokens'" x-cloak class="space-y-2">
            @forelse($unusedTokens as $token)
                <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex justify-between items-center group active:bg-slate-50 transition-all"
                     @click="navigator.clipboard.writeText('{{ $token->token }}'); alert('Token {{ $token->token }} disalin!')">
                    <div>
                        <p class="text-xs font-black text-slate-800 tracking-widest font-mono uppercase">{{ $token->token }}</p>
                        <p class="text-[8px] font-black text-violet-500 uppercase mt-1 tracking-widest opacity-60">{{ $token->type }} Package</p>
                    </div>
                    <div class="text-slate-300">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center">
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em]">Semua token sudah terpakai.</p>
                </div>
            @endforelse

            <div class="mt-8 bg-violet-50 p-5 rounded-2xl border border-violet-100">
                <p class="text-[9px] text-violet-600 leading-relaxed font-black uppercase tracking-widest text-center">Tap token untuk menyalin kodenya.</p>
            </div>
        </div>

    </main>

</body>
</html>
