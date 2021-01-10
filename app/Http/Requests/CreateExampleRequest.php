<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\ExampleDto;

class CreateExampleRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getDtoClass()
    {
        return new ExampleDto();
    }
}
