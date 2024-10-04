<?php

namespace Reflect\Tests\Fixtures\BackedEnums\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasEnumTarget;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class CostOfService
{
    use HasEnumTarget;

    public function __construct(protected int $cost) {}

    public function getCost(): int
    {
        return $this->cost;
    }
}
