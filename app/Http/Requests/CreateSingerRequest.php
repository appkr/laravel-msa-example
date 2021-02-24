<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\SingerDto;

class CreateSingerRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'max:100',
            ]
        ];
    }

    public function getDtoClass()
    {
        return new SingerDto();
    }
}
