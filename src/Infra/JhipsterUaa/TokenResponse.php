<?php

namespace Appkr\Infra\JhipsterUaa;

use Appkr\Infra\Token;
use Carbon\Carbon;

class TokenResponse
{
    private $accessToken;
    private $tokenType;
    private $refreshToken;
    private $expiresIn;
    private $scope;
    private $iat;
    private $jti;

    public function __construct(
        Token $accessToken = null,
        string $tokenType = null,
        Token $refreshToken = null,
        Carbon $expiresIn = null,
        array $scope = null,
        Carbon $iat = null,
        string $jti = null
    ) {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->refreshToken = $refreshToken;
        $this->expiresIn = $expiresIn;
        $this->scope = $scope;
        $this->iat = $iat;
        $this->jti = $jti;
    }


    public static function fromJsonString(string $jsonString, string $publicKey): TokenResponse
    {
        $decoded = json_decode($jsonString);

        $response = new static();
        if (isset($decoded->access_token)) {
            $response->accessToken = Token::fromTokenString($decoded->access_token, $publicKey);
        }
        if (isset($decoded->refresh_token)) {
            $response->refreshToken = Token::fromTokenString($decoded->refresh_token, $publicKey);
        }
        $response->tokenType = $decoded->token_type;
        $response->expiresIn = Carbon::createFromTimestamp(intval($decoded->expires_in));
        $response->scope = preg_split('/,\s?/', $decoded->scope);
        $response->iat = Carbon::createFromTimestamp($decoded->iat);
        $response->jti = $decoded->jti;

        return $response;
    }

    public function getAccessToken(): Token
    {
        return $this->accessToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function getRefreshToken(): Token
    {
        return $this->refreshToken;
    }

    public function getExpiresIn(): Carbon
    {
        return $this->expiresIn;
    }

    public function getScope(): array
    {
        return $this->scope;
    }

    public function getIat(): Carbon
    {
        return $this->iat;
    }

    public function getJti(): string
    {
        return $this->jti;
    }

    public function __toString(): string
    {
        $scope = implode(',', $this->scope);
        return <<<EOT
TokenResponse (
    accessToken={$this->accessToken}
    tokenType={$this->tokenType}
    refreshToken={$this->refreshToken}
    expiresIn={$this->expiresIn}
    scope={$scope}
    iat={$this->iat->toIso8601String()}
    jti={$this->jti}
)
EOT;
    }
}
