const appKey = 'my-forecast-app';

self.addEventListener('install', e => { //インストールされたとき

    //  基本ファイルのキャッシュを保存
    caches.open(appKey)
        .then(cache => {

            cache.addAll([
                '/pwa_forecast',
                'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
                'https://cdn.jsdelivr.net/npm/vue@2.6.11'
            ]);

        })

});

self.addEventListener('fetch', e => { //  データ取得するとき ・・・ ②

    e.respondWith(getFetchResponse(e.request));

});

async function getFetchResponse(request) {

    const url = new URL(request.url);

    if(url.host === location.host) { // 自分のサイト内のURLの場合

        // キャッシュ優先
        const cachedResponse = await caches.match(request);

        if(cachedResponse) {

            return cachedResponse;

        }

        return fetch(request);

    } else {

        // ネットワーク優先
        const cache = await caches.open(appKey);

        try {

            const response = await fetch(request);
            await cache.put(request, response.clone());
            return response;

        } catch {

            return await cache.match(request);

        }

    }

}