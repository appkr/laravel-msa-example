<?php

namespace Appkr\Service;

use Appkr\Service\Dto\AlbumDto;
use Appkr\Service\Mapper\AlbumMapper;

class AlbumService
{
    private $mapper;

    public function __construct(AlbumMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createAlbum(AlbumDto $dto)
    {
    }

    public function listAlbums(AlbumSearchParam $param)
    {
    }

    public function associateSong(int $albumId, int $songId)
    {
    }

    public function associateSinger(int $albumId, int $singerId)
    {
    }
}
