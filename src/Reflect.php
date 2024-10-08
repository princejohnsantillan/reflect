<?php

namespace PrinceJohn\Reflect;

use BackedEnum;
use UnitEnum;

class Reflect
{
    public static function enum(BackedEnum|UnitEnum $enum): Enum\Reflect
    {
        return Enum\Reflect::on($enum);
    }

    /**
     * @param  object|class-string  $class
     */
    public static function class(object|string $class): Class\Reflect
    {
        return Class\Reflect::on($class);
    }
}
