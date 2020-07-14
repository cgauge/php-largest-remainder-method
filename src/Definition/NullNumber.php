<?php declare(strict_types=1);

namespace CustomerGauge\Math\Remainder\Definition;

use LogicException;

final class NullNumber implements Number
{
    public function integer(): ?int
    {
        return null;
    }

    public function value(): ?float
    {
        return null;
    }

    public function increment(): void
    {
        throw new LogicException("A Null Value cannot be incremented.");
    }

    public function decimal(): ?float
    {
        return null;
    }
}
