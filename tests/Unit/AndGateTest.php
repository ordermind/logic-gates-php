<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\AndGate;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
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
     * @dataProvider oneValueProvider
     */
    public function testOneValue(bool $expectedResult, bool $input)
    {
        $gate = new AndGate($this->inputValueFactory->createFromNative($input));
        $result = $gate->execute();
        $this->assertSame($expectedResult, $result);
    }

    public function oneValueProvider() : array
    {
        return [
            [false, false],
            [true, true],
        ];
    }

    /**
     * @dataProvider twoValuesProvider
     */
    public function testTwoValues(bool $expectedResult, bool $input1, bool $input2)
    {
        $gate = new AndGate(
            $this->inputValueFactory->createFromNative($input1),
            $this->inputValueFactory->createFromNative($input2)
        );
        $result = $gate->execute();
        $this->assertSame($expectedResult, $result);
    }

    public function twoValuesProvider() : array
    {
        return [
            [false, false, false],
            [false, false, true],
            [false, true, false],
            [true, true, true],
        ];
    }

    /**
     * @dataProvider threeValuesProvider
     */
    public function testThreeValues(bool $expectedResult, bool $input1, bool $input2, bool $input3)
    {
        $gate = new AndGate(
            $this->inputValueFactory->createFromNative($input1),
            $this->inputValueFactory->createFromNative($input2),
            $this->inputValueFactory->createFromNative($input3)
        );
        $result = $gate->execute();
        $this->assertSame($expectedResult, $result);
    }

    public function threeValuesProvider() : array
    {
        return [
            [false, false, false, false],
            [false, false, false, true],
            [false, false, true, false],
            [false, false, true, true],
            [false, true, false, false],
            [false, true, false, true],
            [false, true, true, false],
            [true, true, true, true],
        ];
    }
}
