<?php

namespace Reflect\Tests\Fixtures\Classes\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasClassTarget;

#[Attribute(Attribute::TARGET_CLASS)]
class Type
{
    use HasClassTarget;

    public function __construct(
        public string $tag
    ) {}
}
