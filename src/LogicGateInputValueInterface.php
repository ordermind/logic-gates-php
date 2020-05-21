<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

interface LogicGateInputValueInterface
{
    /**
     * Gets the input value.
     *
     * @param mixed $context
     *
     * @return bool
     */
    public function getValue($context = null) : bool;
}
