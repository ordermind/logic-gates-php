<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\NorGate;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\Test\Fixtures\InputValueWithContext;
use PHPUnit\Framework\TestCase;

class NorGateTest extends TestCase
{
    /**
     * @var InputValueFactory
     */
    private $inputValueFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inputValueFactory = new InputValueFactory();
    }

    public function testZeroValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('A NOR gate must be instantiated with at least one input value');
        new NorGate();
    }

    public function testGetName()
    {
        $this->assertSame(LogicGateEnum::NOR, NorGate::getName());
    }

    public function testGetInputValues()
    {
        $input1 = $this->inputValueFactory->createFromNative(true);
        $input2 = $this->inputValueFactory->createFromNative(false);

        $gate = new NorGate($input1, $input2);

        $expected = [$input1, $input2];
        $this->assertSame($expected, $gate->getInputValues());
    }

    /**
     * @dataProvider withContextProvider
     */
    public function testWithContext(bool $expectedResult, bool $context)
    {
        $input1 = new InputValueWithContext();
        $input2 = new InputValueWithContext();

        $gate = new NorGate($input1, $input2);
        $result = $gate->execute($context);

        $this->assertSame($expectedResult, $result);
    }

    public function withContextProvider()
    {
        return [
            [false, true],
            [true, false],
        ];
    }

    /**
     * @dataProvider truthTableProvider
     */
    public function testTruthTable(bool $expectedResult, array $nativeInputValues)
    {
        $gate = new NorGate(...array_map(function (bool $nativeValue) {
            return $this->inputValueFactory->createFromNative($nativeValue);
        }, $nativeInputValues));

        $result = $gate->execute();

        $this->assertSame($expectedResult, $result);
    }

    public function truthTableProvider()
    {
        return [
            [true, [false]],                // 0
            [false, [true]],                // 1

            [true, [false, false]],         // 0 0
            [false, [false, true]],         // 0 1
            [false, [true, false]],         // 1 0
            [false, [true, true]],          // 1 1

            [true, [false, false, false]],  // 0 0 0
            [false, [false, false, true]],  // 0 0 1
            [false, [false, true, false]],  // 0 1 0
            [false, [false, true, true]],   // 0 1 1
            [false, [true, false, false]],  // 1 0 0
            [false, [true, false, true]],   // 1 0 1
            [false, [true, true, false]],   // 1 1 0
            [false, [true, true, true]],    // 1 1 1
        ];
    }
}
