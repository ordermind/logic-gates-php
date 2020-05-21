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
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::AND;
    }

    /**
     * {@inheritDoc}
     */
    public function execute($context = null): bool
    {
        foreach ($this->inputValues as $inputValue) {
            if (!$inputValue->getValue($context)) {
                return false;
            }
        }

        return true;
    }
}
