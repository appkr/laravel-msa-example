<?php

namespace Appkr\Model;

use Appkr\Service\Dto\SongDto;
use Database\Factories\SongFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Song
 * @package Appkr\Model
 *
 * @property integer $id
 * @property string $title
 * @property string $play_time
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property UuidInterface $created_by
 * @property UuidInterface $updated_by
 * @property Album $album
 * @property Singer $singer
 */
class Song extends Model
{
    use HasFactory;

    public static function from(SongDto $dto): Song
    {
        $entity = new static();
        $entity->title = $dto->getTitle();
        $entity->play_time = $dto->getPlayTime();
        $entity->created_by = $dto->getUpdatedBy();
        $entity->updated_by = $dto->getUpdatedBy();

        return $entity;
    }

    protected static function newFactory()
    {
        return SongFactory::new();
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }

    public function getCreatedByAttribute(string $value)
    {
        return Uuid::fromString($value);
    }

    public function getUpdatedByAttribute(string $value)
    {
        return Uuid::fromString($value);
    }
}
