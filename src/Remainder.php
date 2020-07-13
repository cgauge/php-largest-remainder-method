<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder;

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
            $numberObject = new Number($key, $number, $this->sum, $precision);

            $numbers[$key] = $numberObject;

            $decimals[] = new Decimal($key, $numberObject->decimal());

            $this->accumulatedSumWithoutDecimals += $numberObject->integer();
        }

        usort($decimals, function (Decimal $a, Decimal $b) {
            return $b->value() <=> $a->value();
        });

        $remaining = $precision - $this->accumulatedSumWithoutDecimals;

        for ($i = 0; $i < $remaining; $i++) {
            $key = $decimals[$i]->key();

            $numbers[$key]->increase();
        }

        $result = [];

        foreach ($numbers as $key => $number) {
            $result[$key] = $number->integer() / $precision;
        }

        return $result;
    }
}
