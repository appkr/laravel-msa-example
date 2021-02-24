<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSingerRequest;
use Appkr\Service\SingerService;
use Illuminate\Http\JsonResponse;

class SingerController extends Controller
{
    private $service;

    public function __construct(SingerService $service)
    {
        $this->service = $service;
    }

    public function createSinger(CreateSingerRequest $request)
    {
        $dto = $this->service->createSinger($request->toDto());

        return new JsonResponse($dto);
    }
}
