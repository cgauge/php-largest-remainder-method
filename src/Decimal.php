<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder;

final class Decimal
{
    private $key;

    private $decimal;

    public function __construct($key, float $decimal)
    {
        $this->key = $key;
        $this->decimal = $decimal;
    }

    public function key()
    {
        return $this->key;
    }

    public function value(): float
    {
        return $this->decimal;
    }
}
