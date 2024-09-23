<?php

use PrinceJohn\Reflect\Enum\Reflect;
use Reflect\Test\Fixtures\BackedEnums;
use Reflect\Test\Fixtures\UnitEnums;

covers(Reflect::class);

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
        ->getAttributeInstance(UnitEnums\Attributes\CostOfService::class)
        ->getCost();

    expect($service)->toBe(100);
});

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
    expect(Reflect::on($providerEnum)->getAttributeInstance(BackedEnums\Attributes\KindOfService::class))->toBeNull();
});

it('will return null when getting an instance of undeclared attribute in unit enum', function () {
    $providerEnum = UnitEnums\Provider::ARRAY;

    expect(Reflect::on($providerEnum)->getAttributeInstance(UnitEnums\Attributes\CostOfService::class))->toBeNull();
    expect(Reflect::on($providerEnum)->getAttributeInstance(UnitEnums\Attributes\KindOfService::class))->toBeNull();
});

it('can reflect on backed enum', function () {
    $providerEnum = BackedEnums\Provider::LOG;

    expect(Reflect::on($providerEnum)->reflection)->toBeInstanceOf(ReflectionEnumBackedCase::class);
});

it('can reflect on unit enum', function () {
    $providerEnum = BackedEnums\Provider::LOG;

    expect(Reflect::on($providerEnum)->reflection)->toBeInstanceOf(ReflectionEnumUnitCase::class);
});