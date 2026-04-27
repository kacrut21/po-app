<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#6C3DE3">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="OrderIn">
    <title>OrderIn — PO Management App</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="apple-touch-icon" href="/icon-192.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.__appConfig = {
            storeName: @json(Auth::check() ? (Auth::user()->store_name ?: Auth::user()->name) : 'Nama Toko'),
            invoiceTemplate: @json(Auth::check() ? (Auth::user()->invoice_template ?: '*{store_name}*\n\nHalo Kak *{customer_name}*,\n\nBerikut detail pesanan Anda:\n\n*Nomor PO:* {po_number}\n*Acara:* {event}\n*Jadwal Kirim:* {delivery_date}\n*Alamat:* {address}\n\n*Detail Pesanan:*\n{items}\n\n*Ongkos Kirim:* Rp {shipping_fee}\n*Total Biaya:* Rp {total}\n*DP Dibayar:* Rp {dp}\n*Sisa Tagihan:* Rp {remaining}\n*Metode Bayar:* {payment_method}\n\nTerima kasih telah memesan! 🙏') : '')
        };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/@hotwired/turbo@8.0.4/+esm"></script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f5f5f8; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }
        
        /* Gradient card */
        .gradient-violet {
            background: linear-gradient(135deg, #6C3DE3 0%, #8B5CF6 50%, #A855F7 100%);
        }
        /* Safe area for iOS */
        .pb-safe { padding-bottom: max(1rem, env(safe-area-inset-bottom)); }
    </style>
</head>
<body class="antialiased text-gray-800" x-data="poApp()">

<div class="flex min-h-screen">
    <!-- ─── DESKTOP SIDEBAR (md+) ─── -->
    <aside class="hidden md:flex flex-col w-60 bg-white border-r border-gray-100 min-h-screen sticky top-0 z-20 shadow-sm">
        <div class="px-5 pt-6 pb-4">
            <h1 class="text-xl font-extrabold text-gray-900">Order<span class="text-violet-600">In</span></h1>
            <p class="text-[11px] text-gray-400 mt-0.5">Kelola Pre-Order dengan mudah</p>
        </div>

        <nav class="flex-1 px-3 space-y-0.5 mt-2">
            @php
                $navItems = [
                    ['route' => 'dashboard',     'label' => 'Dashboard',    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'pesanan',       'label' => 'Daftar Order', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                    ['route' => 'menu',          'label' => 'Katalog & HPP','icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                    ['route' => 'laporan',       'label' => 'Laporan',      'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['route' => 'profile.show',  'label' => 'Pengaturan',   'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
            @endphp
            @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm transition-all duration-150
                      {{ request()->routeIs($item['route']) ? 'bg-violet-50 text-violet-700 font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800 font-medium' }}">
                <svg class="h-4 w-4 shrink-0 {{ request()->routeIs($item['route']) ? 'text-violet-600' : 'text-gray-400' }}"
                     fill="{{ request()->routeIs($item['route']) ? 'currentColor' : 'none' }}"
                     viewBox="0 0 24 24" stroke="currentColor"
                     stroke-width="{{ request()->routeIs($item['route']) ? '0' : '2' }}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
                @if($item['route'] === 'pesanan')
                    <span class="ml-auto text-[10px] font-bold bg-violet-100 text-violet-600 px-1.5 py-0.5 rounded-full"
                          x-text="poData.filter(p=>p.status!=='selesai').length"></span>
                @endif
            </a>
            @endforeach
        </nav>

        <div class="p-3 border-t border-gray-100">
            <a href="{{ route('form-po') }}"
                class="w-full py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-sm font-semibold rounded-xl transition-colors flex items-center justify-center gap-2 mb-2">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                Tambah Order
            </a>
            <div class="flex items-center justify-between px-2 py-2 bg-gray-50 rounded-xl">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-violet-100 flex items-center justify-center text-violet-700 text-xs font-bold uppercase">
                        {{ substr(Auth::user()->name ?? 'U', 0, 2) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-gray-800 truncate">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-[10px] text-gray-400 truncate">{{ Auth::user()->email ?? 'Owner' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar?');">
                    @csrf
                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ─── MAIN AREA ─── -->
    <div class="flex-1 flex flex-col min-h-screen max-w-lg mx-auto md:max-w-none w-full">

        <!-- Mobile Header -->
        <div class="md:hidden">
            @yield('mobile_header')
        </div>

        <!-- Desktop Topbar -->
        <header class="hidden md:flex items-center justify-between h-14 px-6 bg-white border-b border-gray-100 sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <h2 class="text-sm font-bold text-gray-800">
                    @if(request()->routeIs('dashboard'))    Dashboard
                    @elseif(request()->routeIs('pesanan'))  Daftar Order
                    @elseif(request()->routeIs('hpp'))      Kalkulator HPP
                    @elseif(request()->routeIs('laporan'))  Laporan
                    @elseif(request()->routeIs('menu'))     Katalog Menu
                    @elseif(request()->routeIs('profile.show') || request()->routeIs('profil')) Pengaturan
                    @elseif(request()->routeIs('form-po'))  Tambah Order
                    @elseif(request()->routeIs('form-po.edit')) Edit Order
                    @endif
                </h2>
                @yield('desktop_header_filters')
            </div>
            <div class="flex items-center gap-2">
                @yield('desktop_header_extra')
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto pb-24 md:pb-6">
            @yield('content')
        </main>

        <!-- Mobile Bottom Nav -->
        @if(!request()->routeIs('form-po*'))
        <div class="md:hidden">
            @include('components.nav')
        </div>
        @endif
    </div>
</div>

<!-- Modals -->
@include('components.detail-po-modal')

<!-- Toast -->
<div class="fixed top-4 right-4 z-[200] flex flex-col gap-2 pointer-events-none">
    <template x-for="n in notifications" :key="n.id">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="translate-x-full opacity-0"
             class="pointer-events-auto bg-white border-l-4 px-4 py-3 rounded-xl shadow-xl flex items-center gap-2.5 min-w-[260px]"
             :class="n.type==='success'?'border-emerald-500':'border-red-500'">
            <div :class="n.type==='success'?'text-emerald-500':'text-red-500'">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-xs font-semibold text-gray-800" x-text="n.message"></p>
        </div>
    </template>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('poApp', () => ({
        showDetailModal: false,
        activePo: null,
        notifications: [],

        notify(message, type='success') {
            const id = Date.now();
            this.notifications.push({ id, message, type });
            setTimeout(() => { this.notifications = this.notifications.filter(n => n.id !== id); }, 3000);
        },

        format(n) { return new Intl.NumberFormat('id-ID').format(n || 0); },

        mask(e, obj, prop) {
            let val = e.target.value.replace(/\D/g,'');
            let num = parseInt(val) || 0;
            obj[prop] = num;
            e.target.value = this.format(num);
        },

        isEditing: false,
        formPo: {
            id: null, name:'', wa:'', event:'Aqiqah', address:'',
            items:[{menu:'', qty:100, price:0, addons:[]}],
            date:'', time:'', note:'', dp:0, ongkir:0, payMethod:'Transfer'
        },

        poData: [],
        menus: [],
        masterAddons: [],

        init() {
            // Prefer server-side data if injected (from PHP controller via Blade)
            if (window.__poData) {
                this.poData = window.__poData;
            } else {
                const savedPo = localStorage.getItem('poData');
                this.poData = savedPo ? JSON.parse(savedPo) : [];
            }

            if (window.__menus) {
                this.menus = window.__menus;
            } else {
                const savedMenus = localStorage.getItem('menus');
                this.menus = savedMenus ? JSON.parse(savedMenus) : [];
            }

            if (window.__addons) {
                this.masterAddons = window.__addons;
            }

            // Pre-fill form for edit mode if data is injected
            if (window.__editOrder) {
                this.$nextTick(() => {
                    this.isEditing = true;
                    this.formPo = window.__editOrder;
                });
            }
        },

        saveData() {
            localStorage.setItem('poData',  JSON.stringify(this.poData));
            localStorage.setItem('menus', JSON.stringify(this.menus));
        },

        calculateTotal(po) {
            if (!po || !po.items) return 0;
            const itemsTotal = po.items.reduce((s, i) => {
                const itemBase = (parseInt(i.qty)||0) * (parseInt(i.price)||0);
                const addonsTotal = (i.addons || []).reduce((sum, a) => sum + ((parseInt(i.qty)||0) * (parseInt(a.price)||0)), 0);
                return s + itemBase + addonsTotal;
            }, 0);
            return itemsTotal + (parseInt(po.ongkir) || 0);
        },

        updateItemPrice(index) {
            const m = this.menus.find(m => m.name === this.formPo.items[index].menu);
            if (m) {
                this.formPo.items[index].price = m.price;
                this.formPo.items[index].addons = []; // Reset addons when menu changes
            }
        },

        toggleAddon(itemIndex, addon) {
            const item = this.formPo.items[itemIndex];
            if (!item.addons) item.addons = [];
            
            const existingIdx = item.addons.findIndex(a => a.name === addon.name);
            if (existingIdx !== -1) {
                item.addons.splice(existingIdx, 1);
            } else {
                item.addons.push({
                    id: addon.id,
                    name: addon.name,
                    price: addon.price
                });
            }
        },

        generatePoNumber() {
            const d = new Date();
            const dd = String(d.getDate()).padStart(2,'0');
            const mm = String(d.getMonth()+1).padStart(2,'0');
            const yy = String(d.getFullYear()).slice(2);
            const seq = String(this.poData.length + 1).padStart(4,'0');
            return `PO-${yy}${mm}${dd}-${seq}`;
        },

        savePo() {
            if(!this.formPo.name) {
                this.notify('Nama Pemesan wajib diisi!', 'error');
                return;
            }
            if (this.isEditing) {
                // Update existing
                const idx = this.poData.findIndex(p => p.id === this.formPo.id);
                if (idx !== -1) {
                    this.poData[idx] = { ...this.poData[idx], ...this.formPo };
                    if (this.activePo?.id === this.formPo.id) {
                        this.activePo = { ...this.activePo, ...this.formPo };
                    }
                }
                this.notify('Pesanan berhasil diperbarui! ✨');
            } else {
                // Create new
                const newPo = {
                    ...this.formPo,
                    id: Date.now(),
                    poNumber: this.generatePoNumber(),
                    status: 'masuk',
                    statusIdx: 0,
                    created_at: new Date().toISOString()
                };
                this.poData.unshift(newPo);
                this.notify('Pesanan berhasil ditambahkan! ✨');
            }
            
            this.saveData();
            setTimeout(() => {
                window.location.href = '/pesanan';
            }, 500);
        },

        resetForm() {
            this.isEditing = false;
            this.formPo = {
                id: null, name:'', wa:'', event:'Aqiqah', address:'',
                items:[{menu: this.menus.length ? this.menus[0].name : '', qty:100, price: this.menus.length ? this.menus[0].price : 0, addons: []}],
                date:'', time:'', note:'', dp:0, ongkir:0, payMethod:'Transfer'
            };
        },

        editPo(po) {
            window.location.href = `/form-po/${po.id}/edit`;
        },

        sendWAInvoice(po) {
            let rawPhone = (po.wa || po.customer_phone || '').replace(/\D/g, '');
            let phone = rawPhone.startsWith('0') ? '62' + rawPhone.substring(1)
                       : rawPhone.startsWith('62') ? rawPhone
                       : '62' + rawPhone;

            let itemsText = (po.items || []).map(i => {
                let text = `- ${i.qty}x ${i.menu} (@Rp ${this.format(i.price || 0)})`;
                if (i.addons && i.addons.length > 0) {
                    i.addons.forEach(a => {
                        text += `\n  + ${a.name} (@Rp ${this.format(a.price || 0)})`;
                    });
                }
                return text;
            }).join('\n');
            let total = po.total || this.calculateTotal(po);
            let ongkir = po.ongkir || po.shipping_fee || 0;
            let dp = po.dp || 0;
            let sisa = total - dp;

            // Format date nicely
            let tglKirim = '-';
            if (po.date) {
                try {
                    let d = new Date(po.date);
                    tglKirim = d.toLocaleDateString('id-ID', {weekday:'long', day:'numeric', month:'long', year:'numeric', hour:'2-digit', minute:'2-digit'});
                } catch(e) { tglKirim = po.date; }
            }

            let alamat = po.address || po.delivery_address || '-';
            let metodeBayar = po.payMethod || po.payment_method || '-';

            let storeName = window.__appConfig?.storeName || 'Toko Kami';
            let template = window.__appConfig?.invoiceTemplate || "*{store_name}*\n\nHalo Kak *{customer_name}*,\n\nBerikut detail pesanan Anda:\n\n*Nomor PO:* {po_number}\n*Acara:* {event}\n*Jadwal Kirim:* {delivery_date}\n*Alamat:* {address}\n\n*Detail Pesanan:*\n{items}\n\n*Ongkos Kirim:* Rp {shipping_fee}\n*Total Biaya:* Rp {total}\n*DP Dibayar:* Rp {dp}\n*Sisa Tagihan:* Rp {remaining}\n*Metode Bayar:* {payment_method}\n\nTerima kasih telah memesan! 🙏";

            let message = template
                .replace(/{store_name}/g, storeName)
                .replace(/{customer_name}/g, po.name || '-')
                .replace(/{po_number}/g, po.poNumber || '-')
                .replace(/{event}/g, po.event || '-')
                .replace(/{delivery_date}/g, tglKirim)
                .replace(/{address}/g, alamat)
                .replace(/{items}/g, itemsText)
                .replace(/{shipping_fee}/g, this.format(ongkir))
                .replace(/{total}/g, this.format(total))
                .replace(/{dp}/g, this.format(dp))
                .replace(/{remaining}/g, this.format(sisa))
                .replace(/{payment_method}/g, metodeBayar);

            window.open('https://wa.me/' + phone + '?text=' + encodeURIComponent(message), '_blank');
        },

        updateStatus(poId, newStatus) {
            const idx = {masuk:0, konfirmasi:1, produksi:2, siap:3, selesai:4};
            const po = this.poData.find(p => p.id === poId);
            if (po) {
                // Optimistic UI update
                po.status = newStatus;
                po.statusIdx = idx[newStatus];
                if (this.activePo?.id === poId) {
                    this.activePo.status = newStatus;
                    this.activePo.statusIdx = idx[newStatus];
                }
                this.poData = [...this.poData];

                // Send to backend
                fetch(`/pesanan/${poId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: JSON.stringify({ status: newStatus })
                }).then(r => r.json()).then(data => {
                    if (data.success) {
                        this.notify(`Status diperbarui: ${newStatus.toUpperCase()} 🚀`);
                    }
                }).catch(() => {
                    this.notify('Gagal memperbarui status', 'error');
                });
            }
        },

        confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
                fetch(`/pesanan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }).then(r => r.json()).then(data => {
                    if (data.success) {
                        this.poData = this.poData.filter(p => p.id !== id);
                        this.showDetailModal = false;
                        this.notify('Pesanan berhasil dihapus! 🗑️');
                    }
                }).catch(() => {
                    this.notify('Gagal menghapus pesanan', 'error');
                });
            }
        },

        updatePayment(po) {
            const total = po.total || this.calculateTotal(po);
            const sisa = total - (po.dp || 0);
            
            const amount = prompt(`Masukkan jumlah pembayaran pelunasan (Sisa: Rp ${this.format(sisa)}):`, sisa);
            
            if (amount && !isNaN(amount)) {
                fetch(`/pesanan/${po.id}/pembayaran`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ amount: parseInt(amount) })
                }).then(r => r.json()).then(data => {
                    if (data.success) {
                        // Update local data
                        const target = this.poData.find(p => p.id === po.id);
                        if (target) {
                            target.dp = data.order.down_payment;
                            if (this.activePo?.id === po.id) {
                                this.activePo.dp = target.dp;
                            }
                        }
                        this.poData = [...this.poData]; // Force reactivity
                        this.notify('Pembayaran berhasil diperbarui! 💰');
                    }
                }).catch(() => {
                    this.notify('Gagal memperbarui pembayaran', 'error');
                });
            }
        },

        dpPercent(po) {
            const total = this.calculateTotal(po);
            if (!total) return 0;
            return Math.min(100, Math.round(((po.dp || 0) / total) * 100));
        },

        getInitials(name) {
            if (!name) return '?';
            return name.split(' ').slice(0,2).map(w=>w[0]).join('').toUpperCase();
        },

        avatarColor(name) {
            const colors = ['bg-violet-100 text-violet-700','bg-blue-100 text-blue-700','bg-emerald-100 text-emerald-700','bg-amber-100 text-amber-700','bg-rose-100 text-rose-700','bg-indigo-100 text-indigo-700'];
            let hash = 0;
            for (let i=0; i<(name||'').length; i++) hash += name.charCodeAt(i);
            return colors[hash % colors.length];
        }
    }));
});
</script>

<!-- ── PWA: Service Worker Registration ──────────────────────────────── -->
<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then((reg) => {
                console.log('[OrderIn] SW registered:', reg.scope);

                // Cek apakah ada update SW baru
                reg.addEventListener('updatefound', () => {
                    const newSW = reg.installing;
                    newSW.addEventListener('statechange', () => {
                        if (newSW.state === 'installed' && navigator.serviceWorker.controller) {
                            console.log('[OrderIn] Update tersedia, refresh untuk mendapatkan versi terbaru.');
                        }
                    });
                });
            })
            .catch((err) => console.error('[OrderIn] SW failed:', err));
    });
}

// PWA Install Prompt — simpan untuk digunakan nanti
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;

    // Tampilkan tombol install custom jika ada elemennya
    const btn = document.getElementById('pwa-install-btn');
    if (btn) btn.classList.remove('hidden');
});

// Setelah app di-install, sembunyikan tombol
window.addEventListener('appinstalled', () => {
    const btn = document.getElementById('pwa-install-btn');
    if (btn) btn.classList.add('hidden');
    deferredPrompt = null;
    console.log('[OrderIn] App berhasil diinstall!');
});

// Fungsi global untuk trigger install
window.installPWA = () => {
    if (!deferredPrompt) return;
    deferredPrompt.prompt();
    deferredPrompt.userChoice.then((choice) => {
        if (choice.outcome === 'accepted') {
            console.log('[OrderIn] User menerima install');
        }
        deferredPrompt = null;
    });
};

// ── Global Script: Form Submit Loading State ────────────────────────────────
document.addEventListener('submit', function(e) {
    if (e.target.tagName === 'FORM') {
        // Jangan intercept form logout
        if (e.target.action && e.target.action.includes('logout')) return;
        
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
