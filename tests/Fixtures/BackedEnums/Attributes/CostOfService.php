<?php

namespace Reflect\Test\Fixtures\BackedEnums\Attributes;

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