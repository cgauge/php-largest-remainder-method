<?php

namespace CustomerGauge\Math\Remainder\Definition;

interface Number
{
    public function integer(): ?int;

    public function value(): ?float;

    public function increment(): void;

    public function decimal(): ?float;
}