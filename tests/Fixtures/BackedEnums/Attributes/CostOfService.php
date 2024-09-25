<?php

namespace Reflect\Tests\Fixtures\BackedEnums\Attributes;

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
