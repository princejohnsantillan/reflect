<?php

use PrinceJohn\Reflect;

mutates(Reflect\Reflect::class);

enum BackedEnumTest: string
{
    case HELLO = 'hello';
}

enum UnitEnumTest
{
    case WORLD;
}

it('can instantiate an enum reflect', function () {

    $reflect = Reflect\Reflect::enum(BackedEnumTest::HELLO);

    expect($reflect)->toBeInstanceOf(Reflect\Enum\Reflect::class);

    $reflect = Reflect\Reflect::enum(UnitEnumTest::WORLD);

    expect($reflect)->toBeInstanceOf(Reflect\Enum\Reflect::class);
});
