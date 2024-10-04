<?php

namespace Reflect\Tests\Fixtures\BackedEnums\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasEnumTarget;
use Reflect\Tests\Fixtures\BackedEnums\Service;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class KindOfService
{
    use HasEnumTarget;

    public function __construct(protected Service $service) {}

    public function getService(): Service
    {
        return $this->service;
    }
}
