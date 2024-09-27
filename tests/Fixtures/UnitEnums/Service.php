<?php

namespace Reflect\Tests\Fixtures\UnitEnums;

use Reflect\Tests\Fixtures\UnitEnums\Attributes\Tag;

enum Service
{
    case EMAIL;

    #[Tag('Twilio')]
    #[Tag('Vonage')]
    case SMS;
    case LOG;
}
