<?php

namespace Appkr\Service\Mapper;

use Appkr\Model\Singer;
use Appkr\Service\Dto\SingerDto;

class SingerMapper
{
    public function toDto(Singer $entity)
    {
        return new SingerDto(
            $entity->id,
            $entity->name,
            $entity->created_at,
            $entity->updated_at,
            $entity->created_by,
            $entity->updated_by
        );
    }
}
