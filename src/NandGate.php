<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class NandGate implements LogicGateInterface, LogicGateInputValueInterface
{
    /**
     * @var AndGate
     */
    private $andGate;

    /**
     * NandGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) < 1) {
            throw new ArgumentCountError(
                'A NAND gate must be instantiated with at least one input value'
            );
        }

        $this->andGate = new AndGate(...$inputValues);
    }

    /**
     * @{inheritdoc}
     */
    public function execute(): bool
    {
        return !$this->andGate->execute();
    }

    /**
     * @{inheritdoc}
     */
    public function getValue() : bool
    {
        return $this->execute();
    }
}
