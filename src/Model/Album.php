<?php

namespace Appkr\Model;

use Appkr\Service\Dto\AlbumDto;
use Database\Factories\AlbumFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Album
 * @package Appkr\Model
 *
 * @property integer $id
 * @property string $title
 * @property DateTime $published
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property UuidInterface $created_by
 * @property UuidInterface $updated_by
 * @property Singer $singer
 * @property Collection|Song[] $songs
 */
class Album extends Model
{
    use HasFactory;

    public static function from(AlbumDto $dto): Album
    {
        $entity = new static();
        $entity->title = $dto->getTitle();
        $entity->published = $dto->getPublished();
        $entity->created_by = $dto->getUpdatedBy();
        $entity->updated_by = $dto->getUpdatedBy();

        return $entity;
    }

    protected static function newFactory()
    {
        return AlbumFactory::new();
    }

    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
