<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder;

use CustomerGauge\Math\Remainder\Definition\NumberFactory;

final class Remainder
{
    private $numbers;

    private $sum;

    private $accumulatedSumWithoutDecimals = 0;

    public function __construct(array $numbers)
    {
        $this->numbers = $numbers;
        $this->sum = array_sum($numbers);
    }

    public function round(int $precision): array
    {
        $precision = pow(10, $precision);

        $numbers = [];
        $decimals = [];

        foreach ($this->numbers as $key => $number) {
            $numberObject = NumberFactory::make($key, $number, $this->sum, $precision);

            $numbers[$key] = $numberObject;

            $decimals[] = new Decimal($key, $numberObject->decimal());

            $this->accumulatedSumWithoutDecimals += $numberObject->integer();
        }

        usort($decimals, function (Decimal $a, Decimal $b) {
            if ($b->value() > $a->value()) {
                return 1;
            }

            // If both values are equal, let's try to preserve the exact same order of their original keys.
            if ($a->value() == $b->value()) {
                return 0;
            }

            return -1;
        });

        if ($this->accumulatedSumWithoutDecimals) {
            $remaining = $precision - $this->accumulatedSumWithoutDecimals;
        } else {
            $remaining = 0;
        }

        for ($i = 0; $i < $remaining; $i++) {
            $key = $decimals[$i]->key();

            $numbers[$key]->increment();
        }

        $result = [];

        foreach ($numbers as $key => $number) {
            $result[$key] = $number->value();
        }

        return $result;
    }
}
