<?php

namespace Appkr\Infra;

use Carbon\Carbon;
use Firebase\JWT\JWT;

class Token
{
    private $tokenString;
    private $userName;
    private $scope;
    private $exp;
    private $iat;
    private $authorities;
    private $jti;
    private $clientId;

    public function __construct(
        string $userName = null,
        array $scope = null,
        Carbon $exp = null,
        Carbon $iat = null,
        array $authorities = null,
        string $jti = null,
        string $clientId = null
    ) {
        $this->userName = $userName;
        $this->scope = $scope;
        $this->exp = $exp;
        $this->iat = $iat;
        $this->authorities = $authorities;
        $this->jti = $jti;
        $this->clientId = $clientId;
    }

    /**
     * @param string $tokenString
     * @param string $publicKey
     * @throws \Firebase\JWT\UnexpectedValueException     Provided JWT was invalid
     * @throws \Firebase\JWT\SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws \Firebase\JWT\BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws \Firebase\JWT\BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
     * @throws \Firebase\JWT\ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     * @return Token
     */
    public static function fromTokenString(string $tokenString, string $publicKey): Token
    {
        $decoded = JWT::decode($tokenString, $publicKey, ['RS256']);

        $token = new static();
        $token->tokenString = $tokenString;
        $token->userName = $decoded->user_name ?? null;
        $token->scope = $decoded->scope ?? [];
        $token->exp = Carbon::createFromTimestamp($decoded->exp ?? null);
        $token->iat = Carbon::createFromTimestamp($decoded->iat ?? null);
        $token->authorities = $decoded->authorities ?? [];
        $token->jti = $decoded->jti ?? null;
        $token->clientId = $decoded->client_id ?? null;

        return $token;
    }

    public function getTokenString()
    {
        return $this->tokenString;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getScope(): ?array
    {
        return $this->scope;
    }

    public function getExp(): ?Carbon
    {
        return $this->exp;
    }

    public function getIat(): ?Carbon
    {
        return $this->iat;
    }

    public function getAuthorities(): ?array
    {
        return $this->authorities;
    }

    public function getJti(): ?string
    {
        return $this->jti;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function __toString(): string
    {
        $scope = implode(',', $this->scope);
        $authorities = implode(',', $this->authorities);
        return <<<EOT
Token (
    userName={$this->userName}
    scope={$scope}
    exp={$this->exp->toIso8601String()}
    iat={$this->iat->toIso8601String()}
    authorities={$authorities}
    jti={$this->jti}
    clientId={$this->clientId}
)
EOT;
    }
}
