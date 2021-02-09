<?php

namespace Appkr\Infra;

use Appkr\Infra\JhipsterUaa\TokenResponse;

interface TokenProvider
{
    public function getToken(): string;
    public function getTokenResponse(): TokenResponse;
//    NOTE. A token acquired from ClientCredentials cannot be refreshed
//    public function refresh(): TokenResponse;
}
