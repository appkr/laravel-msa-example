<?php

namespace Appkr\Model;

use Database\Factories\SongFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
