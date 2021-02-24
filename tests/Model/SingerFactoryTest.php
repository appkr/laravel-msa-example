<?php

namespace Tests\Model;

use Appkr\Model\Singer;
use Tests\TestCase;

class SingerFactoryTest extends TestCase
{
    public function testCanMakeSinger()
    {
        $singer = Singer::factory()->make();
        echo $singer;
        self::assertTrue(true);
    }
}
