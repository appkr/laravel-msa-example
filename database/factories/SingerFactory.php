<?php

namespace Database\Factories;

use Appkr\Model\Singer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class SingerFactory extends Factory
{
    protected $model = Singer::class;

    public function definition()
    {
        return [
            'name' => '이문세',
            'created_by' => Uuid::NIL,
            'updated_by' => Uuid::NIL,
        ];
    }
}
