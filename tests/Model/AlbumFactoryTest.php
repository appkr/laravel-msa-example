<?php

namespace Tests\Model;

use Appkr\Model\Album;
use Tests\TestCase;

class AlbumFactoryTest extends TestCase
{
    public function testCanMakeAlbum()
    {
        $album = Album::factory()->make();
        echo $album;
        self::assertTrue(true);
    }
}
