<?php

namespace Database\Factories;

use Appkr\Model\Album;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class AlbumFactory extends Factory
{
    protected $model = Album::class;

    public function definition()
    {
        return [
            'title' => '이문세 5집',
            'published' => Carbon::parse('1988-09-15T00:00:00+09:00'),
            'created_by' => Uuid::NIL,
            'updated_by' => Uuid::NIL,
        ];
    }
}
