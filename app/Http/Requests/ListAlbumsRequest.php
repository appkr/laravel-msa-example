<?php

namespace App\Http\Requests;

use Appkr\Service\Dto\AlbumSearchParam;

class ListAlbumsRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'albumTitle' => [],
            'songTitle' => [],
            'singerName' => [],
            'page' => [],
            'size' => [],
        ];
    }

    public function getDtoClass()
    {
        return new AlbumSearchParam();
    }
}
