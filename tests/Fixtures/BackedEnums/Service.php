<?php

namespace Reflect\Tests\Fixtures\BackedEnums;

use Reflect\Tests\Fixtures\BackedEnums\Attributes\Tag;

enum Service: string
{
    #[Tag('SMTP')]
    #[Tag('Mailgun')]
    #[Tag('Postmark')]
    #[Tag('Resend')]
    #[Tag('MailerSend')]
    #[Tag('SendGrid')]
    case EMAIL = 'email';
    case SMS = 'sms';
    case LOG = 'log';
}
