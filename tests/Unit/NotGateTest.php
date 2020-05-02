<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use ArgumentCountError;
use Ordermind\LogicGates\NotGate;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\Test\Fixtures\InputValueFalse;
use Ordermind\LogicGates\Test\Fixtures\InputValueTrue;
use PHPUnit\Framework\TestCase;
use TypeError;

class NotGateTest extends TestCase
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

    public function testZeroValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('A NOT gate must be instantiated with exactly one input value');
        new NotGate();
    }

    public function testIllegalValueType()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('All input values to a logic gate must implement LogicGateInputValueInterface');
        new NotGate(true);
    }

    /**
     * @dataProvider oneValueProvider
     */
    public function testOneValue(bool $expectedResult, bool $input)
    {
        $gate = new NotGate(
            $this->inputValueFactory->createFromNative($input)
        );
        $result = $gate->execute();
        $this->assertSame($expectedResult, $result);
    }

    public function oneValueProvider() : array
    {
        return [
            [true, false],
            [false, true],
        ];
    }

    public function testTwoValues()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('A NOT gate must be instantiated with exactly one input value');
        new NotGate(new InputValueTrue(), new InputValueFalse());
    }
}
