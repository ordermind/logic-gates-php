<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Fixtures;

use Ordermind\LogicGates\LogicGateInputValueInterface;

class InputValueTrue implements LogicGateInputValueInterface
{
    /**
     * {@inheritDoc}
     */
    public function getValue($context = null): bool
    {
        return true;
    }
}
