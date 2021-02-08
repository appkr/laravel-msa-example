<?php

namespace Appkr\Infra\JhipsterUaa;

class TokenKeyResponse
{
    private $alg;
    private $key;

    public function __construct(string $alg = null, TokenKey $key = null)
    {
        $this->alg = $alg;
        $this->key = $key;
    }


    public static function fromJsonString(string $jsonString): TokenKeyResponse
    {
        // {
        //   "alg": "SHA256withRSA",
        //   "value": "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlo/L8mU9Isiihp1ksxeOrJzPn4915xZC/pnbO+ur/ccZL23BYHP/wUxpWZy8Gh94+GK8/gcjVEk66acg4Gk7NH0uQGxdrq8WDMywPIAawekwiQJd6l/yVNXIDhuk0LzcgmU+1ESyeTNdlx84Z0X3HI6w8SH6OE4RBcr9rGfIt0ytXmHj1P4zxmJt/YhZyyyUq0WGuBq31UaQTOiJa0rp1kDKSMN0Hvz4UmkYtUvgtqUujrqNcWkSEummO8WyuhnCs+zAaF2KA5XSalEXFNiILwFPtQFxqIQrjjiWcI61vvTxtor4zI5r4X6aDteYIJidAzYwkIiuacnLWX5ziL3j+wIDAQAB\n-----END PUBLIC KEY-----"
        // }
        $decoded = json_decode($jsonString);

        $response = new static();
        $response->alg = $decoded->alg ?? null;
        $response->key = $decoded->value ? TokenKey::fromString($decoded->value) : null;

        return $response;
    }

    public function getAlg(): string
    {
        return $this->alg;
    }

    public function getKey(): TokenKey
    {
        return $this->key;
    }

    public function __toString(): string
    {
        return <<<EOT
TokenKeyResponse (
    alg={$this->alg}
    key={$this->key}
)
EOT;
    }
}
