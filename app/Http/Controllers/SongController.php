<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSongRequest;
use Appkr\Service\SongService;

class SongController extends Controller
{
    private $service;

    public function __construct(SongService $service)
    {
        $this->service = $service;
    }

    public function createSong(CreateSongRequest $request)
    {
    }

    public function getSong(int $songId)
    {
    }
}
