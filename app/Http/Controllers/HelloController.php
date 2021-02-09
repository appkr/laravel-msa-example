<?php

namespace App\Http\Controllers;

use Appkr\Infra\ExternalApi\HelloApiClient;
use Illuminate\Http\JsonResponse;

class HelloController extends Controller
{
    private $helloApiClient;

    public function __construct(HelloApiClient $helloApiClient)
    {
        $this->helloApiClient = $helloApiClient;
    }

    public function hello(): JsonResponse
    {
        return new JsonResponse($this->helloApiClient->hello());
    }
}
