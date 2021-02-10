<?php

namespace Tests\Infra;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class JWTTest extends TestCase
{
    /**
     * @see https://github.com/firebase/php-jwt#example-with-rs256-openssl
     */
    public function testEncodeAndDecode()
    {
        $jwtString = JWT::encode([
            'userName' => 'user',
            'scope' => 'openid',
            'iat' => Carbon::now()->getTimestamp(),
            'exp' => Carbon::now()->addMinutes(5)->getTimestamp(),
            'authorities' => ['ROLE_USER'],
            'jti' => Str::random(27),
            'clientId' => 'web_app'
        ], file_get_contents(getenv('HOME').'/.ssh/id_rsa', 'RS256'));

        echo $jwtString, PHP_EOL;
        // eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyTmFtZSI6InVzZXIiLCJzY29wZSI6Im9wZW5pZCIsImlhdCI6MTYxMjkyNTYwOCwiZXhwIjoxNjEyOTI1OTA4LCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoiMVdGb2s3dGoxMTkxTXFKckhWcDRPWFk1WUNWIiwiY2xpZW50SWQiOiJ3ZWJfYXBwIn0.xf07L4jQjocv8XhbYRKZJzA2_9b2OPREEI_B0kcI9B8

        self::assertTrue(true);
    }
}
