<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="manifest" href="/manifest.json">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="p-3">
        <div class="row">
            <div class="col-md-8">
                <h1>天気予報テスト</h1>
            </div>
            <div class="col-md-4 text-right mb-3">
                <button class="btn btn-primary" type="button" @click="onInstallationClick">ホーム画面へ登録</button>
            </div>
            <div class="col-md-12">
                <select
                    class="form-control mb-3"
                    v-model="currentCityId"
                    @change="getForecast">
                    <option
                        v-for="c in cities"
                        v-text="c.name"
                        :value="c.id">
                    </option>
                </select>
                <div class="card mb-2" v-for="f in forecasts">
                    <div class="card-body">
                        <img :src="forecastIcon(f.weather)">
                        <span v-text="f.dt_txt"></span>
                    </div>
                </div>
                <div class="pl-2" v-if="!forecasts.length">
                    データが見つかりません。
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script>

        new Vue({
            el: '#app',
            data: {
                currentCityId: 1850144, // 東京
                appId: '{{ env('OPEN_WEATHER_MAP_API') }}',
                cities: [
                    { id: 2128295, name: '札幌' },
                    { id: 1850144, name: '東京' },
                    { id: 1856057, name: '名古屋' },
                    { id: 1853909, name: '大阪' },
                    { id: 1863967, name: '福岡' }
                ],
                forecasts: [],
                promptEvent: null,
            },
            methods: {
                async getForecast() {   // 天気データを取得

                    this.forecasts = [];

                    if(this.currentCityId > 0) {

                        const url = `https://api.openweathermap.org/data/2.5/forecast?id=${this.currentCityId}&appid=${this.appId}`;
                        const response = await fetch(url);

                        if(response.ok) {

                            const data = await response.json();
                            this.forecasts = data.list;

                        }

                    }

                },
                forecastIcon(weather) {

                    // OpenWeatherMapが提供するアイコンのURL
                    return `https://openweathermap.org/img/wn/${weather[0].icon}.png`;

                },
                onInstallationClick() { //  PWAアプリをインストールする部分

                    this.promptEvent.prompt();
                    this.promptEvent.userChoice
                        .then(choice => {

                            if(choice.outcome === 'accepted') {

                                console.log('PWA: インストールを許可しました。');

                            } else {

                                console.log('PWA: インストールを拒否しました。');

                            }

                            this.promptEvent = null;

                        });

                }
            },
            computed: {
                showButton() {

                    return (this.promptEvent !== null);

                }
            },
            created() {

                window.addEventListener('beforeinstallprompt', e => {

                    e.preventDefault();
                    this.promptEvent = e;

                });

                //  Service Workerをインストールする部分
                if('serviceWorker' in navigator) {

                    navigator.serviceWorker.register('sw.js')
                        .then(registration => {

                            if(registration.installing) {

                                console.log('Service Worker: インストール成功！');
                                location.reload(); //  インストール直後はリロード

                            } else {

                                this.getForecast();

                            }

                        })
                        .catch(error => {

                            console.log('Service Worker: インストール失敗...');

                        });

                } else {

                    this.getForecast();

                }

            }
        });

    </script>
</body>
</html>