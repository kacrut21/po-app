<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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

    <!-- Header -->
    <nav class="bg-white border-b border-slate-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-violet-custom rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div style="line-height: 1.1">
                    <span style="color: #1e293b; font-size: 15px; font-weight: 900; letter-spacing: -0.5px; text-transform: uppercase; display: block;">PO-Management</span>
                    <span style="color: #6C3DE3; font-size: 9px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">by CuanPilot</span>
                </div>
            </a>
            <div class="flex items-center gap-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Secure Checkout
            </div>
        </div>
    </nav>

    <main class="flex-1 py-10 px-5" x-data="{
        step: 1,
        form: {
            name: '',
            email: '',
            store_name: '',
            password: ''
        },
        payment: {
            bank: 'BCA',
            number: '1394176152',
            name: 'ADITY PERMANA PUTRA',
            amount: 99000
        },
        copyText(text) {
            navigator.clipboard.writeText(text);
            alert('Berhasil disalin!');
        },
        get waUrl() {
            const msg = `Halo Admin CuanPilot, saya mau konfirmasi pembayaran Lifetime Deal.\n\nDetail Akun:\nNama: ${this.form.name}\nEmail: ${this.form.email}\nToko: ${this.form.store_name}\n\nSaya sudah transfer Rp 99.000 ke Rekening BCA an Aditia Oktavian. Mohon aktivasinya.`;
            return `https://wa.me/6282240213137?text=${encodeURIComponent(msg)}`;
        }
    }">
        <div class="max-w-xl mx-auto">

            <!-- Progress Steps -->
            <div class="flex items-center justify-between mb-10 px-4">
                <div class="flex flex-col items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all"
                         :class="step >= 1 ? 'bg-violet-custom text-white' : 'bg-slate-200 text-slate-400'">1</div>
                    <span class="text-[10px] font-bold uppercase tracking-tight" :class="step >= 1 ? 'text-violet-custom' : 'text-slate-400'">Info Akun</span>
                </div>
                <div class="flex-1 h-[2px] mx-4 bg-slate-200 relative">
                    <div class="absolute inset-y-0 left-0 bg-violet-custom transition-all duration-500" :style="`width: ${step > 1 ? '100%' : '0%'}`"></div>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition-all"
                         :class="step >= 2 ? 'bg-violet-custom text-white' : 'bg-slate-200 text-slate-400'">2</div>
                    <span class="text-[10px] font-bold uppercase tracking-tight" :class="step >= 2 ? 'text-violet-custom' : 'text-slate-400'">Pembayaran</span>
                </div>
            </div>

            <!-- STEP 1: ACCOUNT INFO -->
            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-slate-100">
                    <h2 class="text-xl font-black text-slate-900 mb-2">Lengkapi Data Akun</h2>
                    <p class="text-sm text-slate-500 mb-8 font-medium">Data ini akan digunakan untuk login ke aplikasi.</p>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" x-model="form.name" placeholder="Misal: Budi Santoso"
                                   class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-widest">Email Toko</label>
                            <input type="email" x-model="form.email" placeholder="email@contoh.com"
                                   class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-widest">Nama Bisnis / Toko</label>
                            <input type="text" x-model="form.store_name" placeholder="Misal: Catering Berkah"
                                   class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-widest">Password Login</label>
                            <input type="password" x-model="form.password" placeholder="Minimal 8 karakter"
                                   class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold focus:outline-none focus:border-violet-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <button @click="if(form.name && form.email && form.store_name && form.password) step = 2; else alert('Mohon lengkapi semua data!')"
                            class="w-full mt-10 py-5 bg-violet-custom text-white font-black rounded-2xl shadow-xl hover:bg-violet-700 transition-all text-lg active:scale-95">
                        LANJUT KE PEMBAYARAN
                    </button>
                </div>
            </div>

            <!-- STEP 2: PAYMENT INFO -->
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-slate-100">
                    <h2 class="text-xl font-black text-slate-900 mb-2 text-center">Instruksi Pembayaran</h2>
                    <p class="text-sm text-slate-500 mb-8 font-medium text-center italic">Silakan transfer sesuai nominal untuk aktivasi otomatis.</p>

                    <div class="p-6 bg-violet-50 rounded-3xl border border-violet-100 mb-8">
                        <div class="text-center mb-6">
                            <p class="text-[10px] font-black text-violet-400 uppercase tracking-[0.2em] mb-1">Nominal Transfer</p>
                            <p class="text-4xl font-[1000] text-violet-custom tracking-tighter">Rp 99.000</p>
                        </div>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-violet-100">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase">Bank Tujuan</p>
                                    <p class="text-sm font-extrabold text-slate-800" x-text="payment.bank"></p>
                                </div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="h-4">
                            </div>
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-violet-100 cursor-pointer hover:bg-slate-50 transition-colors"
                                 @click="copyText(payment.number)">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase">Nomor Rekening</p>
                                    <p class="text-sm font-[1000] text-slate-800 tracking-wider" x-text="payment.number"></p>
                                </div>
                                <svg class="w-5 h-5 text-violet-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                            </div>
                            <div class="flex justify-between items-center bg-white p-4 rounded-2xl border border-violet-100">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase">Atas Nama</p>
                                    <p class="text-sm font-extrabold text-slate-800 uppercase" x-text="payment.name"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-8 flex gap-3 items-start">
                        <span class="text-lg">💡</span>
                        <p class="text-[11px] font-bold text-amber-800 leading-relaxed uppercase italic">Penting: Setelah transfer, klik tombol di bawah untuk konfirmasi via WhatsApp agar akun segera diaktifkan oleh Admin.</p>
                    </div>

                    <a :href="waUrl" target="_blank"
                       class="w-full py-5 bg-emerald-500 text-white font-black rounded-2xl shadow-xl hover:bg-emerald-600 transition-all text-lg active:scale-95 flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.082 21.083c-1.503 0-2.973-.404-4.254-1.168l-4.73 1.242 1.265-4.613c-.838-1.32-1.28-2.855-1.28-4.446 0-4.613 3.753-8.366 8.366-8.366 4.613 0 8.366 3.753 8.366 8.366 0 4.613-3.753 8.366-8.366 8.366z"/></svg>
                        KONFIRMASI VIA WHATSAPP
                    </a>

                    <button @click="step = 1" class="w-full mt-4 py-3 text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors">
                        ← KEMBALI EDIT DATA
                    </button>
                </div>
            </div>

            <!-- Footer Small -->
            <p class="mt-12 text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
                &copy; 2026 PO-Management by CuanPilot
            </p>
        </div>
    </main>

</body>
</html>
