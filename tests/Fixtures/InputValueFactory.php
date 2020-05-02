<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Fixtures;

use Ordermind\LogicGates\LogicGateInputValueInterface;

class InputValueFactory
{
    /**
     * Creates an input value object from a boolean value.
     */
    public function createFromNative(bool $value) : LogicGateInputValueInterface
    {
        if (true === $value) {
            return new InputValueTrue();
        }

        return new InputValueFalse();
    }
}
