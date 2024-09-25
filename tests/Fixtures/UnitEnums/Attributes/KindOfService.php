<?php

namespace Reflect\Tests\Fixtures\UnitEnums\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasEnumTarget;
use Reflect\Tests\Fixtures\UnitEnums\Service;

#[Attribute]
class KindOfService
{
    use HasEnumTarget;

    public function __construct(protected Service $service) {}

    public function getService(): Service
    {
        return $this->service;
    }
}
