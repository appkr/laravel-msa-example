<?php

namespace Tests\Infra;

use Appkr\Infra\TokenKeyProvider;
use Appkr\Infra\TokenParser;

class TokenParserTest extends \Tests\TestCase
{
    /** @var TokenParser */
    private $sut;

    /**
     * @when parse() is called
     * @then parsed token is returned
     */
    public function testParse()
    {
        $jwtString = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJ1c2VyIiwic2NvcGUiOlsib3BlbmlkIl0sImV4cCI6MTkyNzg1MDUwNywiaWF0IjoxNjEyNDkwNTA3LCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoidDFIU01waEVjT2RLSEFLa052VjZKb2pjcEVjIiwiY2xpZW50X2lkIjoid2ViX2FwcCJ9.dWWjgZvxggWqHepSGp0i-NXVsL7ZzUQXSYxUDxDHUl9zTtgc0KMVVGRJr41o8Gk7gc7ccHEaRuInyqir2f4-d2BUIbhFn98ZumcSvFBrHH0HTptah6waKXXr_5PtXT-bqwTcIhuJpXNNwNE9czLzd3BpKKgc8U0HlryUGjqfzFTyJpzIcxghlSYT5tzpRkbmKC9v8SgtuRL7epp-P-MWT-_WER-LCeYvGhrI9_GHRtZcbat0NMpWzVTEqMyn2KN6AEfAQZ9kaGReO-KcpiKqWC-iOS_0JBcS17QSJLDA-n4O5yrroa9s-ihbUaqnSmOjuyXFaoXAbtEqlchk5fuzPQ';

        echo $this->sut->parse($jwtString);
        // Token (
        //    userName=user
        //    scope=openid
        //    exp=2031-02-03T02:01:47+00:00
        //    iat=2021-02-05T02:01:47+00:00
        //    authorities=ROLE_USER
        //    jti=t1HSMphEcOdKHAKkNvV6JojcpEc
        //    clientId=web_app
        //)

        self::assertTrue(true);
    }

    /**
     * @before
     */
    public function setUp(): void
    {
        parent::setUp();
        $mock = \Mockery::mock(TokenKeyProvider::class);
        $mock->shouldReceive('getKey')->andReturn('-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlo/L8mU9Isiihp1ksxeO
rJzPn4915xZC/pnbO+ur/ccZL23BYHP/wUxpWZy8Gh94+GK8/gcjVEk66acg4Gk7
NH0uQGxdrq8WDMywPIAawekwiQJd6l/yVNXIDhuk0LzcgmU+1ESyeTNdlx84Z0X3
HI6w8SH6OE4RBcr9rGfIt0ytXmHj1P4zxmJt/YhZyyyUq0WGuBq31UaQTOiJa0rp
1kDKSMN0Hvz4UmkYtUvgtqUujrqNcWkSEummO8WyuhnCs+zAaF2KA5XSalEXFNiI
LwFPtQFxqIQrjjiWcI61vvTxtor4zI5r4X6aDteYIJidAzYwkIiuacnLWX5ziL3j
+wIDAQAB
-----END PUBLIC KEY-----');
        $this->sut = new TokenParser($mock);
    }
}
