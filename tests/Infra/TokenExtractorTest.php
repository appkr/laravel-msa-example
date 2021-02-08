<?php

namespace Tests\Infra;

use Appkr\Infra\TokenExtractor;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class TokenExtractorTest extends TestCase
{
    /**
     * @given "Authorization: Bearer header.body.signature" as the http header
     * @then "header.body.signature" should be extracted
     */
    public function testExtract()
    {
        $actual = TokenExtractor::extract(
            new Request([], [], [], [], [], ['HTTP_AUTHORIZATION' => 'Bearer header.body.signature', ''])
        );

        self::assertEquals('header.body.signature', $actual);
    }
}
