<?php

namespace Database\Factories;

use Appkr\Model\Song;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class SongFactory extends Factory
{
    protected $model = Song::class;

    public function definition()
    {
        return [
            'title' => '시를 위한 시',
            'play_time' => '04:00',
            'created_by' => Uuid::NIL,
            'updated_by' => Uuid::NIL,
        ];
    }
}
