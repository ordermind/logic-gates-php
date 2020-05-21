<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use ArgumentCountError;

class XorGate extends AbstractLogicGate
{
    /**
     * XorGate constructor.
     *
     * @param LogicGateInputValueInterface[] ...$inputValues One or more input values.
     */
    public function __construct(...$inputValues)
    {
        if (count($inputValues) < 2) {
            throw new ArgumentCountError(
                'An XOR gate must be instantiated with at least two input values'
            );
        }

        parent::__construct(...$inputValues);
    }

    /**
     * {@inheritDoc}
     */
    public static function getName(): string
    {
        return LogicGateEnum::XOR;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(): bool
    {
        $trueCount = 0;
        $falseCount = 0;

        foreach ($this->inputValues as $inputValue) {
            $value = $inputValue->getValue();
            if ($value === true) {
                $trueCount++;
            } else {
                $falseCount++;
            }

            if ($trueCount > 0 && $falseCount > 0) {
                return true;
            }
        }

        return false;
    }
}
