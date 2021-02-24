<?php

namespace Appkr\Model;

use Database\Factories\SingerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Singer
 * @package Appkr\Model
 *
 * @property integer $id
 * @property string name
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property UuidInterface $created_by
 * @property UuidInterface $updated_by
 * @property Song[] $songs
 * @property Album[] $albums
 */
class Singer extends Model
{
    use HasFactory;

    public static function from(\Appkr\Service\Dto\SingerDto $dto)
    {
        $entity = new static();
        $entity->name = $dto->getName();
        $entity->created_by = $dto->getUpdatedBy();
        $entity->updated_by = $dto->getUpdatedBy();

        return $entity;
    }

    protected static function newFactory()
    {
        return SingerFactory::new();
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
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
