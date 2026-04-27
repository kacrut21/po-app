@extends('layouts.app')

@section('mobile_header')
    <div class="bg-white px-5 pt-5 pb-2">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-[17px] font-extrabold text-gray-800 tracking-tight">Katalog & HPP</h1>
        </div>

        <!-- Filter Tabs -->
        <div class="overflow-x-auto no-scrollbar -mx-2 px-2 pb-2" x-data="{activeTab:'katalog'}"
            @menu-tab-change.window="activeTab=$event.detail">
            <div class="flex gap-2 min-w-max">
                <button @click="$dispatch('menu-tab-change', 'katalog')"
                    class="px-4 py-1.5 rounded-xl text-[12px] font-bold transition-all"
                    :class="activeTab==='katalog' ? 'bg-[#6C3DE3] text-white shadow-[0_2px_8px_-2px_rgba(108,61,227,0.4)]' : 'bg-gray-50 text-gray-500 border border-gray-100'">
                    Katalog Menu
                </button>
                <button @click="$dispatch('menu-tab-change', 'hpp')"
                    class="px-4 py-1.5 rounded-xl text-[12px] font-bold transition-all"
                    :class="activeTab==='hpp' ? 'bg-[#6C3DE3] text-white shadow-[0_2px_8px_-2px_rgba(108,61,227,0.4)]' : 'bg-gray-50 text-gray-500 border border-gray-100'">
                    Kalkulator HPP
                </button>
                <button @click="$dispatch('menu-tab-change', 'addon')"
                    class="px-4 py-1.5 rounded-xl text-[12px] font-bold transition-all"
                    :class="activeTab==='addon' ? 'bg-[#6C3DE3] text-white shadow-[0_2px_8px_-2px_rgba(108,61,227,0.4)]' : 'bg-gray-50 text-gray-500 border border-gray-100'">
                    Kelola Add-on
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div x-data='{
                        serverMenus: @json($menus),
                        activeTab: "katalog",
                        init() {
                            const params = new URLSearchParams(window.location.search);
                            const tab = params.get("tab");
                            if (tab) {
                                this.activeTab = tab;
                                this.$nextTick(() => {
                                    window.dispatchEvent(new CustomEvent("menu-tab-change", { detail: tab }));
                                });
                            }
                        },

                        // HPP Data
                        hppMenuId: "",
                        hppPortion: 100,
                        hppIngredients: [],
                        hppSellPrice: 0,

                        loadHpp() {
                            if (!this.hppMenuId) {
                                this.hppIngredients = [];
                                this.hppSellPrice = 0;
                                return;
                            }
                            let menu = this.serverMenus.find(m => m.id == this.hppMenuId);
                            if (menu) {
                                this.hppPortion = menu.hpp || 100; // mapped to DB field
                                this.hppSellPrice = menu.selling_price || 0;

                                if (menu.ingredients && menu.ingredients.length > 0) {
                                    this.hppIngredients = menu.ingredients.map(ing => ({
                                        name: ing.name,
                                        qty: ing.pivot.quantity,
                                        unit: ing.unit,
                                        price: ing.pivot.quantity * ing.price_per_unit
                                    }));
                                } else {
                                    this.hppIngredients = [];
                                }
                            }
                        },

                        init() {
                            const params = new URLSearchParams(window.location.search);
                            const tab = params.get("tab");
                            if (tab) {
                                this.activeTab = tab;
                                this.$nextTick(() => {
                                    window.dispatchEvent(new CustomEvent("menu-tab-change", { detail: tab }));
                                });
                            }
                        },

                        saveHpp() {
                            // To be implemented via POST
                            this.notify("Setup HPP logic requires update to POST to server!", "error");
                        },

                        get hppTotalCost() {
                            return this.hppIngredients.reduce((s, i) => s + (parseInt(i.price)||0), 0);
                        },
                        get hppCostPerPortion() {
                            return this.hppPortion > 0 ? this.hppTotalCost / this.hppPortion : 0;
                        },
                        get hppProfit() {
                            return this.hppSellPrice - this.hppCostPerPortion;
                        },
                        get hppMargin() {
                            if(!this.hppSellPrice) return 0;
                            return (this.hppProfit / this.hppSellPrice) * 100;
                        }
                    }' @menu-tab-change.window="activeTab=$event.detail" class="px-4 pt-2 pb-6 space-y-4">

        <!-- TAB: KATALOG MENU -->
        <div x-show="activeTab === 'katalog'" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-4">

            @if(session('success'))
                <div
                    class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl border border-emerald-100 text-[12px] font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 text-red-600 px-4 py-3 rounded-xl border border-red-100 text-[12px] font-bold">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Tambah -->
            <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50"
                x-data="{price:0}">
                <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="category" value="Umum">
                    <h2 class="text-[13px] font-extrabold text-gray-800 mb-3">Tambah Menu Baru</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">Nama Menu</label>
                            <input type="text" name="name" required
                                class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                placeholder="Misal: Nasi Box Spesial">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">Harga Dasar (Rp)</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-gray-600 font-bold">Rp</span>
                                <input type="hidden" name="selling_price" :value="price">
                                <input type="text" :value="format(price)" @input="mask($event,$data,'price')" required
                                    class="w-full bg-white border border-gray-200 rounded-xl pl-8 pr-4 py-2 text-[12px] font-extrabold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                    placeholder="0">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full py-2.5 mt-2 bg-[#6C3DE3] hover:bg-violet-700 text-white font-bold text-[12px] rounded-xl active:scale-[0.98] transition-all">
                            Simpan Menu
                        </button>
                    </div>
                </form>
            </div>

            <!-- Daftar Menu -->
            <div>
                <h2 class="text-[13px] font-extrabold text-gray-800 mb-3 px-1">Menu Tersimpan ({{ $menus->count() }})</h2>
                <div class="space-y-3">
                    @forelse($menus as $menu)
                        <div class="bg-white rounded-xl p-3 flex items-center gap-3 shadow-sm border border-gray-100/60">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#F8F5FF] flex items-center justify-center text-[#6C3DE3] shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-[12px] font-bold text-gray-800 truncate">{{ $menu->name }}</h4>
                                <p class="text-[10px] text-[#6C3DE3] font-bold">
                                    Rp {{ number_format($menu->selling_price, 0, ',', '.') }} / porsi
                                </p>
                            </div>
                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-500 rounded-xl flex items-center justify-center transition-colors">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div
                            class="bg-white rounded-xl p-8 text-center text-gray-400 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
                            <div class="w-14 h-14 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <p class="text-[12px] font-bold text-gray-600">Belum ada menu</p>
                            <p class="text-[10px] mt-1 text-gray-400">Tambahkan menu di atas untuk mulai</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- TAB: KALKULATOR HPP -->
        <form method="POST" :action="hppMenuId ? '{{ url('/menu') }}/' + hppMenuId + '/hpp' : '#'"
            x-show="activeTab === 'hpp'" style="display:none" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-4">
            @csrf

            <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
                <!-- Menu + Porsi Config -->
                <div class="grid grid-cols-5 gap-3">
                    <div class="col-span-3">
                        <label class="block text-[11px] font-medium text-gray-500 mb-1.5">Menu</label>
                        <div class="relative">
                            <select x-model="hppMenuId" @change="loadHpp()"
                                class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] appearance-none pr-8 transition-colors">
                                <option value="">Pilih Menu...</option>
                                <template x-for="m in serverMenus" :key="m.id">
                                    <option :value="m.id" x-text="m.name"></option>
                                </template>
                            </select>
                            <div class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-[11px] font-medium text-gray-500 mb-1.5">Porsi / Resep</label>
                        <input type="number" x-model.number="hppPortion" min="1" step="any"
                            class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-[12px] font-extrabold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors text-center"
                            title="Isi 1 jika bahan baku di bawah untuk 1 porsi. Isi total porsi jika bahan baku untuk 1 resep utuh.">
                    </div>
                </div>

                <!-- Bahan Baku -->
                <div>
                    <div class="flex items-center justify-between mb-3 mt-4">
                        <h2 class="text-[13px] font-extrabold text-gray-800">Bahan Baku</h2>
                        <button type="button" @click="hppIngredients.push({name:'', qty:1, unit:'kg', price:0})"
                            class="flex items-center gap-1.5 px-3 py-1.5 bg-violet-50 text-violet-600 rounded-lg text-[12px] md:text-[13px] font-bold hover:bg-violet-100 active:scale-95 transition-all">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Bahan
                        </button>
                    </div>

                    <div class="space-y-1 mt-3">
                        <template x-for="(ing, i) in hppIngredients" :key="i">
                            <div class="flex items-center justify-between py-2 border-b border-gray-50/50">
                                <div class="flex-1">
                                    <input type="text" x-model="ing.name"
                                        class="w-full bg-white border border-gray-200 rounded-md px-2 py-1.5 text-[12px] font-bold text-gray-700 placeholder-gray-300 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                        placeholder="Nama Bahan">
                                </div>
                                <div class="w-20 flex items-center justify-end gap-1 px-2">
                                    <input type="number" x-model.number="ing.qty" step="any"
                                        class="w-10 bg-white border border-gray-200 rounded-md px-1 py-1.5 text-[12px] font-semibold text-gray-700 text-center focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                        placeholder="0">
                                    <input type="text" x-model="ing.unit"
                                        class="w-8 bg-transparent outline-none text-[12px] font-semibold text-gray-500"
                                        placeholder="kg">
                                </div>
                                <div class="w-[100px] flex items-center">
                                    <span class="text-[12px] text-gray-500 font-medium mr-1">Rp</span>
                                    <input type="text" :value="format(ing.price)" @input="mask($event, ing, 'price')"
                                        class="flex-1 min-w-0 bg-white border border-gray-200 rounded-md px-2 py-1.5 text-[12px] font-medium text-gray-700 text-right placeholder-gray-300 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                        placeholder="0">
                                </div>
                                <button @click="hppIngredients.splice(i,1)"
                                    class="w-6 h-6 flex items-center justify-center text-gray-400 hover:text-red-500 ml-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </template>
                        <div x-show="hppIngredients.length===0" class="text-center py-4 text-[11px] text-gray-400 italic">
                            Belum ada bahan baku ditambahkan.
                        </div>
                    </div>
                </div>

                <!-- Hasil Kalkulasi -->
                <div class="bg-[#F8F5FF] rounded-xl p-4 mt-6 mb-2 mt-3">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[12px] text-gray-600 font-medium">Total Biaya Bahan</span>
                        <span class="text-[13px] font-extrabold text-gray-800" x-text="'Rp ' + format(hppTotalCost)"></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-[12px] text-[#6C3DE3] font-medium">Biaya Per Porsi (HPP)</span>
                        <span class="text-[14px] font-extrabold text-[#6C3DE3]"
                            x-text="'Rp ' + format(hppCostPerPortion)"></span>
                    </div>
                </div>

                <!-- Harga Jual Input -->
                <div class="flex justify-between items-center py-4">
                    <span class="text-[12px] text-gray-500 font-medium">Harga Jual / Porsi</span>
                    <div class="flex items-center gap-2 border border-gray-200 rounded-lg px-3 py-2 bg-white">
                        <span class="text-[12px] text-gray-600 font-bold">Rp</span>
                        <input type="text" :value="format(hppSellPrice)" @input="mask($event, $data, 'hppSellPrice')"
                            class="w-[85px] text-right text-[13px] font-extrabold text-gray-800 bg-transparent outline-none">
                        <svg class="h-3 w-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Result Card -->
                <div class="border shadow-sm rounded-xl p-4 transition-colors duration-300"
                    :class="hppMargin >= 30 ? 'border-[#DCFCE7] bg-[#F0FDF4]' : (hppMargin < 0 ? 'border-red-100 bg-red-50' : (hppMargin > 0 ? 'border-[#FEF3C7] bg-[#FFFBEB]' : 'border-gray-100 bg-white'))">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[11px] font-bold mb-1"
                                :class="hppMargin >= 30 ? 'text-[#15803D]' : (hppMargin < 0 ? 'text-red-500' : (hppMargin > 0 ? 'text-[#F59E0B]' : 'text-gray-400'))">
                                Keuntungan / Porsi</p>
                            <p class="text-[18px] font-extrabold"
                                :class="hppMargin >= 30 ? 'text-[#15803D]' : (hppMargin < 0 ? 'text-red-500' : (hppMargin > 0 ? 'text-[#F59E0B]' : 'text-gray-400'))"
                                x-text="'Rp ' + format(hppProfit)"></p>
                        </div>
                        <div>
                            <p class="text-[11px] font-bold mb-1"
                                :class="hppMargin >= 30 ? 'text-[#15803D]' : (hppMargin < 0 ? 'text-red-500' : (hppMargin > 0 ? 'text-[#F59E0B]' : 'text-gray-400'))">
                                Margin</p>
                            <p class="text-[18px] font-extrabold"
                                :class="hppMargin >= 30 ? 'text-[#15803D]' : (hppMargin < 0 ? 'text-red-500' : (hppMargin > 0 ? 'text-[#F59E0B]' : 'text-gray-400'))"
                                x-text="hppMargin.toFixed(1) + '%'"></p>
                        </div>
                    </div>
                    <div
                        class="mt-4 inline-flex items-center justify-center bg-white border border-gray-100 rounded-full px-3 py-1">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2.5 h-2.5 rounded-full flex items-center justify-center"
                                :class="hppMargin >= 30 ? 'bg-[#10B981]' : (hppMargin < 0 ? 'bg-red-500' : (hppMargin > 0 ? 'bg-[#F59E0B]' : 'bg-gray-300'))">
                                <svg x-show="hppMargin >= 30" class="h-1.5 w-1.5 text-white" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-[10px] font-bold"
                                :class="hppMargin >= 30 ? 'text-[#15803D]' : (hppMargin < 0 ? 'text-red-500' : (hppMargin > 0 ? 'text-[#F59E0B]' : 'text-gray-400'))"
                                x-text="hppMargin >= 30 ? 'Sehat' : (hppMargin < 0 ? 'Rugi' : (hppMargin > 0 ? 'Tipis' : '-'))"></span>
                        </div>
                    </div>
                </div>

                <p class="text-[10px] text-gray-500 font-medium mt-1">› Margin di atas 30% tergolong sehat 🎉</p>

                <!-- Hidden inputs for form submission -->
                <input type="hidden" name="hppSellPrice" :value="hppSellPrice">
                <input type="hidden" name="hppPortion" :value="hppPortion">
                <input type="hidden" name="hppMargin" :value="hppMargin">
                <template x-for="(ing, i) in hppIngredients" :key="i">
                    <div>
                        <input type="hidden" :name="'ingredients['+i+'][name]'" :value="ing.name">
                        <input type="hidden" :name="'ingredients['+i+'][qty]'" :value="ing.qty">
                        <input type="hidden" :name="'ingredients['+i+'][unit]'" :value="ing.unit">
                        <input type="hidden" :name="'ingredients['+i+'][price]'" :value="ing.price">
                    </div>
                </template>

                <!-- Save Button -->
                <button type="submit" :disabled="!hppMenuId"
                    class="w-full py-3.5 mt-4 text-[13px] font-bold text-white rounded-xl shadow-[0_4px_12px_-2px_rgba(108,61,227,0.4)] active:scale-[0.98] transition-all duration-150"
                    :class="hppMenuId ? 'bg-[#6C3DE3] hover:bg-violet-700' : 'bg-gray-300 cursor-not-allowed'">
                    Simpan Setup HPP
                </button>
            </div>
        </form>

        <!-- TAB: KELOLA ADD-ON (MASTER) -->
        <div x-show="activeTab === 'addon'" style="display:none" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="space-y-6">

            <!-- Form Tambah Add-on -->
            <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50"
                 x-data="{addonPrice: 0}">
                <form action="{{ route('menu.addons.store') }}" method="POST">
                    @csrf
                    <h2 class="text-[13px] font-extrabold text-gray-800 mb-3">Tambah Master Add-on</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">Nama Add-on</label>
                            <input type="text" name="name" required
                                class="w-full bg-white border border-gray-200 rounded-xl px-3 py-2 text-[12px] font-semibold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                placeholder="Misal: Extra Sambal">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">Tambahan Harga (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[12px] text-gray-600 font-bold">Rp</span>
                                <input type="hidden" name="price" :value="addonPrice">
                                <input type="text" :value="format(addonPrice)" @input="mask($event, $data, 'addonPrice')" required
                                    class="w-full bg-white border border-gray-200 rounded-xl pl-8 pr-4 py-2 text-[12px] font-extrabold text-gray-800 focus:outline-none focus:border-[#6C3DE3] transition-colors"
                                    placeholder="0">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full py-2.5 mt-2 bg-[#6C3DE3] hover:bg-violet-700 text-white font-bold text-[12px] rounded-xl active:scale-[0.98] transition-all">
                            Simpan Master Add-on
                        </button>
                    </div>
                </form>
            </div>

            <!-- Daftar Master Add-on -->
            <div>
                <h2 class="text-[13px] font-extrabold text-gray-800 mb-3 px-1">Master Add-on Tersimpan ({{ $addons->count() }})</h2>
                <div class="space-y-3">
                    @forelse($addons as $addon)
                        <div class="bg-white rounded-xl p-3 flex items-center gap-3 shadow-sm border border-gray-100/60">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 flex items-center justify-center text-[#6C3DE3] shrink-0">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-[12px] font-bold text-gray-800 truncate">{{ $addon->name }}</h4>
                                <p class="text-[10px] text-[#6C3DE3] font-bold">
                                    + Rp {{ number_format($addon->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <form action="{{ route('menu.addons.destroy', $addon->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus add-on ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-8 h-8 bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-500 rounded-xl flex items-center justify-center transition-colors">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="bg-white rounded-xl p-8 text-center text-gray-400 border border-gray-50">
                            <div class="w-14 h-14 bg-gray-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <svg class="h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-[12px] font-bold text-gray-600">Belum ada master add-on</p>
                            <p class="text-[10px] mt-1 text-gray-400">Tambahkan di atas untuk muncul sebagai pilihan di pesanan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection