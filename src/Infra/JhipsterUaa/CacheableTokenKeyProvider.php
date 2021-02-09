<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenKeyProvider;
use Illuminate\Contracts\Cache\Repository;

class CacheableTokenKeyProvider implements TokenKeyProvider
{
    const CACHE_KEY = 'jhipster_uaa.token_key';
    const CACHE_TTL_SECONDS = 60 * 60 * 24; // 24시간

    private $delegate;
    private $cacheRepository;

    public function __construct(TokenKeyProvider $delegate, Repository $cacheRepository)
    {
        $this->delegate = $delegate;
        $this->cacheRepository = $cacheRepository;
    }

    public function getKey(): string
    {
        return $this->getTokenKey()->getKey()->getValue();
    }

    public function getTokenKey(): TokenKeyResponse
    {
        $self = $this;
        return $this->cacheRepository->remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function () use ($self) {
            return $self->delegate->getTokenKey();
        });
    }
}
