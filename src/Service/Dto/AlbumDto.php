<?php

namespace Appkr\Service\Dto;

use Appkr\Model\Singer;
use Appkr\Model\Song;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Ramsey\Uuid\UuidInterface;

class AlbumDto implements \JsonSerializable
{
    private $id;
    private $title;
    private $published;
    private $createdAt;
    private $updatedAt;
    private $createdBy;
    private $updatedBy;

    private $singer;
    private $songs;

    public function __construct(
        int $id = null,
        string $title = null,
        DateTime $published = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null,
        UuidInterface $createdBy = null,
        UuidInterface $updatedBy = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->published = $published;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished(?DateTime $published)
    {
        $this->published = $published;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?UuidInterface $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?UuidInterface $updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    public function getSinger(): Singer
    {
        return $this->singer;
    }

    public function setSinger(Singer $singer)
    {
        $this->singer = $singer;
    }

    /**
     * @return Collection|Song[]
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function setSongs(Collection $songs)
    {
        $this->songs = $songs;
    }

    public function jsonSerialize(): array
    {
        $serialized = get_object_vars($this);
        // [WORKAROUND] to avoid serialized as an object
        $serialized['published'] = Carbon::make($serialized['published']);

        return $serialized;
    }
}
