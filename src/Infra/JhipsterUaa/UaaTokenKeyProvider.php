<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenKeyProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;
use Psr\Http\Client\ClientExceptionInterface;

class UaaTokenKeyProvider implements TokenKeyProvider
{
    private $httpClient;
    private $config;

    public function __construct(GuzzleClient $httpClient, array $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    public function getKey(): string
    {
        return $this->getTokenKey()->getKey()->getValue();
    }

    public function getTokenKey(): TokenKeyResponse
    {
        $request = new Request('GET', Arr::get($this->config, 'token_key_path'));
        $response = new Response();
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
        }

        return TokenKeyResponse::fromJsonString($response->getBody());
    }
}
