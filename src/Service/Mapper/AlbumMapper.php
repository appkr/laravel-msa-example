<?php

namespace Appkr\Service\Mapper;

use Appkr\Model\Album;
use Appkr\Service\Dto\AlbumDto;

class AlbumMapper
{
    private $singerMapper;
    private $songMapper;

    public function __construct(SingerMapper $singerMapper, SongMapper $songMapper)
    {
        $this->singerMapper = $singerMapper;
        $this->songMapper = $songMapper;
    }

    public function toDto(Album $entity)
    {
        $dto = new AlbumDto(
            $entity->id,
            $entity->title,
            $entity->published,
            $entity->created_at,
            $entity->updated_at,
            $entity->created_by,
            $entity->updated_by
        );

        if ($entity->singer != null) {
            $dto->setSinger($this->singerMapper->toDto($entity->singer));
        }

        if ($entity->songs->isNotEmpty()) {
            $dto->setSongs($this->songMapper->toDtos($entity->songs));
        }

        return $dto;
    }
}
