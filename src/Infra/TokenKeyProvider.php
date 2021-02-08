<?php

namespace Appkr\Infra;

interface TokenKeyProvider
{
    public function getKey(): string;
}
