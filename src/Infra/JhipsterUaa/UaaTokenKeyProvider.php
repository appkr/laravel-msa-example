<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenKeyProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;

class UaaTokenKeyProvider implements TokenKeyProvider
{
    public static $TOKEN_KEY_PATH = '/oauth/token_key';

    private $httpClient;

    public function __construct(GuzzleClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getKey(): string
    {
        return $this->getTokenKey()->getKey()->getValue();
    }

    public function getTokenKey(): TokenKeyResponse
    {
        $request = new Request('GET', self::$TOKEN_KEY_PATH);
        $response = new Response();
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
        }

        return TokenKeyResponse::fromJsonString($response->getBody());
    }
}
