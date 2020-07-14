<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder\Definition;

final class NumberFactory
{

    public static function make($key, ?int $number, int $sum, int $precision)
    {
        if ($sum === 0 || $number === null) {
            return new NullNumber();
        }

        return new RegularNumber($key, $number, $sum, $precision);
    }
}
