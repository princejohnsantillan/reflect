<?php

namespace Reflect\Tests\Fixtures\Classes\Attributes;

use Attribute;
use PrinceJohn\Reflect\Traits\HasClassTarget;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Tag
{
    use HasClassTarget;

    public function __construct(
        public string $tag
    ) {}
}
