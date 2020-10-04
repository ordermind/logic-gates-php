<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\Test\Fixtures\InputValueTrue;
use Ordermind\LogicGates\Test\Fixtures\InputValueWithContext;
use Ordermind\LogicGates\XorGate;
use PHPUnit\Framework\TestCase;

class XorGateTest extends TestCase
{
    private InputValueFactory $inputValueFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inputValueFactory = new InputValueFactory();
    }

    public function testGetName()
    {
        $input1 = $this->inputValueFactory->createFromNative(true);
        $input2 = $this->inputValueFactory->createFromNative(false);

        $gate = new XorGate($input1, $input2);

        $this->assertSame(LogicGateEnum::XOR, $gate->getName());
    }

    public function testGetInputValues()
    {
        $input1 = $this->inputValueFactory->createFromNative(true);
        $input2 = $this->inputValueFactory->createFromNative(false);

        $gate = new XorGate($input1, $input2);

        $expected = [$input1, $input2];
        $this->assertSame($expected, $gate->getInputValues());
    }

    public function testZeroValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('An XOR gate must be instantiated with at least two input values');
        new XorGate();
    }

    public function testOneValue()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('An XOR gate must be instantiated with at least two input values');
        new XorGate(new InputValueTrue());
    }

    /**
     * @dataProvider withContextProvider
     */
    public function testWithContext(bool $expectedResult, bool $context)
    {
        $input1 = new InputValueWithContext();
        $input2 = new InputValueWithContext();

        $gate = new XorGate($input1, $input2);
        $result = $gate->execute($context);

        $this->assertSame($expectedResult, $result);
    }

    public function withContextProvider()
    {
        return [
            [false, true],
            [false, false],
        ];
    }

    /**
     * @dataProvider truthTableProvider
     */
    public function testTruthTable(bool $expectedResult, array $nativeInputValues)
    {
        $gate = new XorGate(...array_map(function (bool $nativeValue) {
            return $this->inputValueFactory->createFromNative($nativeValue);
        }, $nativeInputValues));

        $result = $gate->execute();

        $this->assertSame($expectedResult, $result);
    }

    public function truthTableProvider()
    {
        return [
            [false, [false, false]],        // 0 0
            [true, [false, true]],          // 0 1
            [true, [true, false]],          // 1 0
            [false, [true, true]],          // 1 1

            [false, [false, false, false]], // 0 0 0
            [true, [false, false, true]],   // 0 0 1
            [true, [false, true, false]],   // 0 1 0
            [true, [false, true, true]],    // 0 1 1
            [true, [true, false, false]],   // 1 0 0
            [true, [true, false, true]],    // 1 0 1
            [true, [true, true, false]],    // 1 1 0
            [false, [true, true, true]],    // 1 1 1
        ];
    }
}
