<?php

namespace Reflect\Tests\Fixtures\UnitEnums\Attributes;

use Attribute;

#[Attribute]
class CostOfService
{
    public function __construct(protected int $cost) {}

    public function getCost(): int
    {
        return $this->cost;
    }
}
