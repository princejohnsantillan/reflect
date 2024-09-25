<?php

namespace Reflect\Tests\Fixtures\BackedEnums;

use Reflect\Tests\Fixtures\BackedEnums\Attributes\CostOfService;
use Reflect\Tests\Fixtures\BackedEnums\Attributes\KindOfService;

enum Provider: string
{
    #[KindOfService(Service::EMAIL)]
    case SENDGRID = 'sendgrid';

    #[KindOfService(Service::SMS)]
    case TWILIO = 'twilio';

    #[CostOfService(100)]
    #[CostOfService(200)]
    case NULL = 'null';

    case ARRAY = 'array';

    case LOG = 'log';
}
