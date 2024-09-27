<?php

use PrinceJohn\Reflect\Enum\Reflect;
use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use Reflect\Tests\Fixtures\BackedEnums;
use Reflect\Tests\Fixtures\UnitEnums;

covers(Reflect::class);

it('can check existence of attribute in a backed enum', function () {
    $providerEnum = BackedEnums\Provider::SENDGRID;

    expect(Reflect::on($providerEnum)
        ->hasAttribute(BackedEnums\Attributes\CostOfService::class))->toBeFalse();

    expect(Reflect::on($providerEnum)
        ->hasAttribute(BackedEnums\Attributes\KindOfService::class))->toBeTrue();
});

it('can check existence of attribute in a unit enum', function () {
    $providerEnum = UnitEnums\Provider::TWILIO;

    expect(Reflect::on($providerEnum)
        ->hasAttribute(UnitEnums\Attributes\CostOfService::class))->toBeTrue();

    expect(Reflect::on($providerEnum)
        ->hasAttribute(UnitEnums\Attributes\KindOfService::class))->toBeFalse();
});

it('can get attribute instance of backed enum', function () {
    $providerEnum = BackedEnums\Provider::SENDGRID;

    $service = Reflect::on($providerEnum)
        ->getAttributeInstance(BackedEnums\Attributes\KindOfService::class)
        ->getService();

    expect($service)->toBe(BackedEnums\Service::EMAIL);
});

it('can get attribute instance of unit enum', function () {
    $providerEnum = UnitEnums\Provider::TWILIO;

    $service = Reflect::on($providerEnum)
        ->getOrFailAttributeInstance(UnitEnums\Attributes\CostOfService::class)
        ->getCost();

    expect($service)->toBe(100);
});

it('will error out when getting instance of attribute declared multiple times in a backed enum', function () {
    $providerEnum = BackedEnums\Provider::NULL;

    expect(fn () => Reflect::on($providerEnum)
        ->getAttributeInstance(BackedEnums\Attributes\CostOfService::class))->toThrow(Error::class);
});

it('will error out when getting instance of attribute declared multiple times in a unit enum', function () {
    $providerEnum = UnitEnums\Provider::NULL;

    expect(fn () => Reflect::on($providerEnum)
        ->getAttributeInstance(UnitEnums\Attributes\KindOfService::class))->toThrow(Error::class);
});

it('will return null when getting an instance of undeclared attribute in backed enum', function () {
    $providerEnum = BackedEnums\Provider::ARRAY;

    expect(Reflect::on($providerEnum)->getAttributeInstance(BackedEnums\Attributes\CostOfService::class))->toBeNull();
});

it('will return null when getting an instance of undeclared attribute in unit enum', function () {
    $providerEnum = UnitEnums\Provider::ARRAY;

    expect(Reflect::on($providerEnum)->getAttributeInstance(UnitEnums\Attributes\KindOfService::class))->toBeNull();
});

it('will thrown a not found exception when getting an instance of undeclared attribute in backed enum', function () {
    $providerEnum = BackedEnums\Provider::ARRAY;

    Reflect::on($providerEnum)
        ->getOrFailAttributeInstance(BackedEnums\Attributes\CostOfService::class);

})->throws(AttributeNotFoundException::class, "Reflect\Tests\Fixtures\BackedEnums\Attributes\CostOfService not found.");

it('will thrown a not found exception when getting an instance of undeclared attribute in unit enum', function () {
    $providerEnum = UnitEnums\Provider::ARRAY;

    Reflect::on($providerEnum)
        ->getOrFailAttributeInstance(UnitEnums\Attributes\KindOfService::class);

})->throws(AttributeNotFoundException::class, "Reflect\Tests\Fixtures\UnitEnums\Attributes\KindOfService not found.");

it('can reflect on backed enum', function () {
    $providerEnum = BackedEnums\Provider::LOG;

    expect(Reflect::on($providerEnum)->reflection)->toBeInstanceOf(ReflectionEnumBackedCase::class);
});

it('can reflect on unit enum', function () {
    $providerEnum = BackedEnums\Provider::LOG;

    expect(Reflect::on($providerEnum)->reflection)->toBeInstanceOf(ReflectionEnumUnitCase::class);
});

it('can get all attribute instances of a repeatable attribute on a backed enum', function () {
    $serviceEnum = BackedEnums\Service::EMAIL;

    $attributes = Reflect::on($serviceEnum)->getAllAttributeInstances(BackedEnums\Attributes\Tag::class);

    expect($attributes)->toBeArray();

    foreach ($attributes as $attribute) {
        expect($attribute)->toBeInstanceOf(BackedEnums\Attributes\Tag::class);
    }
});

it('can get all attribute instances of a repeatable attribute on a unit enum', function () {
    $serviceEnum = UnitEnums\Service::SMS;

    $attributes = Reflect::on($serviceEnum)->getAllAttributeInstances(UnitEnums\Attributes\Tag::class);

    expect($attributes)->toBeArray();

    foreach ($attributes as $attribute) {
        expect($attribute)->toBeInstanceOf(UnitEnums\Attributes\Tag::class);
    }
});

it('returns an empty array when repeatable attributes are missing from a backed enum', function () {
    $serviceEnum = BackedEnums\Service::SMS;

    $attributes = Reflect::on($serviceEnum)->getAllAttributeInstances(BackedEnums\Attributes\Tag::class);

    expect($attributes)->toBe([]);
});

it('returns an empty array when repeatable attributes are missing from a unit enum', function () {
    $serviceEnum = UnitEnums\Service::EMAIL;

    $attributes = Reflect::on($serviceEnum)->getAllAttributeInstances(UnitEnums\Attributes\Tag::class);

    expect($attributes)->toBe([]);
});
