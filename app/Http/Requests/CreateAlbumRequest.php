<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\AlbumDto;

class CreateAlbumRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:100',
            ],
            'published' => [
                'required',
                'date'
            ]
        ];
    }

    public function getDtoClass()
    {
        return new AlbumDto();
    }
}
