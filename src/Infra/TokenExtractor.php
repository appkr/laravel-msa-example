<?php

namespace Appkr\Infra;

use Illuminate\Http\Request;

class TokenExtractor
{
    public static function extract(Request $request): ?string
    {
        if (!$request->hasHeader('authorization')) {
            return null;
        }

        $authHeader = $request->header('authorization');
        $jwtString = preg_replace('/bearer\s/i', '', $authHeader);

        return $jwtString;
    }
}
