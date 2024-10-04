<?php

namespace PrinceJohn\Reflect\Traits;

use PrinceJohn\Reflect\Class\Reflect;
use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;

trait HasClassTarget
{
    /**
     * Check if this attribute is declared on the class.
     *
     * @param  object|class-string  $class
     */
    public static function isOnClass(object|string $class): bool
    {
        return Reflect::on($class)->hasAttribute(static::class);
    }

    /**
     * Try to get this attribute as declared on the class.
     *
     * @param  object|class-string  $class
     */
    public static function tryClass(object|string $class): ?static
    {
        return Reflect::on($class)->getAttributeInstance(static::class);
    }

    /**
     * Get this attribute as declared on the class.
     *
     * @param  object|class-string  $class
     *
     * @throws AttributeNotFoundException
     */
    public static function onClass(object|string $class): static
    {
        return Reflect::on($class)->getOrFailAttributeInstance(static::class);
    }

    /**
     * @param  object|class-string  $class
     * @return array<static>
     */
    public static function allOnClass(object|string $class): array
    {
        return Reflect::on($class)->getAllAttributeInstances(static::class);
    }
}
