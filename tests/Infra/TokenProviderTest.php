<?php

namespace Tests\Infra;

use Appkr\Infra\JhipsterUaa\UaaTokenKeyProvider;
use Appkr\Infra\JhipsterUaa\UaaTokenProvider;
use Appkr\Infra\TokenProvider;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class TokenProviderTest extends TestCase
{
    private $sut;

    /**
     * @before
     */
    public function setUp(): void
    {
        $mockHandler1 = new MockHandler([
            // password grant로 얻은 유효 기간 10년짜리 테스트 토큰
            new Response(200, [], '{"access_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJ1c2VyIiwic2NvcGUiOlsib3BlbmlkIl0sImV4cCI6MTkyNzg1MDUwNywiaWF0IjoxNjEyNDkwNTA3LCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoidDFIU01waEVjT2RLSEFLa052VjZKb2pjcEVjIiwiY2xpZW50X2lkIjoid2ViX2FwcCJ9.dWWjgZvxggWqHepSGp0i-NXVsL7ZzUQXSYxUDxDHUl9zTtgc0KMVVGRJr41o8Gk7gc7ccHEaRuInyqir2f4-d2BUIbhFn98ZumcSvFBrHH0HTptah6waKXXr_5PtXT-bqwTcIhuJpXNNwNE9czLzd3BpKKgc8U0HlryUGjqfzFTyJpzIcxghlSYT5tzpRkbmKC9v8SgtuRL7epp-P-MWT-_WER-LCeYvGhrI9_GHRtZcbat0NMpWzVTEqMyn2KN6AEfAQZ9kaGReO-KcpiKqWC-iOS_0JBcS17QSJLDA-n4O5yrroa9s-ihbUaqnSmOjuyXFaoXAbtEqlchk5fuzPQ", "token_type": "bearer", "refresh_token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX25hbWUiOiJ1c2VyIiwic2NvcGUiOlsib3BlbmlkIl0sImF0aSI6InQxSFNNcGhFY09kS0hBS2tOdlY2Sm9qY3BFYyIsImV4cCI6MTkyNzg1MDUwNywiaWF0IjoxNjEyNDkwNTA3LCJhdXRob3JpdGllcyI6WyJST0xFX1VTRVIiXSwianRpIjoiNGdZNGxrUThhVmI0QlNyMTd3RUxIYTNwNXdzIiwiY2xpZW50X2lkIjoid2ViX2FwcCJ9.JgRQI9J2lUJA6Boh5ruXwke_oIEQrrJK-8frNR-GFqno2TudlPrnb_iUOyqiy21YwCmAJ2Me36K957Wp-duRDJtgyRxGrZkKlIFXswjz-nTVJmhLbpTAbnC6g7GLFlW6-o4N6h2l-7fWU9MQzDv_lhcUtDWOH7vygcBTK9-fz_D4f-yx4eUWB5_3IiBEaQWfpK8RF2tBAwR0btz9Bcc7r4HpfXg4txnd-9lBKnRQGSeZy5wVwrdn1HeZzEoY0w__WByBiIhBS4zkT-VqiQhevKld3_Re4AKyrJNA5Ai0qTRZkAFLUs5FN9Ets6shaBpec-AcjGnWvEOLqWA_eMXhMA", "expires_in": 315359999, "scope": "openid", "iat": 1612490507, "jti": "t1HSMphEcOdKHAKkNvV6JojcpEc"}'),
        ]);
        $handlerStack1 = HandlerStack::create($mockHandler1);
        $client1 = new GuzzleClient(['handler' => $handlerStack1]);

        $mockHandler2 = new MockHandler([
            new Response(200, [], '{ "alg": "SHA256withRSA", "value": "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlo/L8mU9Isiihp1ksxeOrJzPn4915xZC/pnbO+ur/ccZL23BYHP/wUxpWZy8Gh94+GK8/gcjVEk66acg4Gk7NH0uQGxdrq8WDMywPIAawekwiQJd6l/yVNXIDhuk0LzcgmU+1ESyeTNdlx84Z0X3HI6w8SH6OE4RBcr9rGfIt0ytXmHj1P4zxmJt/YhZyyyUq0WGuBq31UaQTOiJa0rp1kDKSMN0Hvz4UmkYtUvgtqUujrqNcWkSEummO8WyuhnCs+zAaF2KA5XSalEXFNiILwFPtQFxqIQrjjiWcI61vvTxtor4zI5r4X6aDteYIJidAzYwkIiuacnLWX5ziL3j+wIDAQAB\n-----END PUBLIC KEY-----" }'),
        ]);
        $handlerStack2 = HandlerStack::create($mockHandler2);
        $client2 = new GuzzleClient(['handler' => $handlerStack2]);
        $mockTokenKeyProvider = new UaaTokenKeyProvider($client2);

        $this->sut = new UaaTokenProvider($client1, ['client_id' => '', 'client_secret' => ''], $mockTokenKeyProvider);
    }

    public function testGetToken(): void
    {
        $tokenResponse = $this->sut->getTokenResponse();
        echo $tokenResponse, PHP_EOL;
        echo $tokenResponse->getAccessToken()->getTokenString(), PHP_EOL;
        self::assertTrue(true);
    }
}
