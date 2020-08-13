<?php

declare(strict_types=1);

namespace Ordermind\LogicGates\Test\Unit;

use Ordermind\LogicGates\AndGate;
use Ordermind\LogicGates\LogicGateEnum;
use Ordermind\LogicGates\LogicGateFactory;
use Ordermind\LogicGates\NandGate;
use Ordermind\LogicGates\NorGate;
use Ordermind\LogicGates\NotGate;
use Ordermind\LogicGates\OrGate;
use Ordermind\LogicGates\Test\Fixtures\ExtendedLogicGateEnum;
use Ordermind\LogicGates\Test\Fixtures\InputValueFactory;
use Ordermind\LogicGates\XorGate;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class LogicGateFactoryTest extends TestCase
{
    /**
     * @var InputValueFactory
     */
    private $inputValueFactory;

    /**
     * @var LogicGateFactory
     */
    private $logicGateFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inputValueFactory = new InputValueFactory();
        $this->logicGateFactory = new LogicGateFactory();
    }

    public function testCreateFromEnumUnsupportedGate()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage('The gate "NEW" is not yet supported by this factory');
        $this->logicGateFactory->createFromEnum(new ExtendedLogicGateEnum(ExtendedLogicGateEnum::NEW));
    }

    /**
     * @dataProvider createFromEnumProvider
     */
    public function testCreateFromEnum(string $expectedClass, string $gateName, array $nativeInputValues)
    {
        $inputValues = array_map(function (bool $nativeValue) {
            return $this->inputValueFactory->createFromNative($nativeValue);
        }, $nativeInputValues);

        $gate = $this->logicGateFactory->createFromEnum(new LogicGateEnum($gateName), ...$inputValues);

        $this->assertSame($expectedClass, get_class($gate));
        $this->assertSame($gateName, $gate->getName());
        $this->assertSame($inputValues, $gate->getInputValues());
    }

    public function createFromEnumProvider()
    {
        return [
            [AndGate::class, LogicGateEnum::AND, [true, false]],
            [NandGate::class, LogicGateEnum::NAND, [true, false]],
            [OrGate::class, LogicGateEnum::OR, [true, false]],
            [NorGate::class, LogicGateEnum::NOR, [true, false]],
            [XorGate::class, LogicGateEnum::XOR, [true, false]],
            [NotGate::class, LogicGateEnum::NOT, [true]],
        ];
    }
}
