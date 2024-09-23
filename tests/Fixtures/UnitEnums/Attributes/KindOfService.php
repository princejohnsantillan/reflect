<?php

namespace Reflect\Test\Fixtures\UnitEnums\Attributes;

use Attribute;
use Reflect\Test\Fixtures\UnitEnums\Service;

#[Attribute]
class KindOfService
{
    public function __construct(protected Service $service) {}

    public function getService(): Service
    {
        return $this->service;
    }
}
