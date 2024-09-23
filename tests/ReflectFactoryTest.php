<?php

use PrinceJohn\Reflect;

enum Test
{
    case BackedEnum;
    case UnitEnum;
}

it('can instantiate an enum reflect', function () {

    $reflect = Reflect\Reflect::enum(Test::UnitEnum);

    expect($reflect)->toBeInstanceOf(Reflect\Enum\Reflect::class);
});
