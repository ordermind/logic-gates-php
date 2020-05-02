<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class OrGate extends AbstractLogicGate
{
    /**
     * OrGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'An OR gate must be instantiated with at least one input value'
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
            if ($inputValue->getValue()) {
                return true;
            }
        }

        return false;
    }
}
