<?php

namespace Reflect\Test\Fixtures\BackedEnums;

use Reflect\Test\Fixtures\BackedEnums\Attributes\CostOfService;
use Reflect\Test\Fixtures\BackedEnums\Attributes\KindOfService;

enum Provider: string
{
    #[KindOfService(Service::EMAIL)]
    case MAILERSEND = 'mailersend';

    #[KindOfService(Service::EMAIL)]
    case MAILGUN = 'mailgun';

    #[KindOfService(Service::EMAIL)]
    case POSTMARK = 'postmark';

    #[KindOfService(Service::EMAIL)]
    case RESEND = 'resend';

    #[KindOfService(Service::EMAIL)]
    case SENDGRID = 'sendgrid';

    #[KindOfService(Service::EMAIL)]
    case SMTP = 'smtp';

    #[KindOfService(Service::SMS)]
    case TWILIO = 'twilio';

    #[KindOfService(Service::SMS)]
    case VONAGE = 'vonage';

    case PAPERTRAIL = 'papertrail';

    #[KindOfService(Service::LOG)]
    #[CostOfService(100)]
    case NULL = 'null';
}
