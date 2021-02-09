<?php

namespace App\Providers;

use Appkr\Infra\JhipsterUaa\CacheableTokenKeyProvider;
use Appkr\Infra\JhipsterUaa\CacheableTokenProvider;
use Appkr\Infra\JhipsterUaa\UaaTokenKeyProvider;
use Appkr\Infra\JhipsterUaa\UaaTokenProvider;
use Appkr\Infra\TokenKeyProvider;
use Appkr\Infra\TokenParser;
use Appkr\Infra\TokenProvider;
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
        $this->registerTokenParser();
        $this->registerTokenProvider();
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

    private function registerTokenParser()
    {
        $this->app->bind(TokenParser::class, function (Application $app) {
            return new TokenParser($app->make(TokenKeyProvider::class));
        });
    }

    private function registerTokenProvider()
    {
        $this->app->bind(TokenProvider::class, function (Application $app) {
            $config = $app->make(ConfigRepository::class)->get('jhipster_uaa');
            $httpClient = new GuzzleClient([
                'base_uri' => Arr::get($config, 'base_uri'),
                'timeout' => 0,
            ]);
            $tokenKeyProvider = $app->make(TokenKeyProvider::class);
            $innerProvider = new UaaTokenProvider($httpClient, $config, $tokenKeyProvider);
            $cacheRepository = $app->make(CacheRepository::class);


            return new CacheableTokenProvider($innerProvider, $cacheRepository);
        });
    }
}
