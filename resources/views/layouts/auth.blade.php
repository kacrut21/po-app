<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="/LOGO 2.png">
    <title>@yield('title', 'PO-Management by CuanPilot — PO Management')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f5f5f8; }
    </style>
</head>
<body class="antialiased text-gray-800 min-h-screen flex">
    
    <!-- Left Section: Branding / Image -->
    <div class="hidden lg:flex lg:w-1/2 bg-violet-600 flex-col justify-between p-12 relative overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-violet-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-violet-700 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>

        <div class="relative z-10">
            <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center mb-6">
                <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h1 class="text-white text-4xl font-extrabold tracking-tight mb-4">PO-Management by CuanPilot.</h1>
            <p class="text-violet-200 text-lg font-medium max-w-sm leading-relaxed">
                Platform manajemen Pre-Order terbaik. Kelola pesanan, hitung HPP, dan pantau bisnis dari satu tempat.
            </p>
        </div>

        <div class="relative z-10">
            <p class="text-violet-300 text-sm font-semibold">&copy; {{ date('Y') }} PO-Management by CuanPilot. Dirancang untuk UMKM.</p>
        </div>
    </div>

    <!-- Right Section: Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16 bg-white">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex flex-col items-center mb-8">
                <div class="w-12 h-12 bg-violet-50 rounded-xl flex items-center justify-center mb-3">
                    <svg class="w-6 h-6 text-violet-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Order<span class="text-violet-600">In</span></h1>
            </div>

            @yield('content')
        </div>
    </div>

<!-- ── Global Script: Form Submit Loading State & Turbo ──────────────────────────────── -->
<script type="module" src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/+esm"></script>
<script>
document.addEventListener('submit', function(e) {
    if (e.target.tagName === 'FORM') {
        const btn = e.target.querySelector('button[type="submit"]');
        if (btn && e.target.checkValidity()) {
            if (!btn.dataset.originalText) {
                btn.dataset.originalText = btn.innerHTML;
            }
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
        }
    }
});

// Kembalikan state tombol jika Turbo selesai render halaman / gagal
document.addEventListener('turbo:render', resetButtons);
document.addEventListener('turbo:submit-end', resetButtons);

function resetButtons() {
    document.querySelectorAll('button[type="submit"]').forEach(btn => {
        if (btn.dataset.originalText) {
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-not-allowed');
            btn.innerHTML = btn.dataset.originalText;
            delete btn.dataset.originalText;
        }
    });
}
</script>
</body>
</html>
