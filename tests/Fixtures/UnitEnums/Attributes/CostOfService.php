<?php

namespace Reflect\Test\Fixtures\UnitEnums\Attributes;

use Attribute;

#[Attribute]
class CostOfService
{
    public function __construct(public int $cost) {}

    public function getCost(): int
    {
        return $this->cost;
    }
}
