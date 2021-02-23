<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlbumRequest;
use App\Http\Requests\ListAlbumsRequest;
use Appkr\Service\AlbumService;

class AlbumController extends Controller
{
    private $service;

    public function __construct(AlbumService $service)
    {
        $this->service = $service;
    }

    public function createAlbum(CreateAlbumRequest $request)
    {
    }

    public function listAlbums(ListAlbumsRequest $request)
    {
    }
    
    public function associateSong(int $albumId, int $songId)
    {
    }

    public function associateSinger(int $albumId, int $singerId)
    {
    }
}
