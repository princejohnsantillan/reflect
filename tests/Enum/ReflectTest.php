<?php

use PrinceJohn\Reflect\Exceptions\SoleAttributeException;
use PrinceJohn\Reflect\Reflect;
use Reflect\Test\Fixtures\BackedEnums;
use Reflect\Test\Fixtures\UnitEnums;

it('can reflect backed enum', function () {
    $providerEnum = BackedEnums\Provider::SENDGRID;

    $service = Reflect::enum($providerEnum)
        ->getSoleAttributeInstance(BackedEnums\Attributes\KindOfService::class)
        ->getService();

    expect($service)->toBe(BackedEnums\Service::EMAIL);
});

it('can reflect unit enum', function () {
    $providerEnum = UnitEnums\Provider::TWILIO;

    $service = Reflect::enum($providerEnum)
        ->getSoleAttributeInstance(UnitEnums\Attributes\KindOfService::class)
        ->getService();

    expect($service)->toBe(UnitEnums\Service::SMS);
});

it('fails to get a sole instance when no attribute is defined', function () {
    $providerEnum = UnitEnums\Provider::PAPERTRAIL;

    $attribute = UnitEnums\Attributes\KindOfService::class;
    expect(fn () => Reflect::enum($providerEnum)
        ->getSoleAttributeInstance($attribute)
    )->toThrow(SoleAttributeException::class, "One {$attribute} attribute was expected.");

    $providerEnum = BackedEnums\Provider::PAPERTRAIL;

    expect(fn () => Reflect::enum($providerEnum)
        ->getSoleAttributeInstance()
    )->toThrow(SoleAttributeException::class, 'One attribute was expected.');
});

it('fails to get a sole instance when multiple attributes are defined', function () {
    $providerEnum = UnitEnums\Provider::NULL;

    $attribute = UnitEnums\Attributes\KindOfService::class;
    expect(fn () => Reflect::enum($providerEnum)
        ->getSoleAttributeInstance($attribute)
    )->toThrow(SoleAttributeException::class, "One {$attribute} attribute was expected.");

    $providerEnum = BackedEnums\Provider::NULL;

    expect(fn () => Reflect::enum($providerEnum)
        ->getSoleAttributeInstance()
    )->toThrow(SoleAttributeException::class, 'One attribute was expected.');
});

it('can get the first attribute', function () {
    $providerEnum = BackedEnums\Provider::NULL;

    $service = Reflect::enum($providerEnum)
        ->getFirstAttributeInstance(BackedEnums\Attributes\KindOfService::class)
        ->getService();

    expect($service)->toBe(BackedEnums\Service::LOG);
});

it('can get the last attribute', function () {
    $providerEnum = BackedEnums\Provider::NULL;

    $attribute = Reflect::enum($providerEnum)
        ->getLastAttributeInstance();

    expect($attribute)->toBeInstanceOf(BackedEnums\Attributes\CostOfService::class);
});
