<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class NorGate implements LogicGateInterface
{
    /**
     * @var OrGate
     */
    private $orGate;

    /**
     * NorGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'A NOR gate must be instantiated with at least one input value'
            );
        }

        $this->orGate = new OrGate(...$inputValues);
    }

    /**
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::NOR;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputValues() : array
    {
        return $this->orGate->getInputValues();
    }

    /**
     * {@inheritDoc}
     */
    public function execute($context = null): bool
    {
        return !$this->orGate->execute($context);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null) : bool
    {
        return $this->execute($context);
    }
}
