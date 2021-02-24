<?php

namespace Appkr\Service\Mapper;

use Appkr\Model\Song;
use Appkr\Service\Dto\SongDto;
use Illuminate\Support\Collection;

class SongMapper
{
    public function toDto(Song $entity): SongDto
    {
        return new SongDto(
            $entity->id,
            $entity->title,
            $entity->play_time,
            $entity->created_at,
            $entity->updated_at,
            $entity->created_by,
            $entity->updated_by
        );
    }

    public function toDtos(Collection $songs)
    {
        return $songs->map(function ($song) {
            return $this->toDto($song);
        });
    }
}
