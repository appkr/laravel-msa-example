<?php

namespace Appkr\Infra;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class TokenParser
{
    private $tokenKeyProvider;

    public function __construct(TokenKeyProvider $tokenKeyProvider)
    {
        $this->tokenKeyProvider = $tokenKeyProvider;
    }

    public function parse(string $jwtString): Token
    {
        $token = new Token();
        try {
            $token = Token::fromTokenString($jwtString, $this->tokenKeyProvider->getKey());
        } catch (SignatureInvalidException $e) {
            throw TokenException::invalidSignature($e);
        } catch (BeforeValidException $e) {
            throw TokenException::beforeValid($e);
        } catch (ExpiredException $e) {
            throw TokenException::expired($e);
        } catch (UnexpectedValueException $e) {
            throw TokenException::invalidToken($e);
        }

        return $token;
    }
}
