const CACHE_NAME = 'orderin-v1.0.5';
const STATIC_CACHE = 'orderin-static-v1';

// Assets yang di-cache saat install
const PRECACHE_URLS = [
    '/',
    '/pesanan',
    '/manifest.json',
    '/icon-192.png',
    '/icon-512.png',
    '/favicon.png',
];

// ── Install: pre-cache shell utama ──────────────────────────────────────────
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE).then((cache) => {
            return cache.addAll(PRECACHE_URLS).catch((err) => {
                console.warn('[SW] Pre-cache failed for some URLs:', err);
            });
        })
    );
    self.skipWaiting();
});

// ── Activate: bersihkan cache lama ──────────────────────────────────────────
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter((key) => key !== CACHE_NAME && key !== STATIC_CACHE)
                    .map((key) => caches.delete(key))
            )
        )
    );
    self.clients.claim();
});

// ── Fetch: Network First, fallback to Cache ──────────────────────────────────
self.addEventListener('fetch', (event) => {
    // Skip non-GET dan browser-extensions
    if (event.request.method !== 'GET') return;
    if (!event.request.url.startsWith(self.location.origin)) return;

    // Skip POST/API/form routes (jangan di-cache)
    const url = new URL(event.request.url);
    if (
        url.pathname.startsWith('/login') ||
        url.pathname.startsWith('/logout') ||
        url.pathname.startsWith('/register') ||
        url.pathname.includes('/pembayaran') ||
        url.pathname.includes('/status') ||
        url.pathname.includes('/store') ||
        url.pathname.includes('/update') ||
        url.pathname === '/form-po' && event.request.method === 'POST'
    ) {
        return;
    }

    event.respondWith(
        fetch(event.request)
            .then((networkResponse) => {
                // Simpan salinan ke cache untuk fallback offline
                if (networkResponse && networkResponse.status === 200) {
                    const responseClone = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseClone);
                    });
                }
                return networkResponse;
            })
            .catch(() => {
                // Offline fallback: ambil dari cache
                return caches.match(event.request).then((cached) => {
                    if (cached) return cached;
                    // Fallback ke halaman utama jika navigasi
                    if (event.request.mode === 'navigate') {
                        return caches.match('/');
                    }
                });
            })
    );
});
