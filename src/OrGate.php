<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class OrGate implements LogicGateInterface
{
    /**
     * @var LogicGateInputValueInterface[]
     */
    private $inputValues;

    public function __construct(LogicGateInputValueInterface ...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'An OR gate must be instantiated with at least one input value'
            );
        }

        $this->inputValues = $inputValues;
    }

    /**
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::OR;
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
        foreach ($this->inputValues as $inputValue) {
            if ($inputValue->getValue($context)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null) : bool
    {
        return $this->execute($context);
    }
}
