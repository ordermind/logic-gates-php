<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use TypeError;

abstract class AbstractLogicGate implements LogicGateInterface
{
    /**
     * @var LogicGateInputValueInterface[]
     */
    protected $inputValues;

    /**
     * Logic gate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        $this->validateInputValues($inputValues);

        $this->inputValues = $inputValues;
    }

    /**
     * {@inheritDoc}
     */
    abstract public static function getName() : string;

    /**
     * {@inheritDoc}
     */
    abstract public function execute() : bool;

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
    public function getValue() : bool
    {
        return $this->execute();
    }

    /**
     * Validates all input values.
     *
     * @param array $inputValues
     *
     * @return void
     *
     * @throws TypeError
     */
    protected function validateInputValues(array $inputValues) : void
    {
        foreach ($inputValues as $inputValue) {
            if (!($inputValue instanceof LogicGateInputValueInterface)) {
                throw new TypeError('All input values to a logic gate must implement LogicGateInputValueInterface');
            }
        }
    }
}
