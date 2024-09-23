<?php

namespace Reflect\Test\Fixtures\BackedEnums;

use Reflect\Test\Fixtures\BackedEnums\Attributes\CostOfService;
use Reflect\Test\Fixtures\BackedEnums\Attributes\KindOfService;

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
