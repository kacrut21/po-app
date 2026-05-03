<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>PO-Management by CuanPilot — Sistem Manajemen PO Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            -webkit-font-smoothing: antialiased;
            background-color: #ffffff;
        }
        .text-violet-main { color: #6C3DE3; }
        .bg-violet-main { background-color: #6C3DE3; }
        .border-violet-main { border-color: #6C3DE3; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
        .feature-card:hover { transform: translateY(-4px); transition: all 0.3s ease; }
    </style>
</head>
<body class="text-slate-900 selection:bg-violet-100 selection:text-violet-700">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-violet-main rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-extrabold tracking-tight leading-none uppercase">CuanPilot</span>
                        <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase">PO Management</span>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-10">
                    <a href="#features" class="text-sm font-semibold text-slate-500 hover:text-violet-main transition-colors">Fitur</a>
                    <a href="#pricing" class="text-sm font-semibold text-slate-500 hover:text-violet-main transition-colors">Harga</a>
                    <a href="https://wa.me/628123456789" class="text-sm font-semibold text-slate-500 hover:text-violet-main transition-colors">Bantuan</a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="hidden sm:block text-sm font-bold text-slate-700 hover:text-violet-main transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-violet-main text-white text-sm font-bold px-6 py-3 rounded-2xl hover:bg-violet-700 transition-all shadow-xl shadow-violet-500/10">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-24 px-6 overflow-hidden">
        <div class="max-w-5xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-violet-50 text-violet-600 px-4 py-2 rounded-full text-xs font-bold mb-8 border border-violet-100">
                🚀 Dipercaya oleh ratusan owner bisnis UMKM
            </div>
            <h1 class="text-4xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] mb-8 tracking-tight">
                Cara modern kelola <br> <span class="text-violet-main italic">Pre-Order</span> bisnis Anda.
            </h1>
            <p class="text-base md:text-xl text-slate-500 mb-12 max-w-2xl mx-auto leading-relaxed">
                Platform internal khusus Admin untuk mencatat pesanan, hitung HPP otomatis, dan kirim invoice WhatsApp profesional tanpa repot.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-violet-main text-white font-bold rounded-2xl hover:bg-violet-700 shadow-2xl shadow-violet-500/20 transition-all text-lg">
                    Mulai Kelola PO Sekarang
                </a>
                <a href="#pricing" class="w-full sm:w-auto px-10 py-5 bg-white text-slate-600 font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all text-lg flex items-center justify-center gap-2">
                    Lihat Paket Lifetime
                </a>
            </div>

            <!-- Dashboard Preview -->
            <div class="mt-20 relative mx-auto max-w-5xl">
                <div class="absolute inset-0 bg-violet-200/30 blur-[120px] rounded-full -z-10 translate-y-20"></div>
                <div class="rounded-3xl border border-slate-200 shadow-2xl overflow-hidden bg-white p-2">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80" alt="App Preview" class="w-full h-auto rounded-2xl opacity-90 grayscale-[10%]">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <h2 class="text-3xl md:text-5xl font-bold mb-6 tracking-tight tracking-tight">Segala yang Anda butuhkan <br> untuk produktivitas admin.</h2>
                <p class="text-slate-500 font-medium">Dirancang sederhana agar Anda bisa fokus mengembangkan bisnis.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 feature-card shadow-sm">
                    <div class="w-14 h-14 bg-violet-50 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-violet-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Input Order Kilat</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Input data pesanan dari WA cukup dalam beberapa klik. Sistem otomatis menghitung total & sisa tagihan.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 feature-card shadow-sm">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Invoice WhatsApp</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Kirim detail pesanan langsung ke WhatsApp pelanggan dengan format yang rapi dan profesional.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 feature-card shadow-sm">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Kalkulator HPP</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">Pantau margin keuntungan setiap pesanan secara real-time. Bisnis makin sehat dan terukur.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section: Clean & Professional -->
    <section id="pricing" class="py-32">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold mb-6 tracking-tight">Investasi sekali, nikmati selamanya.</h2>
                <p class="text-slate-500 font-medium">Bantu operasional tim admin Anda naik level hari ini.</p>
            </div>

            <div class="bg-white rounded-[3rem] border border-slate-200 p-8 md:p-16 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 px-6 py-2 bg-violet-main text-white text-[10px] font-bold uppercase tracking-widest rounded-bl-3xl">
                    Early Bird Plan
                </div>

                <div class="text-center">
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest block mb-4">Akses Lifetime Selamanya</span>
                    <div class="flex flex-col items-center mb-8">
                        <span class="text-slate-300 text-lg font-bold line-through">Rp 499.000</span>
                        <div class="flex items-end gap-2">
                            <span class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter">99rb</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-12 text-left inline-block mx-auto">
                        <div class="flex items-center gap-3 text-sm font-medium text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                            Tanpa biaya langganan bulanan
                        </div>
                        <div class="flex items-center gap-3 text-sm font-medium text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                            Fitur Manajemen PO Lengkap
                        </div>
                        <div class="flex items-center gap-3 text-sm font-medium text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                            Support Prioritas WhatsApp
                        </div>
                    </div>

                    <div class="max-w-xs mx-auto mb-10">
                        <div class="flex justify-between items-end mb-3">
                            <span class="text-[10px] font-black text-slate-900 uppercase">Sisa 12 dari 50 slot tersedia</span>
                            <span class="text-[10px] font-bold text-violet-main">Limited Slot</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-violet-main transition-all duration-1000" style="width: 76%"></div>
                        </div>
                    </div>

                    <a href="{{ route('register') }}" class="block w-full py-5 bg-violet-main text-white font-bold rounded-2xl hover:bg-violet-700 transition-all text-xl shadow-xl shadow-violet-500/20 active:scale-95">
                        Dapatkan Akses Lifetime
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-24 px-6 border-t border-slate-100">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-12">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-violet-main rounded-lg flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="font-extrabold text-xl tracking-tight italic uppercase">CuanPilot</span>
            </div>
            
            <p class="text-sm text-slate-400 font-medium">&copy; 2026 PO-Management by CuanPilot — Sistem Manajemen PO Internal.</p>
            
            <div class="flex gap-10">
                <a href="https://wa.me/628123456789" class="text-sm font-semibold text-slate-500 hover:text-violet-main">WhatsApp CS</a>
                <a href="#" class="text-sm font-semibold text-slate-500 hover:text-violet-main">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <!-- Simple Float Button -->
    <a href="https://wa.me/628123456789" class="fixed bottom-8 right-8 z-[100] bg-white border border-slate-200 p-4 rounded-full shadow-xl hover:scale-110 transition-transform active:scale-95">
        <svg class="w-6 h-6 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.082 21.083c-1.503 0-2.973-.404-4.254-1.168l-4.73 1.242 1.265-4.613c-.838-1.32-1.28-2.855-1.28-4.446 0-4.613 3.753-8.366 8.366-8.366 4.613 0 8.366 3.753 8.366 8.366 0 4.613-3.753 8.366-8.366 8.366z"/></svg>
    </a>

</body>
</html>
