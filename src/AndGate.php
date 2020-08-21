<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class AndGate implements LogicGateInterface
{
    /**
     * @var LogicGateInputValueInterface[]
     */
    private $inputValues;

    public function __construct(LogicGateInputValueInterface ...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'An AND gate must be instantiated with at least one input value'
            );
        }

        $this->inputValues = $inputValues;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return LogicGateEnum::AND;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputValues(): array
    {
        return $this->inputValues;
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

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null): bool
    {
        return $this->execute($context);
    }
}
