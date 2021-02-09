<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\TokenKeyProvider;
use Appkr\Infra\TokenProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;
use Psr\Http\Client\ClientExceptionInterface;

class UaaTokenProvider implements TokenProvider
{
    public static $TOKEN_PATH = '/oauth/token';

    private $httpClient;
    private $config;
    private $tokenKeyProvider;

    public function __construct(GuzzleClient $httpClient, array $config, TokenKeyProvider $tokenKeyProvider)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
        $this->tokenKeyProvider = $tokenKeyProvider;
    }

    public function getToken(): string
    {
        return $this->getTokenResponse()->getAccessToken()->getTokenString();
    }

    public function getTokenResponse(): TokenResponse
    {
        $request = new Request('POST', self::$TOKEN_PATH, [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "basic {$this->getBasicAuthHeader()}"
        ], Query::build([
            'grant_type' => 'client_credentials',
        ]));
        $response = new Response();
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
        }

        return TokenResponse::fromJsonString($response->getBody(), $this->tokenKeyProvider->getKey());
    }

    private function getBasicAuthHeader(): string
    {
        $clientId = Arr::get($this->config, 'client_id');
        $clientSecret = Arr::get($this->config, 'client_secret');
        return base64_encode("{$clientId}:{$clientSecret}");
    }
}
