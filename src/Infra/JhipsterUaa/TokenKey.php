<?php

namespace Appkr\Infra\JhipsterUaa;

class TokenKey
{
    private $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    public static function fromString(string $rawValue): TokenKey
    {
        $key = new static();

        $parts = preg_split('/\\n/', $rawValue);
        $parts[1] = self::formatKey($parts[1]);
        $key->value = implode(PHP_EOL, $parts);

        return $key;
    }

    public static function formatKey(string $keyString): string
    {
        // SPEC
        // -----BEGIN PUBLIC KEY-----
        // 64 bytes
        // next 64 bytes
        // ..
        // residual
        // -----END PUBLIC KEY-----
        $parts = []; $iter = 0; $offset = 0; $continue = true;
        while ($continue) {
            $part = substr($keyString, $offset, 64);
            if (strlen($part) < 64) {
                $continue = false;
            }
            $iter++;
            $offset = intval($iter * 64);

            $parts[] = $part;
        }

        return implode(PHP_EOL, $parts);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return <<<EOT
TokenKey (
    value={$this->value}
)
EOT;
    }
}
