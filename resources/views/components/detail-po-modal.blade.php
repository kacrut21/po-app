<!-- DETAIL PO MODAL -->
<div x-show="showDetailModal"
     style="display:none"
     class="fixed inset-0 z-[60] flex items-end justify-center md:items-center md:p-4 bg-black/40 backdrop-blur-sm"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <div class="w-full max-w-lg h-[90vh] md:h-auto md:max-h-[90vh] bg-gray-50 rounded-t-2xl flex flex-col overflow-hidden shadow-2xl"
         @click.away="showDetailModal=false"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="translate-y-full opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="translate-y-0 opacity-100"
         x-transition:leave-end="translate-y-full opacity-0">

        <div class="flex flex-col h-full overflow-hidden">

            <!-- Header -->
            <div class="bg-white px-5 pt-5 pb-4 shrink-0 rounded-t-2xl border-b border-gray-100/50">
                <div class="flex items-center gap-3 mb-6">
                    <button @click="showDetailModal=false"
                        class="w-8 h-8 flex items-center justify-center text-gray-500 hover:bg-gray-50 rounded-xl transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </button>
                    <div class="flex-1 text-center">
                        <h2 class="text-[15px] font-bold text-gray-800">Detail Order</h2>
                    </div>
                    <button @click="editPo(activePo)" class="w-8 h-8 flex items-center justify-center text-violet-600 bg-violet-50 hover:bg-violet-100 rounded-xl transition-colors">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="text-[15px] font-extrabold text-gray-800" x-text="activePo?.poNumber"></h2>
                        <p class="text-[11px] font-medium text-gray-400 mt-0.5" x-text="'Dibuat: ' + (activePo?.created_at ? new Date(activePo.created_at).toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric', hour:'2-digit', minute:'2-digit'}) : '')"></p>
                    </div>
                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold tracking-wide flex items-center gap-1"
                          :class="{
                              'bg-[#F1F5F9] text-[#64748B]': activePo?.status==='masuk',
                              'bg-[#EFF6FF] text-[#3B82F6]': activePo?.status==='konfirmasi',
                              'bg-[#FFF8EB] text-[#F59E0B]': activePo?.status==='produksi',
                              'bg-[#ECFDF5] text-[#10B981]': activePo?.status==='siap',
                              'bg-[#F3E8FF] text-[#A855F7]': activePo?.status==='selesai'
                          }">
                        <span class="w-1.5 h-1.5 rounded-full"
                              :class="{
                                  'bg-[#64748B]': activePo?.status==='masuk',
                                  'bg-[#3B82F6]': activePo?.status==='konfirmasi',
                                  'bg-[#F59E0B]': activePo?.status==='produksi',
                                  'bg-[#10B981]': activePo?.status==='siap',
                                  'bg-[#A855F7]': activePo?.status==='selesai'
                              }"></span>
                        <span x-text="activePo?.status === 'siap' ? 'Siap Kirim' : (activePo?.status ? activePo.status.charAt(0).toUpperCase() + activePo.status.slice(1) : '')"></span>
                    </span>
                </div>

                <!-- Status Stepper -->
                <div class="flex items-center justify-between relative px-2">
                    <div class="absolute top-[14px] left-8 right-[50%] h-0.5 z-0" :class="activePo?.statusIdx >= 2 ? 'bg-[#6C3DE3]' : 'bg-gray-200'"></div>
                    <div class="absolute top-[14px] left-[50%] right-8 h-0.5 z-0" :class="activePo?.statusIdx >= 4 ? 'bg-[#6C3DE3]' : 'bg-gray-200'"></div>
                    
                    <template x-for="(st, i) in ['masuk','konfirmasi','produksi','siap','selesai']" :key="st">
                        <div class="flex flex-col items-center gap-1.5 z-10 relative">
                            <!-- Check if completed -->
                            <div x-show="activePo?.statusIdx > i" class="w-7 h-7 rounded-full bg-[#6C3DE3] flex items-center justify-center text-white">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <!-- Check if active -->
                            <div x-show="activePo?.statusIdx === i" class="w-7 h-7 rounded-full flex items-center justify-center text-white ring-4"
                                 :class="{
                                     'bg-[#64748B] ring-[#F1F5F9]': i===0,
                                     'bg-[#3B82F6] ring-[#EFF6FF]': i===1,
                                     'bg-[#F59E0B] ring-[#FFF8EB]': i===2,
                                     'bg-[#10B981] ring-[#ECFDF5]': i===3,
                                     'bg-[#A855F7] ring-[#F3E8FF]': i===4
                                 }">
                                 <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path x-show="i===0||i===1||i===4" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    <path x-show="i===2" stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    <path x-show="i===3" stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
                            </div>
                            <!-- Check if future -->
                            <div x-show="activePo?.statusIdx < i" class="w-7 h-7 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center text-gray-300">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[9px] font-bold"
                                  :class="activePo?.statusIdx >= i ? (i===0?'text-[#64748B]':i===1?'text-[#3B82F6]':i===2?'text-[#F59E0B]':i===3?'text-[#10B981]':'text-[#A855F7]') : 'text-gray-400'"
                                  x-text="st==='siap' ? 'Siap Kirim' : st.charAt(0).toUpperCase() + st.slice(1)"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Scrollable Body -->
            <div class="flex-1 overflow-y-auto p-4 space-y-4">

                <!-- Customer Info -->
                <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
                    <h3 class="text-[11px] font-extrabold text-gray-800 mb-3">Informasi Customer</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(activePo?.name||'User')}&background=random&color=fff&bold=true`" alt="Avatar" class="w-6 h-6 rounded-full">
                                <span class="text-[13px] font-bold text-gray-800" x-text="activePo?.name"></span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-[12px] font-medium text-gray-700" x-text="activePo?.wa || activePo?.customer_phone || '-'"></span>
                            </div>
                        </div>
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-3 text-gray-500">
                                <svg class="h-4 w-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-[12px] font-medium text-gray-700" x-text="activePo?.address || activePo?.delivery_address || '-'"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Order -->
                <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
                    <h3 class="text-[11px] font-extrabold text-gray-800 mb-3">Detail Order</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-gray-500 font-medium">Jenis Acara</span>
                            <span class="text-[12px] font-semibold text-gray-800" x-text="activePo?.event"></span>
                        </div>
                        <template x-if="activePo?.items">
                            <template x-for="(item, index) in activePo.items" :key="index">
                                <div>
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="text-[12px] text-gray-500 font-medium" x-text="'Menu ' + (index+1)"></span>
                                        <span class="text-[12px] font-semibold text-gray-800" x-text="item.menu"></span>
                                    </div>
                                    <div class="flex justify-between items-center mt-0.5">
                                        <span class="text-[12px] text-gray-500 font-medium">Jumlah & Harga</span>
                                        <span class="text-[12px] font-semibold text-gray-800" x-text="item.qty + ' Porsi x Rp ' + format(item.price)"></span>
                                    </div>
                                    <template x-if="item.addons && item.addons.length > 0">
                                        <div class="mt-1.5 pl-4 border-l-2 border-violet-100 space-y-1">
                                            <template x-for="ad in item.addons" :key="ad.id">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-[11px] text-violet-600 font-bold" x-text="'+ ' + ad.name"></span>
                                                    <span class="text-[11px] text-gray-500 font-medium" x-text="'Rp ' + format(ad.price)"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </template>
                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-100">
                            <span class="text-[12px] text-gray-500 font-medium">Ongkos Kirim</span>
                            <span class="text-[12px] font-semibold text-gray-800" x-text="'Rp ' + format(activePo?.ongkir || activePo?.shipping_fee || 0)"></span>
                        </div>
                        <div class="flex justify-between items-start mt-2">
                            <span class="text-[12px] text-gray-500 font-medium w-24 shrink-0">Catatan</span>
                            <span class="text-[12px] font-medium text-gray-600 text-right leading-snug" x-text="activePo?.note || activePo?.notes || '-'"></span>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-50">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-[11px] font-extrabold text-gray-800">Pembayaran</h3>
                        <template x-if="(activePo?.total || calculateTotal(activePo)) - (activePo?.dp||0) > 0">
                            <button @click="updatePayment(activePo)" 
                                class="px-3 py-1 bg-[#10B981] text-white text-[10px] font-bold rounded-lg shadow-sm active:scale-95 transition-all">
                                Update Pembayaran
                            </button>
                        </template>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-gray-500 font-medium">Total Tagihan</span>
                            <span class="text-[13px] font-extrabold text-gray-800" x-text="'Rp ' + format(activePo?.total || calculateTotal(activePo))"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-gray-500 font-medium">DP (Dibayar)</span>
                            <span class="text-[13px] font-extrabold text-[#10B981]" x-text="'Rp ' + format(activePo?.dp||0)"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-gray-500 font-medium">Sisa Pembayaran</span>
                            <span class="text-[13px] font-extrabold text-[#D93F21]" x-text="'Rp ' + format((activePo?.total || calculateTotal(activePo)) - (activePo?.dp||0))"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[12px] text-gray-500 font-medium">Metode</span>
                            <span class="text-[12px] font-semibold text-gray-800" x-text="activePo?.payMethod || activePo?.payment_method || '-'"></span>
                        </div>
                    </div>
                    <!-- Send WA Button -->
                    <button @click="sendWAInvoice(activePo)" class="w-full mt-4 py-2.5 bg-[#25D366]/10 text-[#25D366] border border-[#25D366]/20 hover:bg-[#25D366]/20 font-bold text-[12px] rounded-xl flex items-center justify-center gap-2 transition-colors">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.082 21.083c-1.503 0-2.973-.404-4.254-1.168l-4.73 1.242 1.265-4.613c-.838-1.32-1.28-2.855-1.28-4.446 0-4.613 3.753-8.366 8.366-8.366 4.613 0 8.366 3.753 8.366 8.366 0 4.613-3.753 8.366-8.366 8.366z"/></svg>
                        Kirim Invoice via WhatsApp
                    </button>
                </div>

                <!-- Update Status -->
                <div class="bg-white rounded-xl p-4 shadow-[0_2px_10px_-4_rgba(0,0,0,0.05)] border border-gray-50">
                    <h3 class="text-[11px] font-extrabold text-gray-800 mb-1">Update Status Order</h3>
                    <p class="text-[10px] text-gray-400 mb-4 font-medium">Pilih status terbaru untuk order ini</p>
                    
                    <div class="flex items-center justify-between px-2 relative">
                        <div class="absolute top-[18px] left-6 right-6 h-0.5 bg-gray-100 z-0"></div>
                        
                        <template x-for="(st, i) in ['masuk','konfirmasi','produksi','siap','selesai']" :key="st">
                            <div class="flex flex-col items-center gap-1.5 z-10 relative">
                                <button @click="updateStatus(activePo.id, st)"
                                        class="w-9 h-9 rounded-full flex items-center justify-center transition-all duration-200"
                                        :class="activePo?.statusIdx === i ? (
                                            i===0 ? 'bg-[#64748B] text-white ring-4 ring-[#F1F5F9]' :
                                            i===1 ? 'bg-[#3B82F6] text-white ring-4 ring-[#EFF6FF]' :
                                            i===2 ? 'bg-[#F59E0B] text-white ring-4 ring-[#FFF8EB]' :
                                            i===3 ? 'bg-[#10B981] text-white ring-4 ring-[#ECFDF5]' :
                                            'bg-[#A855F7] text-white ring-4 ring-[#F3E8FF]'
                                        ) : 'bg-white border-2 border-gray-200 text-gray-300 hover:border-[#6C3DE3] hover:text-[#6C3DE3]'">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path x-show="i===0||i===1||i===4" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        <path x-show="i===2" stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        <path x-show="i===3" stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                    </svg>
                                </button>
                                <span class="text-[9px] font-bold"
                                      :class="activePo?.statusIdx === i ? (
                                            i===0 ? 'text-[#64748B]' :
                                            i===1 ? 'text-[#3B82F6]' :
                                            i===2 ? 'text-[#F59E0B]' :
                                            i===3 ? 'text-[#10B981]' :
                                            'text-[#A855F7]'
                                      ) : 'text-gray-400'"
                                      x-text="st==='siap' ? 'Siap Kirim' : st.charAt(0).toUpperCase() + st.slice(1)"></span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Delete Action -->
                <div class="pt-2">
                    <button @click="confirmDelete(activePo.id)" class="w-full py-3 bg-red-50 text-red-500 hover:bg-red-100 font-bold text-[12px] rounded-xl flex items-center justify-center gap-2 transition-colors border border-red-100">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Pesanan Ini
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
