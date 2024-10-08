<?php

namespace Reflect\Tests\Fixtures\UnitEnums\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasEnumTarget;

#[Attribute]
class CostOfService
{
    use HasEnumTarget;

    public function __construct(protected int $cost) {}

    public function getCost(): int
    {
        return $this->cost;
    }
}
