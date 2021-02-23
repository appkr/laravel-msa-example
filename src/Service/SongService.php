<?php

namespace Appkr\Service;

use Appkr\Service\Mapper\SongMapper;

class SongService
{
    private $mapper;

    public function __construct(SongMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createSong(SongDto $dto)
    {
    }

    public function getSong(int $songId)
    {
    }
}
