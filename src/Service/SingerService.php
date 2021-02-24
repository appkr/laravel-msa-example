<?php

namespace Appkr\Service;

use Appkr\Model\Singer;
use Appkr\Service\Dto\SingerDto;
use Appkr\Service\Exception\DuplicateNameException;
use Appkr\Service\Mapper\SingerMapper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SingerService
{
    private $mapper;

    public function __construct(SingerMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createSinger(SingerDto $dto): SingerDto
    {
        if ($this->findByName($dto->getName())->isNotEmpty()) {
            throw new DuplicateNameException("중복된 이름입니다: '{$dto->getName()}'");
        }

        return DB::transaction(function() use ($dto){
            $entity = Singer::from($dto);
            $entity->save();
            return $this->mapper->toDto($entity);
        });

    }

    public function findByName(string $name): Collection
    {
        return Singer::query()->where('name', $name)->get();
    }
}
