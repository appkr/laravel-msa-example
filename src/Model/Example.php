<?php

namespace Appkr\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Example
 * @package App\Models
 * @property integer $id
 * @property string $title
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property UuidInterface $created_by
 * @property UuidInterface $updated_by
 */
class Example extends Model
{
    use HasFactory;
}
