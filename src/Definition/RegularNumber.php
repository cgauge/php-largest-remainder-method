<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder\Definition;

final class RegularNumber implements Number
{
    /**
     * Original array key that identifies the number's position. Useful to return
     * back an array in the exact same order that it was received.
     *
     * @var int|string
     */
    private $key;

    /**
     * Result of the division between $part and $total, multiplied by $precision.
     *
     * @var float|int
     */
    private $quotient;

    /**
     * $quotient rounded down, disregarding any decimal places.
     *
     * @var int
     */
    private $integer;

    /**
     * Final value after applying the Largest Remainder Method. It starts as $integer, but
     * can be incremented when deemed necessary.
     *
     * @var int
     */
    private $value;

    /**
     * All of the decimal places of quotient. It is the difference between $quotient - $integer.
     * It is used to determine which numbers receive an increment by sorting on largest
     * decimal places.
     *
     * @var float
     */
    private $decimal;

    /**
     * Amount of decimal places that will be taken into account before incrementing.
     *
     * @var int
     */
    private $precision;

    public function __construct($key, ?int $part, ?int $total, int $precision)
    {
        $this->key = $key;
        $this->quotient = ($part / $total) * $precision;
        $this->integer = (int) $this->quotient;
        $this->value = $this->integer;
        $this->decimal = $this->quotient - $this->integer;
        $this->precision = $precision;
    }

    public function integer(): int
    {
        return $this->integer;
    }

    public function value(): float
    {
        // Since the quotient was multiplied by the precision, we need to divide it back.
        return $this->value / $this->precision;
    }

    public function increment(): void
    {
        $this->value++;
    }

    public function decimal(): float
    {
        return $this->decimal;
    }
}
