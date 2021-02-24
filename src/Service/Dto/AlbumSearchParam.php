<?php

namespace Appkr\Service\Dto;

class AlbumSearchParam
{
    private $albumTitle;
    private $singerName;
    private $songTitle;
    private $page;
    private $size;

    public function __construct(
        $albumTitle = null,
        $singerName = null,
        $songTitle = null,
        $page = 1,
        $size = 10
    ) {
        $this->albumTitle = $albumTitle;
        $this->singerName = $singerName;
        $this->songTitle = $songTitle;
        $this->page = $page;
        $this->size = $size;
    }

    public function getAlbumTitle()
    {
        return $this->albumTitle;
    }

    public function setAlbumTitle($albumTitle)
    {
        $this->albumTitle = $albumTitle;
    }

    public function getSingerName()
    {
        return $this->singerName;
    }

    public function setSingerName($singerName)
    {
        $this->singerName = $singerName;
    }

    public function getSongTitle()
    {
        return $this->songTitle;
    }

    public function setSongTitle($songTitle)
    {
        $this->songTitle = $songTitle;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
}
