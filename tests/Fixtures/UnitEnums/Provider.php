<?php

namespace Reflect\Test\Fixtures\UnitEnums;

use Reflect\Test\Fixtures\UnitEnums\Attributes\CostOfService;
use Reflect\Test\Fixtures\UnitEnums\Attributes\KindOfService;

enum Provider
{
    #[KindOfService(Service::EMAIL)]
    case SENDGRID;

    #[CostOfService(100)]
    case TWILIO;

    #[KindOfService(Service::EMAIL)]
    #[KindOfService(Service::SMS)]
    case NULL;

    case ARRAY;

    case LOG;
}
