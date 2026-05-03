<!DOCTYPE html>
     2 <html lang="id" class="scroll-smooth">
     3 <head>
     4     <meta charset="UTF-8">
     5     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     6     <title>OrderIn — Kelola Pre-Order Catering & Aqiqah dengan Mudah</title>
     7     <script src="https://cdn.tailwindcss.com"></script>
     8     <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
     9     <link rel="preconnect" href="https://fonts.googleapis.com">
    10     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    11     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
       rel="stylesheet">
    12     <style>
    13         :root {
    14             --primary: #6C63FF;
    15             --primary-light: #7F77DD;
    16             --bg-light: #F8FAFC;
    17         }
    18         body { font-family: 'Inter', sans-serif; }
    19         .bg-primary { background-color: var(--primary); }
    20         .text-primary { color: var(--primary); }
    21         .border-primary { border-color: var(--primary); }
    22         .hero-gradient {
    23             background: linear-gradient(135deg, rgba(108, 67, 255, 0.05) 0%, rgba(255, 255, 255, 1)
       100%);
    24         }
    25         .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
    26         .reveal.active { opacity: 1; transform: translateY(0); }
    27     </style>
    28 </head>
    29 <body class="bg-white text-slate-800">
    30
    31     <!-- NAVBAR -->
    32     <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
    33         <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
    34             <div class="flex items-center gap-2">
    35                 <span class="text-2xl font-extrabold text-primary tracking-tight
       italic">OrderIn.</span>
    36                 <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">By
       CuanPilot</span>
    37             </div>
    38
    39             <div class="hidden md:flex items-center gap-10">
    40                 <a href="#fitur" class="text-sm font-semibold text-slate-600 hover:text-primary
       transition-colors">Fitur</a>
    41                 <a href="#harga" class="text-sm font-semibold text-slate-600 hover:text-primary
       transition-colors">Harga</a>
    42                 <a href="#tentang" class="text-sm font-semibold text-slate-600 hover:text-primary
       transition-colors">Tentang</a>
    43             </div>
    44
    45             <a href="{{ route('register') }}" class="bg-primary text-white text-sm font-bold px-6 py-3       rounded-2xl hover:bg-violet-700 transition-all shadow-lg shadow-indigo-200">
    46                 Coba Gratis
    47             </a>
    48         </div>
    49     </nav>
    50
    51     <!-- HERO SECTION -->
    52     <section class="hero-gradient pt-40 pb-24 px-6">
    53         <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
    54             <div class="reveal">
    55                 <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 leading-[1.1] mb-6
       tracking-tight">
    56                     Kelola Pre-Order Catering & Aqiqah Jadi Lebih <span class="text-primary
       italic">Rapi & Profitable.</span>
    57                 </h1>
    58                 <p class="text-lg text-slate-500 mb-10 leading-relaxed">
    59                     Dari terima pesanan, pantau produksi, sampai kirim invoice ke WhatsApp — semua
       dalam satu aplikasi. Berhenti rekap manual, mulai kembangkan bisnis Anda.
    60                 </p>
    61                 <div class="flex flex-col sm:flex-row items-center gap-4">
    62                     <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-primary
       text-white font-bold rounded-2xl hover:bg-violet-700 transition-all shadow-xl shadow-indigo-200
       text-lg text-center">
    63                         Mulai Gratis Sekarang
    64                     </a>
    65                     <a href="#demo" class="w-full sm:w-auto px-8 py-4 bg-white text-primary font-bold
       rounded-2xl border-2 border-primary hover:bg-indigo-50 transition-all text-lg text-center">
    66                         Lihat Demo
    67                     </a>
    68                 </div>
    69             </div>
    70             <div class="reveal">
    71                 <div class="rounded-3xl border-8 border-slate-900/5 shadow-2xl overflow-hidden
       bg-white aspect-video relative">
    72                     <img
       src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&auto=format&fit=crop&       w=1350&q=80" alt="OrderIn Dashboard" class="w-full h-full object-cover opacity-90">
    73                     <div class="absolute inset-0 flex items-center justify-center">
    74                         <div class="w-16 h-16 bg-primary/90 rounded-full flex items-center
       justify-center text-white shadow-xl cursor-pointer hover:scale-110 transition-transform">
    75                             <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 20 20"><path
       d="M4.5 3.5v13l11-6.5-11-6.5z"/></svg>
    76                         </div>
    77                     </div>
    78                 </div>
    79             </div>
    80         </div>
    81     </section>
    82
    83     <!-- STATS BAR -->
    84     <section class="py-12 border-y border-slate-100 bg-white">
    85         <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
    86             <div class="text-center reveal">
    87                 <p class="text-3xl font-extrabold text-slate-900">500+</p>
    88                 <p class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-widest">Pengguna
       Aktif</p>
    89             </div>
    90             <div class="text-center reveal">
    91                 <p class="text-3xl font-extrabold text-slate-900">10.000+</p>
    92                 <p class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-widest">Order
       Dikelola</p>
    93             </div>
    94             <div class="text-center reveal">
    95                 <p class="text-3xl font-extrabold text-slate-900 text-primary">4.9★</p>
    96                 <p class="text-sm font-medium text-slate-500 mt-1 uppercase tracking-widest">Rating
       Pengguna</p>
    97             </div>
    98         </div>
    99     </section>
   100
   101     <!-- PAIN POINT SECTION -->
   102     <section id="tentang" class="py-24 px-6 bg-slate-50">
   103         <div class="max-w-5xl mx-auto">
   104             <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 tracking-tight">Masih Kelola
       Pre-Order <br> Pakai <span class="text-red-500 underline underline-offset-4">Catatan
       Manual?</span></h2>
   105
   106             <div class="grid md:grid-cols-3 gap-8">
   107                 <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 reveal">
   108                     <div class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl flex items-center
       justify-center mb-6">
   109                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2.5"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732
       4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
   110                     </div>
   111                     <h3 class="font-bold text-lg mb-3">Deadline Berantakan</h3>
   112                     <p class="text-slate-500 text-sm leading-relaxed">Pesanan menumpuk di chat WA,
       sering lupa tanggal kirim, dan bikin pelanggan kecewa.</p>
   113                 </div>
   114                 <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 reveal">
   115                     <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center
       justify-center mb-6">
   116                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2.5"><path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9
       11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
   117                     </div>
   118                     <h3 class="font-bold text-lg mb-3">Bingung Hitung Profit</h3>
   119                     <p class="text-slate-500 text-sm leading-relaxed">Susah menghitung HPP per porsi
       secara akurat. Jualan rame tapi saldo di tabungan gak nambah.</p>
   120                 </div>
   121                 <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 reveal">
   122                     <div class="w-12 h-12 bg-indigo-50 text-primary rounded-2xl flex items-center
       justify-center mb-6">
   123                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2.5"><path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3       3m0 0l-3-3m3 3V4"/></svg>
   124                     </div>
   125                     <h3 class="font-bold text-lg mb-3">Invoice Ketik Manual</h3>
   126                     <p class="text-slate-500 text-sm leading-relaxed">Harus ketik ulang rincian
       pesanan dan total harga satu per satu ke chat pelanggan. Buang waktu!</p>
   127                 </div>
   128             </div>
   129         </div>
   130     </section>
   131
   132     <!-- FITUR UTAMA -->
   133     <section id="fitur" class="py-32 px-6">
   134         <div class="max-w-7xl mx-auto">
   135             <div class="text-center mb-24">
   136                 <h2 class="text-3xl md:text-5xl font-extrabold mb-6 tracking-tight
       tracking-tight">Fitur yang Bikin <br> Bisnis Anda <span class="text-primary
       italic">Autopilot.</span></h2>
   137                 <p class="text-slate-500 font-medium max-w-xl mx-auto leading-relaxed
       text-sm">Dirancang khusus untuk kebutuhan operasional katering, aqiqah, dan usaha makanan rumahan.</p>   138             </div>
   139
   140             <div class="grid lg:grid-cols-2 gap-16 items-center mb-32 reveal">
   141                 <div class="bg-indigo-50 rounded-[3rem] p-10 h-full flex items-center shadow-inner">
   142                     <div class="w-full h-48 bg-white/50 rounded-2xl border-4 border-dashed
       border-primary/20 flex items-center justify-center text-primary font-bold">Screenshot Dashboard</div>
   143                 </div>
   144                 <div>
   145                     <div class="w-14 h-14 bg-indigo-100 text-primary rounded-2xl flex items-center
       justify-center mb-6">
   146                         <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2
       0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2
       2h-2a2 2 0 01-2-2z"/></svg>
   147                     </div>
   148                     <h4 class="text-2xl font-bold mb-4">Dashboard Bisnis Real-time</h4>
   149                     <p class="text-slate-500 leading-relaxed">Pantau omzet bulanan, jumlah PO aktif,
       rata-rata margin keuntungan, dan deadline pesanan terdekat dalam satu layar dashboard yang
       intuitif.</p>
   150                 </div>
   151             </div>
   152
   153             <div class="grid lg:grid-cols-2 gap-16 items-center mb-32 reveal">
   154                 <div class="order-2 lg:order-1">
   155                     <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center
       justify-center mb-6">
   156                         <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2
       0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
   157                     </div>
   158                     <h4 class="text-2xl font-bold mb-4">Tracking Order 5 Tahap</h4>
   159                     <p class="text-slate-500 leading-relaxed">Kelola alur kerja dengan jelas dari
       pesanan Masuk → Konfirmasi → Produksi → Siap Kirim → Selesai. Gak ada lagi pesanan yang nyangkut di
       dapur.</p>
   160                 </div>
   161                 <div class="order-1 lg:order-2 bg-blue-50 rounded-[3rem] p-10 h-full flex items-center       shadow-inner">
   162                     <div class="w-full h-48 bg-white/50 rounded-2xl border-4 border-dashed
       border-blue-200 flex items-center justify-center text-blue-500 font-bold uppercase tracking-widest
       text-xs italic">Visual Tahap Produksi</div>
   163                 </div>
   164             </div>
   165
   166             <div class="grid md:grid-cols-3 gap-8 reveal">
   167                 <div class="p-10 bg-slate-50 rounded-[2.5rem] hover:bg-indigo-50 transition-all border       border-slate-100 group">
   168                     <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex
       items-center justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-colors">
   169                         <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031
       6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58
       1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392
       8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751       -2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.21       7l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534
       1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.4       49.741.964 1.201.662.591 1.221.774
       1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477
       1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12
       12 12-5.373 12-12-5.373-12-12-12zm.082 21.083c-1.503 0-2.973-.404-4.254-1.168l-4.73 1.242
       1.265-4.613c-.838-1.32-1.28-2.855-1.28-4.446 0-4.613 3.753-8.366 8.366-8.366 4.613 0 8.366 3.753 8.366       8.366 0 4.613-3.753 8.366-8.366 8.366z"/></svg>
   170                     </div>
   171                     <h4 class="text-xl font-bold mb-4">Invoice WhatsApp</h4>
   172                     <p class="text-slate-500 text-sm leading-relaxed italic">"Sekali klik, invoice
       rapi terkirim otomatis ke WA pembeli."</p>
   173                 </div>
   174                 <div class="p-10 bg-slate-50 rounded-[2.5rem] hover:bg-indigo-50 transition-all border       border-slate-100 group">
   175                     <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center
       justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-colors">
   176                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2.5"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0
       2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16v1m-10-6h18"/></svg>
   177                     </div>
   178                     <h4 class="text-xl font-bold mb-4">Kalkulator HPP</h4>
   179                     <p class="text-slate-500 text-sm leading-relaxed">Hitung modal bahan baku per
       porsi secara akurat. Tentukan harga jual ideal untuk margin profit maksimal.</p>
   180                 </div>
   181                 <div class="p-10 bg-slate-50 rounded-[2.5rem] hover:bg-indigo-50 transition-all border       border-slate-100 group">
   182                     <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center
       justify-center mb-8 group-hover:bg-primary group-hover:text-white transition-colors">
   183                         <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
       stroke-width="2.5"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0
       01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
   184                     </div>
   185                     <h4 class="text-xl font-bold mb-4">Laporan Excel</h4>
   186                     <p class="text-slate-500 text-sm leading-relaxed">Export riwayat pesanan ke file
       Excel untuk pembukuan atau tim packing dengan satu kali tap saja.</p>
   187                 </div>
   188             </div>
   189         </div>
   190     </section>
   191
   192     <!-- HOW IT WORKS -->
   193     <section class="py-32 bg-slate-900 text-white">
   194         <div class="max-w-7xl mx-auto px-6 text-center">
   195             <h2 class="text-3xl md:text-5xl font-bold mb-16 tracking-tight">Mulai dalam 3 Langkah
       Mudah</h2>
   196             <div class="grid md:grid-cols-3 gap-16 relative">
   197                 <div class="reveal">
   198                     <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center
       mx-auto mb-8 text-3xl font-black shadow-[0_0_40px_rgba(108,99,255,0.4)]">1</div>
   199                     <h4 class="text-xl font-bold mb-4 uppercase tracking-tight">Daftar & Setup
       Toko</h4>
   200                     <p class="text-slate-400 text-sm leading-relaxed">Masukkan nama toko, data menu,
       dan harga jual Anda dalam 2 menit.</p>
   201                 </div>
   202                 <div class="reveal">
   203                     <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center
       mx-auto mb-8 text-3xl font-black shadow-[0_0_40px_rgba(108,99,255,0.4)]">2</div>
   204                     <h4 class="text-xl font-bold mb-4 uppercase tracking-tight">Tambah & Kelola
       Order</h4>
   205                     <p class="text-slate-400 text-sm leading-relaxed">Input pesanan dari WA, pantau
       proses produksi, dan kirim invoice profesional.</p>
   206                 </div>
   207                 <div class="reveal">
   208                     <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center
       mx-auto mb-8 text-3xl font-black shadow-[0_0_40px_rgba(108,99,255,0.4)]">3</div>
   209                     <h4 class="text-xl font-bold mb-4 uppercase tracking-tight">Pantau & Evaluasi</h4>   210                     <p class="text-slate-400 text-sm leading-relaxed">Lihat laporan otomatis, analisa
       margin, dan kembangkan bisnis dengan data akurat.</p>
   211                 </div>
   212             </div>
   213         </div>
   214     </section>
   215
   216     <!-- TESTIMONI -->
   217     <section class="py-32 px-6 bg-slate-50">
   218         <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-8">
   219             <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm reveal">
   220                 <div class="flex text-amber-400 mb-6 tracking-widest text-xs font-black
       italic">⭐⭐⭐⭐⭐</div>
   221                 <p class="text-slate-600 text-sm italic leading-relaxed mb-8">"Dulu tiap malem
       begadang cuma buat rekap WA ke buku. Sekarang pakai OrderIn rekap jadi otomatis dan gak pernah salah
       kirim lagi!"</p>
   222                 <div class="flex items-center gap-4">
   223                     <div class="w-12 h-12 bg-slate-100 rounded-full"></div>
   224                     <div>
   225                         <p class="text-sm font-bold">Amanda Putri</p>
   226                         <p class="text-[10px] text-slate-400 font-bold uppercase
       tracking-widest">Owner Catering Depok</p>
   227                     </div>
   228                 </div>
   229             </div>
   230             <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm reveal">
   231                 <div class="flex text-amber-400 mb-6 tracking-widest text-xs font-black
       italic">⭐⭐⭐⭐⭐</div>
   232                 <p class="text-slate-600 text-sm italic leading-relaxed mb-8">"Fitur HPP-nya juara!
       Akhirnya saya tau mana menu yang beneran ngasih untung gede dan mana yang cuma capek doang."</p>
   233                 <div class="flex items-center gap-4">
   234                     <div class="w-12 h-12 bg-slate-100 rounded-full"></div>
   235                     <div>
   236                         <p class="text-sm font-bold">Budi Santoso</p>
   237                         <p class="text-[10px] text-slate-400 font-bold uppercase
       tracking-widest">Wirausaha Nasi Box</p>
   238                     </div>
   239                 </div>
   240             </div>
   241             <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm reveal">
   242                 <div class="flex text-amber-400 mb-6 tracking-widest text-xs font-black
       italic">⭐⭐⭐⭐⭐</div>
   243                 <p class="text-slate-600 text-sm italic leading-relaxed mb-8">"Kirim invoice lewat WA
       bikin pelanggan ngerasa usaha saya profesional banget. Padahal inputnya cuma pake HP!"</p>
   244                 <div class="flex items-center gap-4">
   245                     <div class="w-12 h-12 bg-slate-100 rounded-full"></div>
   246                     <div>
   247                         <p class="text-sm font-bold">Sari Dewi</p>
   248                         <p class="text-[10px] text-slate-400 font-bold uppercase
       tracking-widest">Owner Aqiqah Ceria</p>
   249                     </div>
   250                 </div>
   251             </div>
   252         </div>
   253     </section>
   254
   255     <!-- PRICING SECTION -->
   256     <section id="harga" class="py-32 px-6">
   257         <div class="max-w-4xl mx-auto text-center mb-16">
   258             <h2 class="text-3xl md:text-5xl font-bold mb-6 tracking-tight tracking-tight
       tracking-tight">Investasi Sekali, Cuan Selamanya.</h2>
   259             <p class="text-slate-500 font-medium">Bantu operasional tim admin Anda naik level hari
       ini.</p>
   260         </div>
   261
   262         <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-8 items-center">
   263             <!-- Free Plan -->
   264             <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 reveal">
   265                 <h4 class="text-xl font-bold mb-2">Basic Plan</h4>
   266                 <p class="text-slate-500 text-sm mb-6">Cocok untuk pemula</p>
   267                 <div class="flex items-baseline gap-2 mb-8">
   268                     <span class="text-4xl font-extrabold text-slate-900">Gratis</span>
   269                 </div>
   270                 <ul class="space-y-4 text-left text-sm text-slate-600 mb-10">
   271                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-emerald-500"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Maksimal 10 Pesanan /
       Bulan</li>
   272                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-emerald-500"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Dashboard Standar</li>
   273                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-emerald-500"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Tracking Order Dasar</li>
   274                 </ul>
   275                 <a href="{{ route('register') }}" class="block w-full py-4 bg-slate-50 text-slate-800
       font-bold rounded-2xl hover:bg-slate-100 transition-all text-center">Daftar Sekarang</a>
   276             </div>
   277
   278             <!-- Pro Plan -->
   279             <div class="bg-white p-10 rounded-[3rem] border-4 border-primary shadow-2xl relative
       reveal overflow-hidden">
   280                 <div class="absolute top-0 right-0 px-6 py-2 bg-primary text-white text-[10px]
       font-black uppercase tracking-widest rounded-bl-3xl">Paling Populer</div>
   281                 <h4 class="text-xl font-bold mb-2">Early Bird Plan</h4>
   282                 <p class="text-slate-500 text-sm mb-6">Akses Penuh Tanpa Batas</p>
   283                 <div class="flex flex-col items-start mb-8">
   284                     <span class="text-slate-300 text-sm font-bold line-through">Rp 499.000</span>
   285                     <div class="flex items-baseline gap-2">
   286                         <span class="text-5xl font-black text-slate-900 leading-none">99rb</span>
   287                         <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">/
       Selamanya</span>
   288                     </div>
   289                 </div>
   290                 <ul class="space-y-4 text-left text-sm text-slate-600 mb-10">
   291                     <li class="flex items-center gap-3 font-bold"><svg class="w-5 h-5 text-primary"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Pesanan Tanpa Batas</li>
   292                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-primary"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Kalkulator HPP Otomatis</li>   293                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-primary"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Invoice WA 1-Klik</li>
   294                     <li class="flex items-center gap-3"><svg class="w-5 h-5 text-primary"
       fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414
       0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg> Export Laporan Excel</li>
   295                 </ul>
   296                 <a href="{{ route('register') }}" class="block w-full py-5 bg-primary text-white
       font-bold rounded-2xl hover:bg-violet-700 transition-all text-center shadow-xl
       shadow-indigo-200">Dapatkan Akses Lifetime</a>
   297             </div>
   298         </div>
   299     </section>
   300
   301     <!-- FAQ -->
   302     <section class="py-24 px-6 bg-slate-50">
   303         <div class="max-w-3xl mx-auto" x-data="{ active: null }">
   304             <h2 class="text-3xl font-extrabold text-center mb-16 tracking-tight tracking-tight
       tracking-tight">Pertanyaan Umum (FAQ)</h2>
   305             <div class="space-y-4">
   306                 <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
   307                     <button @click="active = (active === 1 ? null : 1)" class="w-full p-6 text-left
       flex justify-between items-center">
   308                         <span class="font-bold text-sm">Apakah bisa digunakan di HP?</span>
   309                         <svg class="w-5 h-5 transition-transform" :class="active === 1 ? 'rotate-180'
       : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
   310                     </button>
   311                     <div x-show="active === 1" class="px-6 pb-6 text-slate-500 text-sm
       leading-relaxed">
   312                         Tentu! OrderIn adalah aplikasi berbasis web yang sangat responsif, sehingga
       nyaman digunakan baik di Laptop maupun Smartphone (Android/iOS).
   313                     </div>
   314                 </div>
   315                 <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
   316                     <button @click="active = (active === 2 ? null : 2)" class="w-full p-6 text-left
       flex justify-between items-center">
   317                         <span class="font-bold text-sm">Apakah data saya aman?</span>
   318                         <svg class="w-5 h-5 transition-transform" :class="active === 2 ? 'rotate-180'
       : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
   319                     </button>
   320                     <div x-show="active === 2" class="px-6 pb-6 text-slate-500 text-sm
       leading-relaxed">
   321                         Sangat aman. Kami menggunakan enkripsi standar industri dan server kami
       dipantau 24/7 untuk memastikan data bisnis Anda tetap rahasia dan terlindungi.
   322                     </div>
   323                 </div>
   324                 <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
   325                     <button @click="active = (active === 3 ? null : 3)" class="w-full p-6 text-left
       flex justify-between items-center">
   326                         <span class="font-bold text-sm">Bagaimana cara kirim invoice ke WA?</span>
   327                         <svg class="w-5 h-5 transition-transform" :class="active === 3 ? 'rotate-180'
       : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
   328                     </button>
   329                     <div x-show="active === 3" class="px-6 pb-6 text-slate-500 text-sm
       leading-relaxed">
   330                         Setelah Anda memasukkan data pesanan, cukup klik tombol "Kirim Invoice".
       Aplikasi akan otomatis membuka WhatsApp dengan rincian pesanan yang sudah terformat rapi.
   331                     </div>
   332                 </div>
   333                 <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
   334                     <button @click="active = (active === 4 ? null : 4)" class="w-full p-6 text-left
       flex justify-between items-center">
   335                         <span class="font-bold text-sm">Apa itu Paket Lifetime?</span>
   336                         <svg class="w-5 h-5 transition-transform" :class="active === 4 ? 'rotate-180'
       : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
   337                     </button>
   338                     <div x-show="active === 4" class="px-6 pb-6 text-slate-500 text-sm
       leading-relaxed">
   339                         Ini adalah promo terbatas dimana Anda hanya perlu membayar satu kali (Rp
       99.000) untuk akses semua fitur selamanya tanpa biaya langganan bulanan di masa depan.
   340                     </div>
   341                 </div>
   342                 <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
   343                     <button @click="active = (active === 5 ? null : 5)" class="w-full p-6 text-left
       flex justify-between items-center">
   344                         <span class="font-bold text-sm">Ada batasan jumlah produk?</span>
   345                         <svg class="w-5 h-5 transition-transform" :class="active === 5 ? 'rotate-180'
       : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7"/></svg>
   346                     </button>
   347                     <div x-show="active === 5" class="px-6 pb-6 text-slate-500 text-sm
       leading-relaxed">
   348                         Sama sekali tidak ada batasan. Anda bisa menambahkan ribuan menu katering atau       varian nasi box Anda ke dalam katalog menu.
   349                     </div>
   350                 </div>
   351             </div>
   352         </div>
   353     </section>
   354
   355     <!-- FINAL CTA -->
   356     <section class="py-24 px-6 bg-primary text-white overflow-hidden relative">
   357         <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
   358         <div class="max-w-4xl mx-auto text-center relative z-10 reveal">
   359             <h2 class="text-3xl md:text-5xl font-extrabold mb-8 tracking-tighter uppercase
       italic">Siap Kelola Pre-Order <br> Lebih Profesional?</h2>
   360             <p class="text-indigo-100 mb-12 text-lg">Bergabunglah dengan ratusan pengusaha katering
       lain yang sudah merdeka dari rekap manual.</p>
   361             <a href="{{ route('register') }}" class="inline-block bg-white text-primary font-black
       px-12 py-5 rounded-2xl hover:scale-105 transition-all text-xl shadow-2xl">
   362                 DAFTAR GRATIS SEKARANG
   363             </a>
   364         </div>
   365     </section>
   366
   367     <!-- FOOTER -->
   368     <footer class="py-20 px-6 border-t border-slate-100">
   369         <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12">
   370             <div class="md:col-span-2">
   371                 <div class="flex items-center gap-2 mb-6">
   372                     <span class="text-2xl font-extrabold text-primary tracking-tight
       italic">OrderIn.</span>
   373                     <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1
       italic">By CuanPilot</span>
   374                 </div>
   375                 <p class="max-w-xs text-sm text-slate-500 leading-relaxed font-medium
       tracking-tight">Sistem manajemen PO terpadu untuk membantu UMKM Indonesia naik kelas melalui
       digitalisasi operasional.</p>
   376             </div>
   377             <div>
   378                 <h5 class="font-bold text-slate-900 mb-6 uppercase tracking-widest
       text-[10px]">Tautan</h5>
   379                 <ul class="space-y-4 text-sm text-slate-500 font-medium">
   380                     <li><a href="#fitur" class="hover:text-primary">Fitur</a></li>
   381                     <li><a href="#harga" class="hover:text-primary">Harga</a></li>
   382                     <li><a href="https://wa.me/628123456789" class="hover:text-primary">Kontak
       CS</a></li>
   383                 </ul>
   384             </div>
   385             <div>
   386                 <h5 class="font-bold text-slate-900 mb-6 uppercase tracking-widest
       text-[10px]">Legal</h5>
   387                 <ul class="space-y-4 text-sm text-slate-500 font-medium">
   388                     <li><a href="#" class="hover:text-primary">Kebijakan Privasi</a></li>
   389                     <li><a href="#" class="hover:text-primary">Syarat & Ketentuan</a></li>
   390                 </ul>
   391             </div>
   392         </div>
   393         <div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-slate-50 flex flex-col md:flex-row
       justify-between items-center gap-4 text-[11px] text-slate-400 font-bold uppercase tracking-widest">
   394             <p>&copy; 2025 OrderIn By CuanPilot. Seluruh Hak Cipta Dilindungi.</p>
   395             <p>Dibuat dengan ❤️ di Indonesia</p>
   396         </div>
   397     </footer>
   398
   399     <!-- ANIMATION SCRIPT -->
   400     <script>
   401         window.addEventListener('scroll', () => {
   402             const reveals = document.querySelectorAll('.reveal');
   403             reveals.forEach(el => {
   404                 const windowHeight = window.innerHeight;
   405                 const elementTop = el.getBoundingClientRect().top;
   406                 const elementVisible = 150;
   407                 if (elementTop < windowHeight - elementVisible) {
   408                     el.classList.add('active');
   409                 }
   410             });
   411         });
   412         // Trigger scroll once to show top elements
   413         window.dispatchEvent(new Event('scroll'));
   414     </script>
   415
   416 </body>
   417 </html>
