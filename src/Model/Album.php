<?php

namespace Appkr\Model;

use Database\Factories\AlbumFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property Song[] $songs
 */
class Album extends Model
{
    use HasFactory;

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
