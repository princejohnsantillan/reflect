<?php

namespace Reflect\Tests\Fixtures\BackedEnums\Attributes;

use Attribute;
use Reflect\Tests\Fixtures\BackedEnums\Service;

#[Attribute]
class KindOfService
{
    public function __construct(protected Service $service) {}

    public function getService(): Service
    {
        return $this->service;
    }
}
