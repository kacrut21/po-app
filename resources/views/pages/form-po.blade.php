@extends('layouts.app')

@section('mobile_header')
    <div class="bg-white px-5 pt-5 pb-4 shrink-0 border-b border-gray-100/50 sticky top-0 z-10 flex items-center gap-3">
        <a href="{{ route('pesanan') }}"
            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50 rounded-lg transition-colors">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div class="flex-1 text-center pr-8">
            <h2 class="text-[15px] font-bold text-gray-800" x-text="isEditing ? 'Edit Order' : 'Tambah Order Baru'"></h2>
        </div>
    </div>
@endsection

@section('content')
    {{-- Inject menus and edit order data --}}
    <form method="POST" action="{{ isset($order) ? route('form-po.update', $order->id) : route('form-po.store') }}"
        x-data="{
            localMenus: @js($menus->map(fn($m) => array_merge($m->toArray(), ['price' => $m->selling_price]))),
            localAddons: @js($addons),
            localEditOrder: @js(isset($order) ? [
                'id' => $order->id,
                'name' => $order->customer_name,
                'wa' => $order->customer_phone ?? '',
                'address' => $order->delivery_address ?? '',
                'event' => $order->event_type ?? 'Aqiqah',
                'date' => substr($order->delivery_date, 0, 10),
                'time' => substr($order->delivery_date, 11, 5),
                'note' => $order->notes ?? '',
                'ongkir' => $order->shipping_fee ?? 0,
                'dp' => $order->down_payment ?? 0,
                'payMethod' => $order->payment_method ?? 'Cash',
                'items' => $order->items->map(fn($i) => [
                    'menu' => $i->menu?->name ?? '',
                    'qty' => $i->quantity,
                    'price' => $i->price,
                    'addons' => $i->addons->map(fn($a) => [
                        'id' => $a->menu_addon_id,
                        'name' => $a->menuAddon?->name ?? 'Addon Terhapus',
                        'price' => $a->price
                    ])->values()
                ])
            ] : null)
        }"
        x-init="menus = localMenus; masterAddons = localAddons; if (localEditOrder) { isEditing = true; formPo = localEditOrder; } else { resetForm(); }"
        class="p-4 space-y-4 pb-24 md:pb-6"
        @submit="if(menus.length === 0 || formPo.items.length === 0) { $event.preventDefault(); alert('Mohon tambahkan setidaknya satu menu pesanan. Jika belum ada menu, silakan buat di Katalog Menu terlebih dahulu.'); return false; }">
        @csrf

        <!-- Informasi Customer -->
        <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <h3 class="text-[11px] font-extrabold text-gray-800 mb-4">Informasi Customer</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <label class="text-[12px] font-medium text-gray-500 w-1/3">Nama Lengkap</label>
                    <input type="text" x-model="formPo.name" name="customer_name" required
                        class="w-2/3 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                        placeholder="Nama Lengkap">
                </div>
                <div class="flex items-center justify-between">
                    <label class="text-[12px] font-medium text-gray-500 w-1/3">No. WhatsApp</label>
                    <input type="text" x-model="formPo.wa" name="customer_phone"
                        class="w-2/3 bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                        placeholder="0812-3456-7890">
                </div>
                <div class="flex items-center justify-between">
                    <label class="text-[12px] font-medium text-gray-500 w-1/3">Alamat Pengiriman</label>
                    <div class="w-2/3 relative">
                        <input type="text" x-model="formPo.address" name="delivery_address"
                            class="w-full bg-white border border-gray-200 rounded-lg pl-3 pr-8 py-2.5 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                            placeholder="Alamat...">
                        <svg class="h-4 w-4 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Order -->
        <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <h3 class="text-[11px] font-extrabold text-gray-800 mb-4">Detail Order</h3>

            <template x-if="menus.length === 0">
                <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl text-center mb-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="text-[13px] font-bold text-amber-700 mb-1">Katalog Menu Masih Kosong</p>
                    <p class="text-[11px] font-medium text-amber-600 mb-3">Silakan tambahkan menu di halaman Katalog
                        terlebih dahulu agar bisa membuat pesanan.</p>
                    <a href="{{ route('menu') }}"
                        class="inline-block px-5 py-2.5 bg-amber-600 text-white text-[11px] font-bold rounded-lg shadow-sm hover:bg-amber-600 active:scale-95 transition-all">Tambah
                        Menu Sekarang</a>
                </div>
            </template>

            <template x-if="menus.length > 0">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="text-[12px] font-medium text-gray-500 w-1/3">Jenis Acara</label>
                        <div class="w-2/3 relative">
                            <select x-model="formPo.event" name="event_type"
                                class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors appearance-none pr-8">
                                <template
                                    x-for="evt in ['Aqiqah','Pernikahan','Ulang Tahun','Rapat Kantor','Pengajian','Khitanan','Lainnya']"
                                    :key="evt">
                                    <option :value="evt" x-text="evt"></option>
                                </template>
                            </select>
                            <svg class="h-3.5 w-3.5 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <template x-for="(item, index) in formPo.items" :key="index">
                            <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 relative">
                                <!-- Hidden inputs for array data -->
                                <input type="hidden" :name="'items['+index+'][menu]'" :value="item.menu">
                                <input type="hidden" :name="'items['+index+'][qty]'" :value="item.qty">
                                <!-- Remove Item Button -->
                                <button type="button" x-show="formPo.items.length > 1"
                                    @click="formPo.items.splice(index, 1)"
                                    class="absolute -top-2 -right-2 w-6 h-6 bg-red-100 text-red-500 rounded-full flex items-center justify-center shadow-sm">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>

                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <label class="text-[12px] font-medium text-gray-500 w-1/3">Menu</label>
                                        <div class="w-2/3 relative">
                                            <select x-model="item.menu" @change="updateItemPrice(index)"
                                                class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors appearance-none pr-8">
                                                <option value="" disabled>Pilih Menu...</option>
                                                <template x-for="m in menus" :key="m.name">
                                                    <option :value="m.name" x-text="m.name" :selected="item.menu === m.name"></option>
                                                </template>
                                            </select>
                                            <svg class="h-3.5 w-3.5 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-[12px] font-medium text-gray-500 w-1/3">Porsi</label>
                                        <div class="w-2/3">
                                            <input type="number" x-model.number="item.qty" min="1"
                                                class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-[12px] font-bold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="text-[12px] font-medium text-gray-500 w-1/3">Harga Satuan</label>
                                        <div class="w-2/3 text-right">
                                            <span class="text-[13px] font-extrabold text-[#6C3DE3]"
                                                x-text="'Rp '+format(item.price)"></span>
                                        </div>
                                    </div>

                                    <!-- Add-on Section -->
                                    <div x-show="masterAddons && masterAddons.length > 0 && item.menu" class="mt-4 pt-3 border-t border-gray-100">
                                        <label class="block text-[10px] font-bold text-gray-400 mb-2 uppercase tracking-wider">Add-ons (Opsional)</label>
                                        <div class="flex flex-wrap gap-2">
                                            <template x-for="addon in masterAddons" :key="addon.id">
                                                <button type="button" @click="toggleAddon(index, addon)"
                                                    class="px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all border flex items-center gap-1.5"
                                                    :class="item.addons?.find(a => a.name === addon.name) 
                                                        ? 'bg-[#6C3DE3] text-white border-[#6C3DE3] shadow-md' 
                                                        : 'bg-white text-gray-500 border-gray-100 hover:border-violet-200 shadow-sm'">
                                                    <svg x-show="item.addons?.find(a => a.name === addon.name)" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span x-text="addon.name"></span>
                                                    <span class="opacity-70 font-medium" x-text="'+Rp' + format(addon.price)"></span>
                                                </button>
                                            </template>
                                        </div>
                                        <!-- Hidden inputs for addons -->
                                        <template x-for="(ad, adIdx) in (item.addons || [])" :key="adIdx">
                                            <input type="hidden" :name="'items['+index+'][addons]['+adIdx+'][id]'" :value="ad.id">
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button type="button"
                        @click="formPo.items.push({menu: '', qty:10, price: 0, addons: []})"
                        class="w-full py-2 border border-dashed border-[#6C3DE3] text-[#6C3DE3] rounded-xl text-[12px] font-bold bg-[#F8F5FF] hover:bg-violet-100 transition-colors flex items-center justify-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Menu Lain
                    </button>

                    <!-- Ongkos Kirim -->
                    <div class="flex items-center justify-between mt-4">
                        <label class="text-[12px] font-medium text-gray-500 w-1/3">Ongkos Kirim</label>
                        <div class="relative w-2/3">
                            <span
                                class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-gray-600 font-bold">Rp</span>
                            <input type="hidden" name="shipping_fee" :value="formPo.ongkir">
                            <input type="text" :value="formPo.ongkir ? format(formPo.ongkir) : ''"
                                @input="mask($event, formPo, 'ongkir')"
                                class="w-full bg-white border border-gray-200 rounded-lg pl-8 pr-3 py-2.5 text-[13px] font-bold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors text-right"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Total Order Highlight -->
                    <div
                        class="bg-[#F8F5FF] rounded-xl px-4 py-3 flex items-center justify-between mt-1 mb-1 shadow-sm border border-violet-100">
                        <span class="text-[12px] font-semibold text-[#6C3DE3]">Total Order</span>
                        <span class="text-[16px] font-extrabold text-[#6C3DE3]"
                            x-text="'Rp '+format(calculateTotal(formPo))"></span>
                    </div>

                    <div class="flex items-center justify-between gap-3 mt-3">
                        <label class="text-[12px] font-medium text-gray-500 w-1/3 leading-tight">Tanggal & Waktu
                            Kirim</label>
                        <div class="flex items-center gap-2 w-2/3">
                            <div class="relative flex-1">
                                <input type="date" x-model="formPo.date" name="delivery_date" required
                                    class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[11px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors appearance-none">
                            </div>
                            <div class="relative w-20">
                                <input type="time" x-model="formPo.time" name="delivery_time" required
                                    class="w-full bg-white border border-gray-200 rounded-lg px-2 py-2.5 text-[11px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors text-center appearance-none">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[12px] font-medium text-gray-500 mb-2">Catatan Tambahan</label>
                        <input type="text" x-model="formPo.note" name="notes"
                            class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2.5 text-[12px] font-medium text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                            placeholder="Catatan...">
                    </div>
                </div>
            </template>
        </div>

        <!-- Pembayaran -->
        <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
            <h3 class="text-[11px] font-extrabold text-gray-800 mb-4">Pembayaran</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <label class="text-[12px] font-medium text-gray-500 w-1/3">DP (Uang Muka)</label>
                    <div class="relative w-2/3">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-gray-600 font-bold">Rp</span>
                        <input type="hidden" name="down_payment" :value="formPo.dp">
                        <input type="text" x-bind:value="formPo.dp ? format(formPo.dp) : ''"
                            @input="mask($event, formPo, 'dp')"
                            class="w-full bg-white border border-gray-200 rounded-lg pl-8 pr-3 py-2.5 text-[13px] font-bold text-gray-800 focus:outline-none focus:border-[#6C3DE3] text-right transition-colors"
                            placeholder="0">
                    </div>
                </div>
                <div>
                    <label class="block text-[12px] font-medium text-gray-500 mb-3">Metode Pembayaran</label>
                    <div class="flex gap-2">
                        <template x-for="method in ['Cash','Transfer','QRIS']" :key="method">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" x-model="formPo.payMethod" name="payment_method" :value="method"
                                    class="hidden">
                                <div class="w-full flex items-center justify-center gap-1.5 py-2 rounded-xl text-[11px] font-bold border-2 transition-all"
                                    :class="formPo.payMethod===method ? 'border-[#6C3DE3] bg-[#F8F5FF] text-[#6C3DE3]' : 'border-gray-100 bg-white text-gray-500'">
                                    <div class="w-3.5 h-3.5 rounded-full border-2 flex items-center justify-center shrink-0"
                                        :class="formPo.payMethod===method ? 'border-[#6C3DE3]' : 'border-gray-300'">
                                        <div x-show="formPo.payMethod===method"
                                            class="w-1.5 h-1.5 rounded-full bg-[#6C3DE3]"></div>
                                    </div>
                                    <span x-text="method"></span>
                                </div>
                            </label>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Save Button -->
        <div
            class="fixed bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-100 z-50 md:static md:bg-transparent md:border-0 md:p-0 md:mt-4">
            <div class="max-w-lg mx-auto">
                <button type="submit"
                    class="w-full py-3.5 bg-[#6C3DE3] hover:bg-violet-700 text-white font-bold text-[13px] rounded-xl shadow-[0_4px_12px_-2px_rgba(108,61,227,0.4)] active:scale-[0.98] transition-all duration-150"
                    x-text="isEditing ? 'Simpan Perubahan' : 'Simpan Order'">
                </button>
            </div>
        </div>
    </form>
@endsection