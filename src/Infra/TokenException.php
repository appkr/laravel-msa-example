<?php

namespace Appkr\Infra;

use Throwable;

class TokenException extends \Exception
{
    protected $statusCode;

    public function __construct($message = "", $statusCode = 400, Throwable $previous = null)
    {
        $this->statusCode = $statusCode;
        parent::__construct($message, 0, $previous);
    }

    public static function tokenNotProvided(Throwable $previous = null)
    {
        return new static('Token was not provided', 400, $previous);
    }

    public static function invalidToken(Throwable $previous = null)
    {
        return new static('Provided JWT was invalid', 400, $previous);
    }

    public static function invalidSignature(Throwable  $previous = null)
    {
        return new static('Provided JWT was invalid because the signature verification failed', 500, $previous);
    }

    public static function beforeValid(Throwable  $previous = null)
    {
        return new static("Provided JWT is trying to be used before it's eligible as defined by 'nbf' OR Provided JWT is trying to be used before it's been created as defined by 'iat'", 400, $previous);
    }

    public static function expired(Throwable  $previous = null)
    {
        return new static("Provided JWT has since expired, as defined by the 'exp' claim", 400, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
