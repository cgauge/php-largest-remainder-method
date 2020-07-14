<?php declare(strict_types=1);

namespace Tests\CustomerGauge\Math\Remainder;

use CustomerGauge\Math\Remainder\Remainder;
use PHPUnit\Framework\TestCase;

class RemainderTest extends TestCase
{
    public function test_basic_division()
    {
        $remainder = new Remainder([1, 0, 0]);

        $result = $remainder->round(4);

        self::assertEquals([1, 0, 0], $result);
    }

    public function test_division_with_two_numbers()
    {
        $remainder = new Remainder([1, 1, 0]);

        $result = $remainder->round(4);

        self::assertEquals([0.5, 0.5, 0], $result);
    }

    public function test_array_order_is_kept()
    {
        $remainder = new Remainder([0, 1, 1]);

        $result = $remainder->round(4);

        self::assertEquals([0, 0.5, 0.5], $result);
    }

    public function test_basic_remainder_decision()
    {
        $remainder = new Remainder([1, 1, 1]);

        $result = $remainder->round(4);

        self::assertSame([0.3334, 0.3333, 0.3333], $result);
    }

    public function test_irrational_numbers()
    {
        $remainder = new Remainder([4, 7, 8]);

        $result = $remainder->round(4);

        self::assertSame([
            0.2105, // 0.21052631578947368421052631578947
            0.3684, // 0.36842105263157894736842105263158
            0.4211 // 0.42105263157894736842105263157895
        ], $result);
    }

    public function test_null_values_will_always_return_null()
    {
        $remainder = new Remainder([null, null, null]);

        $result = $remainder->round(4);

        self::assertSame([null, null, null], $result);
    }

    public function test_null_will_not_receive_increment()
    {
        $remainder = new Remainder([null, 1, 1, 1]);

        $result = $remainder->round(4);

        self::assertSame([null, 0.3334, 0.3333, 0.3333], $result);
    }
}