<?php

namespace Appkr\Service\Dto;

use Appkr\Model\Example;

class ExampleList implements \JsonSerializable
{
    /** @var Example[] */
    private $data;
    private $page;

    public function __construct(array $data, Page $page)
    {
        $this->data = $data;
        $this->page = $page;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getPage(): Page
    {
        return $this->page;
    }

    public function setPage(Page $page): void
    {
        $this->page = $page;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
