<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Repository;

class CacheableTokenProvider implements TokenProvider
{
    const CACHE_KEY = 'oauth2.token';
    const REFRESH_GRACE_PERIOD = 30; // 30초

    private $delegate;
    private $cacheRepository;

    public function __construct(TokenProvider $delegate, Repository $cacheRepository)
    {
        $this->delegate = $delegate;
        $this->cacheRepository = $cacheRepository;
    }

    public function getToken(): string
    {
//        if ($this->isTokenExpired()) {
//            $this->refresh();
//        }

        return $this->getTokenResponse()->getAccessToken()->getTokenString();
    }

    public function getTokenResponse(): TokenResponse
    {
        $self = $this;
        return $this->cacheRepository->rememberForever(self::CACHE_KEY, function () use ($self) {
            return $self->delegate->getTokenResponse();
        });
    }

//    NOTE. A token acquired from ClientCredentials cannot be refreshed
//    public function refresh(): TokenResponse
//    {
//        $self = $this;
//        return $this->cacheRepository->rememberForever(self::CACHE_KEY, function () use ($self) {
//            return $self->delegate->refresh();
//        });
//    }
//
//    private function isTokenExpired(): bool
//    {
//        return Carbon::now()->lte($this->getTokenResponse()->getExpiresIn()->subSeconds(self::REFRESH_GRACE_PERIOD));
//    }
}
