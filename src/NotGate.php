<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class NotGate extends AbstractLogicGate
{
    /**
     * NotGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) != 1) {
            throw new ArgumentCountError(
                'A NOT gate must be instantiated with exactly one input value'
            );
        }

        parent::__construct(...$inputValues);
    }

    /**
     * @{inheritdoc}
     */
    public function execute(): bool
    {
        return !$this->inputValues[0]->getValue();
    }
}
