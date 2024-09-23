<?php

namespace Reflect\Test\Fixtures\BackedEnums\Attributes;

use Attribute;
use Reflect\Test\Fixtures\BackedEnums\Service;

#[Attribute]
class KindOfService
{
    public function __construct(protected Service $service) {}

    public function getService(): Service
    {
        return $this->service;
    }
}
