<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumRequest;
use App\Http\Requests\ListAlbumsRequest;
use Appkr\Service\AlbumService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
    private $service;

    public function __construct(AlbumService $service)
    {
        $this->service = $service;
    }

    public function createAlbum(CreateAlbumRequest $request)
    {
        $dto = $this->service->createAlbum($request->toDto());

        return new JsonResponse($dto);
    }

    public function listAlbums(ListAlbumsRequest $request)
    {
        return new JsonResponse($this->service->listAlbums($request->toDto()));
    }
    
    public function associateSong(int $albumId, int $songId)
    {
        $this->service->associateSong($albumId, $songId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    public function associateSinger(int $albumId, int $singerId)
    {
        $this->service->associateSinger($albumId, $singerId);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
