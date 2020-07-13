<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder;

final class Number
{
    private $key;

    private $quotient;

    private $integer;

    private $decimal;

    private $precision;

    public function __construct($key, int $part, int $total, int $precision)
    {
        $this->key = $key;
        $this->quotient = ($part / $total) * $precision;
        $this->integer = (int) $this->quotient;
        $this->decimal = $this->quotient - $this->integer;
        $this->precision = $precision;
    }

    public function integer(): int
    {
        return $this->integer;
    }

    public function increase(): void
    {
        $this->integer++;
    }

    public function decimal(): float
    {
        return $this->decimal;
    }
}
