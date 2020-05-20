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
     * @return array
     */
    public function getInputValues() : array;

    /**
     * Executes the logic gate and returns the resulting value.
     *
     * @return bool
     */
    public function execute(): bool;
}
