<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

interface LogicGateInterface extends LogicGateInputValueInterface
{
    /**
     * Executes the logic gate and returns the resulting value.
     *
     * @return bool
     */
    public function execute(): bool;
}
