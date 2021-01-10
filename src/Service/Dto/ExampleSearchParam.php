<?php

namespace Appkr\Service\Dto;

class ExampleSearchParam
{
    private $page;
    private $size;

    public function __construct(int $page = 1, int $size = 10)
    {
        $this->page = $page;
        $this->size = $size;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }
}
