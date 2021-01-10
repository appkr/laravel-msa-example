<?php

namespace Appkr\Service\Dto;

use Illuminate\Pagination\LengthAwarePaginator;

class Page implements \JsonSerializable
{
    private $size;
    private $totalElements;
    private $totalPages;
    private $number;

    private function __construct(?int $size, int $totalElements, int $totalPages, int $number)
    {
        $this->size = $size;
        $this->totalElements = $totalElements;
        $this->totalPages = $totalPages;
        $this->number = $number;
    }

    public static function fromPaginator(LengthAwarePaginator $paginator): Page
    {
        return new static(
            $paginator->perPage(),
            $paginator->total(),
            $paginator->lastPage(),
            $paginator->currentPage()
        );
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    public function getTotalElements(): ?int
    {
        return $this->totalElements;
    }

    public function setTotalElements(?int $totalElements): void
    {
        $this->totalElements = $totalElements;
    }

    public function getTotalPages(): ?int
    {
        return $this->totalPages;
    }

    public function setTotalPages(?int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
