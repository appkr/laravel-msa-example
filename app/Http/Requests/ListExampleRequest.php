<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\ExampleSearchParam;

class ListExampleRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
        ];
    }

    public function getDtoClass()
    {
        return new ExampleSearchParam();
    }
}
