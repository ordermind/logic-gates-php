<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class XorGate implements LogicGateInterface
{
    /**
     * @var LogicGateInputValueInterface[]
     */
    private array $inputValues;

    public function __construct(LogicGateInputValueInterface ...$inputValues)
    {
        if (count($inputValues) < 2) {
            throw new ArgumentCountError(
                'An XOR gate must be instantiated with at least two input values'
            );
        }

        $this->inputValues = $inputValues;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return LogicGateEnum::XOR;
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
        $trueCount = 0;

        foreach ($this->inputValues as $inputValue) {
            $value = $inputValue->getValue($context);
            if ($value === true) {
                $trueCount++;
            }
        }

        return $trueCount % 2 != 0;
    }

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null): bool
    {
        return $this->execute($context);
    }
}
