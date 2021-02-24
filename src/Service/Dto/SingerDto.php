<?php

namespace Appkr\Service\Dto;

use DateTime;
use Ramsey\Uuid\UuidInterface;

class SingerDto implements \JsonSerializable
{
    private $id;
    private $name;
    private $createdAt;
    private $updatedAt;
    private $createdBy;
    private $updatedBy;

    public function __construct(
        int $id = null,
        string $name = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null,
        UuidInterface $createdBy = null,
        UuidInterface $updatedBy = null
    ) {
        $this->id = $id;
        $this->name = $name;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName(?string $name)
    {
        $this->name = $name;
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

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
