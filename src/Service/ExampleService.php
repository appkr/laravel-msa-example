<?php

namespace Appkr\Service;

use Appkr\Model\Example;
use Appkr\Service\Dto\ExampleDto;
use Appkr\Service\Dto\ExampleList;
use Appkr\Service\Dto\ExampleSearchParam;
use Appkr\Service\Dto\Page;
use Appkr\Service\Mapper\ExampleMapper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ExampleService
{
    private $mapper;

    public function __construct(ExampleMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function createExample(ExampleDto $dto): ExampleDto
    {
        $example = new Example();

        $title = $dto->getTitle();
        if ($title != null) {
            $now = Carbon::now();
            $user = Uuid::uuid4();
            $example->title = $title;
            $example->created_at = $now;
            $example->updated_at = $now;
            $example->created_by = $user;
            $example->updated_by = $user;
        }

        DB::transaction(function () use ($example) {
            return $example->save();
        });

        return $this->mapper->toDto($example);
    }

    public function listExamples(ExampleSearchParam $param): ExampleList
    {
        $paginator = Example::query()
            ->paginate($param->getSize(), ['*'], 'page', $param->getPage());

        return new ExampleList($paginator->items(), Page::fromPaginator($paginator));
    }
}
