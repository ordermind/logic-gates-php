<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use MyCLabs\Enum\Enum;

class LogicGateEnum extends Enum
{
    public const AND = 'AND';
    public const NAND = 'NAND';
    public const OR = 'OR';
    public const NOR = 'NOR';
    public const XOR = 'XOR';
    public const NOT = 'NOT';
}
