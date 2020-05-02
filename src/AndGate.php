<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class AndGate extends AbstractLogicGate
{
    /**
     * AndGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'An AND gate must be instantiated with at least one input value'
            );
        }

        parent::__construct(...$inputValues);
    }

    /**
     * @{inheritdoc}
     */
    public function execute(): bool
    {
        foreach ($this->inputValues as $inputValue) {
            if (!$inputValue->getValue()) {
                return false;
            }
        }

        return true;
    }
}
