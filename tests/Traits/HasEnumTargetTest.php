<?php

use PrinceJohn\Reflect\Traits\HasEnumTarget;
use Reflect\Tests\Fixtures\BackedEnums;
use Reflect\Tests\Fixtures\UnitEnums;

covers(HasEnumTarget::class);

it('can get an instance of the attribute using the backed enum provided', function () {
    $attribute = BackedEnums\Attributes\KindOfService::onEnum(BackedEnums\Provider::SENDGRID);

    expect($attribute)->toBeInstanceOf(BackedEnums\Attributes\KindOfService::class);
});

it('can get an instance of the attribute using the unit enum provided', function () {
    $attribute = UnitEnums\Attributes\CostOfService::onEnum(UnitEnums\Provider::TWILIO);

    expect($attribute)->toBeInstanceOf(UnitEnums\Attributes\CostOfService::class);
});
