<?php

namespace Appkr\Service;

use Appkr\Model\Album;
use Appkr\Model\Singer;
use Appkr\Model\Song;
use Appkr\Service\Dto\AlbumDto;
use Appkr\Service\Dto\AlbumList;
use Appkr\Service\Dto\AlbumSearchParam;
use Appkr\Service\Dto\Page;
use Appkr\Service\Exception\DuplicateNameException;
use Appkr\Service\Mapper\AlbumMapper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AlbumService
{
    private $mapper;

    public function __construct(AlbumMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createAlbum(AlbumDto $dto)
    {
        if ($this->findByTitle($dto->getTitle())->isNotEmpty()) {
            throw new DuplicateNameException("중복된 앨범입니다: '{$dto->getTitle()}'");
        }

        $entity = DB::transaction(function() use ($dto) {
            $entity = Album::from($dto);
            $entity->save();
            return $entity;
        });

        return $this->mapper->toDto($entity);
    }

    public function listAlbums(AlbumSearchParam $param)
    {
        /** @var Builder $builder */
        $builder = Album::query()->with(['songs', 'singer']);

        if ($param->getSingerName() != null) {
            $builder->leftJoin('singers', 'albums.singer_id', '=', 'singers.id')
                ->where('singers.name', 'like', '%'.$param->getSingerName().'%');
        }

        if ($param->getSongTitle() != null) {
            $builder->leftJoin('songs', 'albums.id', '=', 'songs.album_id')
                ->where('songs.title', 'like', '%'.$param->getSongTitle().'%');
        }

        if ($param->getAlbumTitle() != null) {
            $builder->where('albums.title', 'like', '%'.$param->getAlbumTitle().'%');
        }

        $paginator = $builder->paginate($param->getSize(), ['*'], 'page', $param->getPage());

        return new AlbumList($paginator->items(), Page::fromPaginator($paginator));
    }

    public function associateSong(int $albumId, int $songId)
    {
        /** @var Album $album */
        $album = Album::find($albumId);
        /** @var Song $song */
        $song = Song::find($songId);

        $album->songs()->save($song);
    }

    public function associateSinger(int $albumId, int $singerId)
    {
        /** @var Album $album */
        $album = Album::find($albumId);
        /** @var Singer $singer */
        $singer = Singer::find($singerId);

        $album->singer()->associate($singer);
        $album->save();
    }

    public function findByTitle(string $title)
    {
        return Album::query()->where('title', $title)->get();
    }
}
