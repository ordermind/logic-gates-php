<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class NotGate implements LogicGateInterface
{
    /**
     * @var LogicGateInputValueInterface[]
     */
    private $inputValues;

    public function __construct(LogicGateInputValueInterface ...$inputValues)
    {
        if (count($inputValues) != 1) {
            throw new ArgumentCountError(
                'A NOT gate must be instantiated with exactly one input value'
            );
        }

        $this->inputValues = $inputValues;
    }

    /**
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::NOT;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputValues() : array
    {
        return $this->inputValues;
    }

    /**
     * {@inheritDoc}
     */
    public function execute($context = null): bool
    {
        return !$this->inputValues[0]->getValue($context);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null) : bool
    {
        return $this->execute($context);
    }
}
