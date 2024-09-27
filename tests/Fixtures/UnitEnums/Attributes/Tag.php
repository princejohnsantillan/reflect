<?php

namespace Reflect\Tests\Fixtures\UnitEnums\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasEnumTarget;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT | Attribute::IS_REPEATABLE)]
class Tag
{
    use HasEnumTarget;

    public function __construct(
        public string $tag
    ) {}
}
