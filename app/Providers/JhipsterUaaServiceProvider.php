<?php

namespace App\Providers;

use Appkr\Infra\JhipsterUaa\CacheableTokenKeyProvider;
use Appkr\Infra\JhipsterUaa\UaaTokenKeyProvider;
use Appkr\Infra\TokenKeyProvider;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class JhipsterUaaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerTokenKeyProvider();
    }

    private function registerTokenKeyProvider()
    {
        $this->app->bind(TokenKeyProvider::class, function (Application $app) {
            $config = $app->make(ConfigRepository::class)->get('jhipster_uaa');
            $httpClient = new GuzzleClient([
                'base_uri' => Arr::get($config, 'base_uri'),
                'timeout' => 0,
            ]);
            $innerProvider = new UaaTokenKeyProvider($httpClient);
            $cacheRepository = $app->make(CacheRepository::class);

            return new CacheableTokenKeyProvider($innerProvider, $cacheRepository);
        });
    }
}
