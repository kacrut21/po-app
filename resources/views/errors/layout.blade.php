<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - PO App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F5FF] min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full text-center">
        <!-- Icon Container -->
        <div class="w-24 h-24 bg-white rounded-3xl shadow-xl shadow-violet-100 flex items-center justify-center mx-auto mb-8 relative">
            <div class="absolute inset-0 bg-violet-500/5 rounded-3xl animate-ping"></div>
            @yield('icon')
        </div>

        <!-- Content -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-3 tracking-tight">
            @yield('code')
        </h1>
        <h2 class="text-xl font-bold text-gray-700 mb-4">
            @yield('message')
        </h2>
        <p class="text-gray-500 text-[14px] leading-relaxed mb-10 px-4">
            @yield('description')
        </p>

        <!-- Actions -->
        <div class="space-y-3">
            <a href="{{ url('/') }}" 
               class="block w-full py-4 bg-[#6C3DE3] hover:bg-violet-700 text-white font-bold rounded-2xl shadow-lg shadow-violet-200 active:scale-[0.98] transition-all">
                Kembali ke Dashboard
            </a>
            <button onclick="window.history.back()" 
                    class="block w-full py-4 bg-white text-gray-600 font-bold rounded-2xl hover:bg-gray-50 active:scale-[0.98] transition-all border border-gray-100">
                Halaman Sebelumnya
            </button>
        </div>

        <p class="mt-12 text-[11px] font-medium text-gray-400 uppercase tracking-widest">
            &copy; {{ date('Y') }} PO Management System
        </p>
    </div>
</body>
</html>
