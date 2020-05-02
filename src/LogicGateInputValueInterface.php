<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

interface LogicGateInputValueInterface
{
    /**
     * Gets the input value.
     *
     * @return bool
     */
    public function getValue() : bool;
}
