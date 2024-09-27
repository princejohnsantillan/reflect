<?php

namespace PrinceJohn\Reflect\Traits;

use BackedEnum;
use PrinceJohn\Reflect\Enum\Reflect;
use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use UnitEnum;

trait HasEnumTarget
{
    /**
     * Check if this attribute is declared on the enum.
     */
    public static function isOnEnum(BackedEnum|UnitEnum $enum): bool
    {
        return Reflect::on($enum)->hasAttribute(static::class);
    }

    /**
     * Try to get this attribute as declared on the enum.
     */
    public static function tryEnum(BackedEnum|UnitEnum $enum): ?static
    {
        return Reflect::on($enum)->getAttributeInstance(static::class);
    }

    /**
     * Get this attribute as declared on the enum.
     *
     * @throws AttributeNotFoundException
     */
    public static function onEnum(BackedEnum|UnitEnum $enum): static
    {
        return Reflect::on($enum)->getOrFailAttributeInstance(static::class);
    }

    /**
     * @return array<static>
     */
    public static function allOnEnum(BackedEnum|UnitEnum $enum): array
    {
        return Reflect::on($enum)->getAllAttributeInstances(static::class);
    }
}
