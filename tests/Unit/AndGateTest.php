<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\AndGate;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\Test\Fixtures\InputValueWithContext;
use PHPUnit\Framework\TestCase;
use TypeError;

class AndGateTest extends TestCase
{
    /**
     * @var InputValueFactory
     */
    private $inputValueFactory;

    protected function setUp() : void
    {
        parent::setUp();

        $this->inputValueFactory = new InputValueFactory();
    }

    public function testGetName()
    {
        $this->assertSame(LogicGateEnum::AND, AndGate::getName());
    }

    public function testGetInputValues()
    {
        $input1 = $this->inputValueFactory->createFromNative(true);
        $input2 = $this->inputValueFactory->createFromNative(false);

        $gate = new AndGate($input1, $input2);

        $expected = [$input1, $input2];
        $this->assertSame($expected, $gate->getInputValues());
    }

    public function testZeroValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('An AND gate must be instantiated with at least one input value');
        new AndGate();
    }

    public function testIllegalValueType()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('All input values to a logic gate must implement LogicGateInputValueInterface');
        new AndGate(true);
    }

    /**
     * @dataProvider withContextProvider
     */
    public function testWithContext(bool $expectedResult, bool $context)
    {
        $input1 = new InputValueWithContext();
        $input2 = new InputValueWithContext();

        $gate = new AndGate($input1, $input2);
        $result = $gate->execute($context);

        $this->assertSame($expectedResult, $result);
    }

    public function withContextProvider()
    {
        return [
            [true, true],
            [false, false],
        ];
    }

    /**
     * @dataProvider truthTableProvider
     */
    public function testTruthTable(bool $expectedResult, array $nativeInputValues)
    {
        $gate = new AndGate(...array_map(function (bool $nativeValue) {
            return $this->inputValueFactory->createFromNative($nativeValue);
        }, $nativeInputValues));

        $result = $gate->execute();

        $this->assertSame($expectedResult, $result);
    }

    public function truthTableProvider()
    {
        return [
            [false, [false]],               // 0
            [true, [true]],                 // 1

            [false, [false, false]],        // 0 0
            [false, [false, true]],         // 0 1
            [false, [true, false]],         // 1 0
            [true, [true, true]],           // 1 1

            [false, [false, false, false]], // 0 0 0
            [false, [false, false, true]],  // 0 0 1
            [false, [false, true, false]],  // 0 1 0
            [false, [false, true, true]],   // 0 1 1
            [false, [true, false, false]],  // 1 0 0
            [false, [true, false, true]],   // 1 0 1
            [false, [true, true, false]],   // 1 1 0
            [true, [true, true, true]],     // 1 1 1
        ];
    }
}
