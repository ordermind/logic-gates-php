<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

interface LogicGateInterface extends LogicGateInputValueInterface
{
    /**
     * Gets the name of the gate.
     *
     * @return string
     */
    public static function getName() : string;

    /**
     * Gets the input values for the gate.
     *
     * @return LogicGateInputValueInterface[]
     */
    public function getInputValues() : array;

    /**
     * Executes the logic gate and returns the resulting value.
     *
     * @param mixed $context
     *
     * @return bool
     */
    public function execute($context = null): bool;
}
