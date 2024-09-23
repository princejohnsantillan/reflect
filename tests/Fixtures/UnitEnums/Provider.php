<?php

namespace Reflect\Test\Fixtures\UnitEnums;

use Reflect\Test\Fixtures\UnitEnums\Attributes\KindOfService;

enum Provider
{
    #[KindOfService(Service::EMAIL)]
    case MAILERSEND;

    #[KindOfService(Service::EMAIL)]
    case MAILGUN;

    #[KindOfService(Service::EMAIL)]
    case POSTMARK;

    #[KindOfService(Service::EMAIL)]
    case RESEND;

    #[KindOfService(Service::EMAIL)]
    case SENDGRID;

    #[KindOfService(Service::EMAIL)]
    case SMTP;

    #[KindOfService(Service::SMS)]
    case TWILIO;

    #[KindOfService(Service::SMS)]
    case VONAGE;

    case PAPERTRAIL;

    #[KindOfService(Service::EMAIL)]
    #[KindOfService(Service::SMS)]
    case NULL;
}
