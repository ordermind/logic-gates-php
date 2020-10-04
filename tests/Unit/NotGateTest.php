<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\NotGate;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\Test\Fixtures\InputValueFalse;
use Ordermind\LogicGates\Test\Fixtures\InputValueTrue;
use Ordermind\LogicGates\Test\Fixtures\InputValueWithContext;
use PHPUnit\Framework\TestCase;

class NotGateTest extends TestCase
{
    private InputValueFactory $inputValueFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inputValueFactory = new InputValueFactory();
    }

    public function testGetName()
    {
        $input = $this->inputValueFactory->createFromNative(true);

        $gate = new NotGate($input);

        $this->assertSame(LogicGateEnum::NOT, $gate->getName());
    }

    public function testGetInputValues()
    {
        $input = $this->inputValueFactory->createFromNative(true);

        $gate = new NotGate($input);

        $expected = [$input];
        $this->assertSame($expected, $gate->getInputValues());
    }

    public function testZeroValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('A NOT gate must be instantiated with exactly one input value');
        new NotGate();
    }

    public function testMultipleValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('A NOT gate must be instantiated with exactly one input value');
        new NotGate(new InputValueTrue(), new InputValueFalse());
    }

    /**
     * @dataProvider withContextProvider
     */
    public function testWithContext(bool $expectedResult, bool $context)
    {
        $input = new InputValueWithContext();

        $gate = new NotGate($input);
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
    public function testTruthTable(bool $expectedResult, bool $input)
    {
        $gate = new NotGate(
            $this->inputValueFactory->createFromNative($input)
        );
        $result = $gate->execute();
        $this->assertSame($expectedResult, $result);
    }

    public function truthTableProvider(): array
    {
        return [
            [true, false],  // 0
            [false, true],  // 1
        ];
    }
}
