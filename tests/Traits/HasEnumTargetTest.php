<?php

use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use PrinceJohn\Reflect\Traits\HasEnumTarget;
use Reflect\Tests\Fixtures\BackedEnums;
use Reflect\Tests\Fixtures\UnitEnums;

mutates(HasEnumTarget::class);

it('can check if the attribute is used in the backed enum provided', function () {
    expect(BackedEnums\Attributes\KindOfService::isOnEnum(BackedEnums\Provider::SENDGRID))->toBeTrue();
    expect(BackedEnums\Attributes\CostOfService::isOnEnum(BackedEnums\Provider::SENDGRID))->toBeFalse();
});

it('can check if the attribute is used in the unit enum provided', function () {
    expect(UnitEnums\Attributes\KindOfService::isOnEnum(UnitEnums\Provider::TWILIO))->toBeFalse();
    expect(UnitEnums\Attributes\CostOfService::isOnEnum(UnitEnums\Provider::TWILIO))->toBeTrue();
});

it('can try to get an instance of the attribute using the backed enum provided otherwise get a null', function () {
    expect(BackedEnums\Attributes\KindOfService::tryEnum(BackedEnums\Provider::SENDGRID))
        ->toBeInstanceOf(BackedEnums\Attributes\KindOfService::class);

    expect(BackedEnums\Attributes\CostOfService::tryEnum(UnitEnums\Provider::SENDGRID))->toBeNull();
});

it('can try to get an instance of the attribute using the unit enum provided otherwise get a null', function () {
    expect(UnitEnums\Attributes\CostOfService::tryEnum(UnitEnums\Provider::TWILIO))
        ->toBeInstanceOf(UnitEnums\Attributes\CostOfService::class);

    expect(BackedEnums\Attributes\CostOfService::tryEnum(UnitEnums\Provider::SENDGRID))->toBeNull();
});

it('can get an instance of the attribute using the backed enum provided or fail if not declared', function () {
    expect(BackedEnums\Attributes\KindOfService::onEnum(BackedEnums\Provider::SENDGRID))
        ->toBeInstanceOf(BackedEnums\Attributes\KindOfService::class);

    expect(fn () => BackedEnums\Attributes\CostOfService::onEnum(BackedEnums\Provider::SENDGRID))
        ->toThrow(AttributeNotFoundException::class);
});

it('can get an instance of the attribute using the unit enum provided or fail if not declared', function () {
    expect(UnitEnums\Attributes\CostOfService::onEnum(UnitEnums\Provider::TWILIO))
        ->toBeInstanceOf(UnitEnums\Attributes\CostOfService::class);

    expect(fn () => BackedEnums\Attributes\KindOfService::onEnum(UnitEnums\Provider::SENDGRID))
        ->toThrow(AttributeNotFoundException::class);
});
it('can get all attribute instances of a repeatable attribute on a backed enum', function () {
    $serviceEnum = BackedEnums\Service::EMAIL;

    $attributes = BackedEnums\Attributes\Tag::allOnEnum($serviceEnum);

    expect($attributes)->toBeArray();

    foreach ($attributes as $attribute) {
        expect($attribute)->toBeInstanceOf(BackedEnums\Attributes\Tag::class);
    }
});

it('can get all attribute instances of a repeatable attribute on a unit enum', function () {
    $serviceEnum = UnitEnums\Service::SMS;

    $attributes = UnitEnums\Attributes\Tag::allOnEnum($serviceEnum);

    expect($attributes)->toBeArray();

    foreach ($attributes as $attribute) {
        expect($attribute)->toBeInstanceOf(UnitEnums\Attributes\Tag::class);
    }
});

it('returns an empty array when repeatable attributes are missing from a backed enum', function () {
    $serviceEnum = BackedEnums\Service::SMS;

    $attributes = BackedEnums\Attributes\Tag::allOnEnum($serviceEnum);

    expect($attributes)->toBe([]);
});

it('returns an empty array when repeatable attributes are missing from a unit enum', function () {
    $serviceEnum = UnitEnums\Service::EMAIL;

    $attributes = UnitEnums\Attributes\Tag::allOnEnum($serviceEnum);

    expect($attributes)->toBe([]);
});
