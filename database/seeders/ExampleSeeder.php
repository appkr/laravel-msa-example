<?php

namespace Database\Seeders;

use Appkr\Model\Example;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        $userId = Uuid::uuid4();
        $now = Carbon::now();

        $model = new Example();
        $model->title = 'original title';
        $model->created_at = $now;
        $model->updated_at = $now;
        $model->created_by = $userId;
        $model->updated_by = $userId;
        $model->save();
    }
}
