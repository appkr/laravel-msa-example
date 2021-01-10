<?php

namespace Appkr\Service\Mapper;

use Appkr\Model\Example;
use Appkr\Service\Dto\ExampleDto;

class ExampleMapper
{
    public function toDto(Example $model): ExampleDto {
        $dto = new ExampleDto();
        $dto->setId($model->getKey());
        $dto->setTitle($model->title);
        $dto->setCreatedAt($model->created_at);
        $dto->setUpdatedAt($model->updated_at);
        $dto->setCreatedBy($model->created_by);
        $dto->setUpdatedBy($model->updated_by);
        return $dto;
    }
}
