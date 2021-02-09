<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenProvider;
use Illuminate\Contracts\Cache\Repository;

class CacheableTokenProvider implements TokenProvider
{
    public static $CACHE_KEY = 'jhipster_uaa.token';
    public static $CACHE_TTL_SECONDS = 60 * 60 * 24 * 7; // 7일

    private $delegate;
    private $cacheRepository;

    public function __construct(TokenProvider $delegate, Repository $cacheRepository)
    {
        $this->delegate = $delegate;
        $this->cacheRepository = $cacheRepository;
    }

    public function getToken(): string
    {
        return $this->getTokenResponse()->getAccessToken()->getTokenString();
    }

    public function getTokenResponse(): TokenResponse
    {
        $self = $this;
        return $this->cacheRepository->remember(self::$CACHE_KEY, self::$CACHE_TTL_SECONDS, function () use ($self) {
            return $self->delegate->getTokenResponse();
        });
    }
}
