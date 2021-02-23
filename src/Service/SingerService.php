<?php

namespace Appkr\Service;

use Appkr\Service\Dto\SingerDto;
use Appkr\Service\Mapper\SingerMapper;

class SingerService
{
    private $mapper;

    public function __construct(SingerMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createSinger(SingerDto $dto)
    {
    }
}
