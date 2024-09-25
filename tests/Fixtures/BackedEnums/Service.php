<?php

namespace Reflect\Tests\Fixtures\BackedEnums;

enum Service: string
{
    case EMAIL = 'email';
    case SMS = 'sms';
    case LOG = 'log';
}
