// var cacheAll = false;
// var CACHE_NAME = 'OurPos_Cache';
// var urlsToCache = [
//     '/',
//     '/dashboard',
//     '/public/dist',
//     '/public/src',
//     '/public/plugins',
//     '/public/js',
// ];
// var urlsNotToCache = [
// ];
//
// // Install Event
// self.addEventListener('install', function(event) {
//     console.log("[OurPos] install event: ",event);
//     // Perform install steps
//     event.waitUntil(
//         caches.open(CACHE_NAME).then(
//             function(cache) {
//                 console.log('[OurPos] Opened cache: ',cache);
//                 return cache.addAll(urlsToCache);
//             }
//         )
//     );
// });
//
//
// // Fetch Event
// self.addEventListener('fetch', function(event) {
//     console.log("[OurPos] fetch event: ",event);
//     event.respondWith(
//         caches.match(event.request).then(
//             function(response) {
//                 if (response) return response;
//                 else if (!cacheAll || urlsNotToCache.indexOf(event.request) !== -1) return fetch(event.request);
//                 else {
//                     fetch(event.request).then(
//                         function(response) {
//                             if(!response || response.status !== 200 || response.type !== 'basic') return response;
//                             var responseToCache = response.clone();
//                             caches.open(CACHE_NAME).then(
//                                 function(cache) {
//                                     cache.put(event.request, responseToCache);
//                                 }
//                             );
//                             return response;
//                         }
//                     );
//                 }
//             }
//         )
//     );
// });



const CACHE_NAME = 'offline';
const OFFLINE_URL = 'offline.html';

// Initialize deferredPrompt for use later to show browser install prompt.
let deferredPrompt;

// window.addEventListener('beforeinstallprompt', (e) => {
//     // Prevent the mini-infobar from appearing on mobile
//     // e.preventDefault();
//     // Stash the event so it can be triggered later.
//     deferredPrompt = e;
//     // Update UI notify the user they can install the PWA
//     showInstallPromotion();
//     // Optionally, send analytics event that PWA install promo was shown.
//     console.log(`'beforeinstallprompt' event was fired.`);
// });

self.addEventListener('install', function(event) {
    console.log('[ServiceWorker] Install');

    event.waitUntil((async () => {
        const cache = await caches.open(CACHE_NAME);
        // Setting {cache: 'reload'} in the new request will ensure that the response
        // isn't fulfilled from the HTTP cache; i.e., it will be from the network.
        await cache.add(new Request(OFFLINE_URL, {cache: 'reload'}));
    })());

    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    console.log('[ServiceWorker] Activate');
    event.waitUntil((async () => {
        // Enable navigation preload if it's supported.
        // See https://developers.google.com/web/updates/2017/02/navigation-preload
        if ('navigationPreload' in self.registration) {
            await self.registration.navigationPreload.enable();
        }
    })());

    // Tell the active service worker to take control of the page immediately.
    self.clients.claim();
});

self.addEventListener('fetch', function(event) {
    // console.log('[Service Worker] Fetch', event.request.url);
    if (event.request.mode === 'navigate') {
        event.respondWith((async () => {
            try {
                const preloadResponse = await event.preloadResponse;
                if (preloadResponse) {
                    return preloadResponse;
                }

                const networkResponse = await fetch(event.request);
                return networkResponse;
            } catch (error) {
                console.log('[Service Worker] Fetch failed; returning offline page instead.', error);

                const cache = await caches.open(CACHE_NAME);
                const cachedResponse = await cache.match(OFFLINE_URL);
                return cachedResponse;
            }
        })());
    }
});
