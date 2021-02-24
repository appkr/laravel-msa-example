<?php

namespace Tests\Model;

use Appkr\Model\Song;
use Tests\TestCase;

class SongFactoryTest extends TestCase
{
    public function testCanMakeSong()
    {
        $song = Song::factory()->make();
        echo $song;
        self::assertTrue(true);
    }
}
