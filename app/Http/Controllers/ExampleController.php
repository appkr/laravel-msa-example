<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExampleRequest;
use App\Http\Requests\ListExampleRequest;
use Appkr\Service\ExampleService;
use Illuminate\Http\JsonResponse;

class ExampleController extends Controller
{
    private $service;

    public function __construct(ExampleService $exampleService)
    {
        $this->service = $exampleService;
    }

    public function createExample(CreateExampleRequest $request): JsonResponse
    {
        $dto = $this->service->createExample($request->toDto());

        return new JsonResponse($dto);
    }

    public function listExamples(ListExampleRequest $request): JsonResponse
    {
        return new JsonResponse($this->service->listExamples($request->toDto()));
    }
}
