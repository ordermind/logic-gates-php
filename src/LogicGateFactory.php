<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use UnexpectedValueException;

class LogicGateFactory
{
    /**
     * Creates a logic gate from an enum.
     *
     * @param LogicGateEnum                $gateEnum
     * @param LogicGateInputValueInterface ...$inputValues
     *
     * @return LogicGateInterface
     *
     * @throws UnexpectedValueException
     */
    public function createFromEnum(
        LogicGateEnum $gateEnum,
        LogicGateInputValueInterface ...$inputValues
    ) : LogicGateInterface {
        if ($gateEnum->getValue() === LogicGateEnum::AND) {
            return new AndGate(...$inputValues);
        }
        if ($gateEnum->getValue() === LogicGateEnum::NAND) {
            return new NandGate(...$inputValues);
        }
        if ($gateEnum->getValue() === LogicGateEnum::OR) {
            return new OrGate(...$inputValues);
        }
        if ($gateEnum->getValue() === LogicGateEnum::NOR) {
            return new NorGate(...$inputValues);
        }
        if ($gateEnum->getValue() === LogicGateEnum::XOR) {
            return new XorGate(...$inputValues);
        }
        if ($gateEnum->getValue() === LogicGateEnum::NOT) {
            return new NotGate(...$inputValues);
        }

        throw new UnexpectedValueException(
            'The gate "' . $gateEnum->getValue() . '" is not yet supported by this factory'
        );
    }
}
