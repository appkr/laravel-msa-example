<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\SongDto;

class CreateSongRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:100'
            ],
            'playTime' => [
                'required',
                // ISO8601 duration format
                // @see https://en.wikipedia.org/wiki/ISO_8601#Durations
                'regex:/^P(T(?=\d+[HMS])(\d+H)?(\d+M)?(\d+S)?)?$/i'
            ]
        ];
    }

    public function getDtoClass()
    {
        return new SongDto();
    }
}
