<?php

namespace Appkr\Infra\ExternalApi;

use Appkr\Infra\TokenProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientExceptionInterface;

class ExternalApiClient
{
    private $httpClient;
    private $tokenProvider;

    public function __construct(GuzzleClient $httpClient, TokenProvider $tokenProvider)
    {
        $this->httpClient = $httpClient;
        $this->tokenProvider = $tokenProvider;
    }

    public function hello(): string
    {
        $request = new Request('GET', 'http://localhost:8080/hello', [
            'Authorization' => "bearer {$this->tokenProvider->getToken()}",
        ]);
        $response = new Response();
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
        }

        return $response->getBody();
    }
}
