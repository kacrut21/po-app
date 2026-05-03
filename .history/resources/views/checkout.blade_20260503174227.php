<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout Lifetime — PO-Management by CuanPilot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
        .bg-violet-custom { background-color: #6C3DE3; }
        .text-violet-custom { color: #6C3DE3; }
        .border-violet-custom { border-color: #6C3DE3; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col">

    <!-- Header Compact -->
    <nav class="bg-white border-b border-slate-100 py-3 px-4 sticky top-0 z-50">
        <div class="max-w-xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-violet-custom rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div style="line-height: 1">
                    <span style="color: #1e293b; font-size: 13px; font-weight: 900; letter-spacing: -0.5px; text-transform: uppercase;">PO-Management</span><br>
                    <span style="color: #6C3DE3; font-size: 8px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">by CuanPilot</span>
                </div>
            </a>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest border border-slate-100 px-2 py-1 rounded-md">
                SECURE CHECKOUT
            </div>
        </div>
    </nav>

    <main class="flex-1 py-6 px-4" x-data="{
        step: 1,
        loading: false,
        form: {
            name: '',
            email: '',
            store_name: '',
            password: ''
        },
        payment: {
            bank: 'BCA',
            number: '8090515152',
            name: 'ADITYA PERMANA PUTRA',
            amount: 99000
        },
        copyText(text) {
            navigator.clipboard.writeText(text);
            alert('Nomor rekening disalin!');
        },
        get waUrl() {
            const msg = `Halo Admin CuanPilot, saya mau konfirmasi pembayaran Lifetime Deal.\n\nDetail Akun:\nNama: ${this.form.name}\nEmail: ${this.form.email}\nToko: ${this.form.store_name}\n\nSaya sudah transfer Rp 99.000 ke Rekening BCA an Aditia Oktavian. Mohon aktivasinya.`;
            return `https://wa.me/6287825530343?text=${encodeURIComponent(msg)}`;
        },
        async submitStep1() {
            if(!this.form.name || !this.form.email || !this.form.store_name || !this.form.password) {
                alert('Mohon lengkapi semua data!');
                return;
            }

            this.loading = true;
            try {
                const response = await fetch('{{ route('checkout.process') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify(this.form)
                });

                const data = await response.json();

                if (data.success) {
                    this.step = 2;
                    window.scrollTo(0, 0);
                } else {
                    alert(data.message || 'Terjadi kesalahan. Pastikan email belum terdaftar.');
                }
            } catch (error) {
                alert('Gagal menghubungkan ke server. Silakan coba lagi.');
            } finally {
                this.loading = false;
            }
        }
    }">
        <div class="max-w-md mx-auto">

            <!-- Compact Progress Steps -->
            <div class="flex items-center justify-between mb-8 px-2">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-all"
                         :class="step >= 1 ? 'bg-violet-custom text-white' : 'bg-slate-200 text-slate-400'">1</div>
                    <span class="text-[9px] font-black uppercase tracking-widest" :class="step >= 1 ? 'text-violet-custom' : 'text-slate-400'">Info Akun</span>
                </div>
                <div class="flex-1 h-[1px] mx-4 bg-slate-200 relative">
                    <div class="absolute inset-y-0 left-0 bg-violet-custom transition-all duration-500" :style="`width: ${step > 1 ? '100%' : '0%'}`"></div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-all"
                         :class="step >= 2 ? 'bg-violet-custom text-white' : 'bg-slate-200 text-slate-400'">2</div>
                    <span class="text-[9px] font-black uppercase tracking-widest" :class="step >= 2 ? 'text-violet-custom' : 'text-slate-400'">Payment</span>
                </div>
            </div>

            <!-- STEP 1: ACCOUNT INFO (COMPACT) -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-white rounded-[1.5rem] p-6 shadow-sm border border-slate-200">
                    <h2 class="text-lg font-black text-slate-900 mb-1">Daftar Akun</h2>
                    <p class="text-[11px] text-slate-400 mb-6 font-bold uppercase tracking-tight italic">Paket Lifetime Deal — Akses Selamanya</p>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 mb-1.5 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" x-model="form.name" placeholder="Nama Anda"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 mb-1.5 uppercase tracking-widest">Email Toko</label>
                            <input type="email" x-model="form.email" placeholder="email@toko.com"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 mb-1.5 uppercase tracking-widest">Nama Bisnis</label>
                            <input type="text" x-model="form.store_name" placeholder="Misal: Catering Berkah"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 mb-1.5 uppercase tracking-widest">Password Login</label>
                            <input type="password" x-model="form.password" placeholder="Minimal 8 karakter"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <button @click="submitStep1()" :disabled="loading"
                            class="w-full mt-8 py-4 bg-violet-600 text-white font-black rounded-xl shadow-lg shadow-violet-200 hover:bg-violet-700 transition-all text-sm active:scale-95 disabled:opacity-50">
                        <span x-show="!loading">LANJUT KE PEMBAYARAN</span>
                        <span x-show="loading">MEMPROSES...</span>
                    </button>

                    <p class="mt-4 text-center text-[10px] font-bold text-slate-400">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-violet-600 hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </div>

            <!-- STEP 2: PAYMENT INFO (COMPACT) -->
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-white rounded-[1.5rem] p-6 shadow-sm border border-slate-200 text-center">
                    <h2 class="text-lg font-black text-slate-900 mb-1 uppercase tracking-tight italic text-violet-600 underline decoration-4 decoration-violet-100">Instruksi Bayar</h2>
                    <p class="text-[10px] text-slate-400 mb-6 font-bold uppercase tracking-widest">Transfer manual ke rekening di bawah</p>

                    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 mb-6">
                        <div class="mb-5">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Transfer</p>
                            <p class="text-3xl font-[1000] text-slate-900 tracking-tighter">Rp 99.000</p>
                        </div>

                        <div class="space-y-3 text-left">
                            <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-slate-100">
                                <span class="text-[10px] font-black text-slate-400 uppercase">Bank BCA</span>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="h-3">
                            </div>
                            <div class="flex justify-between items-center bg-white p-3 rounded-xl border border-slate-100 cursor-pointer active:bg-slate-50 transition-colors"
                                 @click="copyText(payment.number)">
                                <div>
                                    <p class="text-[8px] font-black text-slate-300 uppercase">No Rekening (Tap Copy)</p>
                                    <p class="text-sm font-[1000] text-slate-800 tracking-widest" x-text="payment.number"></p>
                                </div>
                                <svg class="w-4 h-4 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                            </div>
                            <div class="bg-white p-3 rounded-xl border border-slate-100">
                                <p class="text-[8px] font-black text-slate-300 uppercase">Atas Nama</p>
                                <p class="text-xs font-black text-slate-800 uppercase" x-text="payment.name"></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a :href="waUrl" target="_blank"
                           class="w-full py-4 bg-emerald-500 text-white font-black rounded-xl shadow-lg shadow-emerald-100 hover:bg-emerald-600 transition-all text-sm flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.082 21.083c-1.503 0-2.973-.404-4.254-1.168l-4.73 1.242 1.265-4.613c-.838-1.32-1.28-2.855-1.28-4.446 0-4.613 3.753-8.366 8.366-8.366 4.613 0 8.366 3.753 8.366 8.366 0 4.613-3.753 8.366-8.366 8.366z"/></svg>
                            KONFIRMASI BAYAR (WA)
                        </a>

                        <a href="{{ route('login') }}"
                           class="w-full py-4 bg-white text-slate-800 font-black rounded-xl border border-slate-200 hover:bg-slate-50 transition-all text-sm flex items-center justify-center gap-2 uppercase tracking-tight">
                            Sudah Konfirmasi? Login
                        </a>
                    </div>

                    <button @click="step = 1" class="mt-6 text-[10px] font-black text-slate-300 uppercase tracking-widest hover:text-slate-500 transition-colors">
                        ← Edit Data Akun
                    </button>
                </div>
            </div>

            <!-- Footer Small -->
            <p class="mt-12 text-center text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">
                &copy; 2026 PO-Management
            </p>
        </div>
    </main>

</body>
</html>
