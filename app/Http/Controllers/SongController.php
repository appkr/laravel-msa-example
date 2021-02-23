<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSongRequest;
use Appkr\Service\SongService;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    private $service;

    public function __construct(SongService $service)
    {
        $this->service = $service;
    }

    public function createSong(CreateSongRequest $request)
    {
        $dto = $this->service->createSong($request->toDto());

        return new JsonResponse($dto);
    }

    public function getSong(int $songId)
    {
        return $this->service->getSong($songId);
    }
}
