<?php

declare(strict_types=1);

namespace Ordermind\LogicGates;

use MyCLabs\Enum\Enum;

class LogicGateEnum extends Enum
{
    const AND = 'AND';
    const NAND = 'NAND';
    const OR = 'OR';
    const NOR = 'NOR';
    const XOR = 'XOR';
    const NOT = 'NOT';
}
