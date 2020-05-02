<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Integration;

use Ordermind\LogicGates\AndGate;
use Ordermind\LogicGates\NandGate;
use Ordermind\LogicGates\NorGate;
use Ordermind\LogicGates\NotGate;
use Ordermind\LogicGates\OrGate;
use Ordermind\LogicGates\Test\Fixtures\InputValueTrue;
use Ordermind\LogicGates\XorGate;
use PHPUnit\Framework\TestCase;

class NestedGatesTest extends TestCase
{
    public function testNestedGates()
    {
        $trueValue = new InputValueTrue();

        $result = (new OrGate(
            new XorGate(
                new AndGate($trueValue),
                new NotGate($trueValue)
            ),
            new NandGate(
                new NorGate(
                    new AndGate($trueValue)
                ),
                new OrGate($trueValue)
            )
        ))->execute();

        $this->assertTrue($result);
    }
}
