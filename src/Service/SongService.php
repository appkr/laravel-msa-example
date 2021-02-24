<?php

namespace Appkr\Service;

use Appkr\Model\Song;
use Appkr\Service\Dto\SongDto;
use Appkr\Service\Exception\DuplicateNameException;
use Appkr\Service\Mapper\SongMapper;
use Illuminate\Support\Facades\DB;

class SongService
{
    private $mapper;

    public function __construct(SongMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createSong(SongDto $dto): SongDto
    {
        if ($this->findByTitle($dto->getTitle())->isNotEmpty()) {
            throw new DuplicateNameException("중복된 노래입니다: '{$dto->getTitle()}'");
        }

        return DB::transaction(function () use ($dto) {
            $entity = Song::from($dto);
            $entity->save();
            return $this->mapper->toDto($entity);
        });
    }

    public function getSong(int $songId): SongDto
    {
        $entity = Song::find($songId);

        return $this->mapper->toDto($entity);
    }

    public function findByTitle(string $title)
    {
        return Song::query()->where('title', $title)->get();
    }
}
