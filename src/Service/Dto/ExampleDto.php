<?php

namespace Appkr\Service\Dto;

use Ramsey\Uuid\UuidInterface;

class ExampleDto implements \JsonSerializable
{
    private $id;
    private $title;
    private $createdAt;
    private $updatedAt;
    private $createdBy;
    private $updatedBy;

    public function __construct(
        int $id = null,
        string $title = null,
        \DateTime $createdAt = null,
        \DateTime $updatedAt = null,
        UuidInterface $createdBy = null,
        UuidInterface $updatedBy = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedBy(): ?UuidInterface
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?UuidInterface $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getUpdatedBy(): ?UuidInterface
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?UuidInterface $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
