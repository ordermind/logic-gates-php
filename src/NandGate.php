<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class NandGate implements LogicGateInterface
{
    /**
     * @var AndGate
     */
    private $andGate;

    public function __construct(LogicGateInputValueInterface ...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'A NAND gate must be instantiated with at least one input value'
            );
        }

        $this->andGate = new AndGate(...$inputValues);
    }

    /**
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::NAND;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputValues(): array
    {
        return $this->andGate->getInputValues();
    }

    /**
     * {@inheritDoc}
     */
    public function execute($context = null): bool
    {
        return !$this->andGate->execute($context);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue($context = null): bool
    {
        return $this->execute($context);
    }
}
