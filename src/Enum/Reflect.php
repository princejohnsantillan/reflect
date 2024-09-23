<?php

namespace PrinceJohn\Reflect\Enum;

use BackedEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use UnitEnum;

class Reflect
{
    final public function __construct(
        public ReflectionEnumBackedCase|ReflectionEnumUnitCase $reflection
    ) {}

    public static function on(BackedEnum|UnitEnum $enum): static
    {
        $reflection = $enum instanceof BackedEnum
            ? new ReflectionEnumBackedCase($enum::class, $enum->name)
            : new ReflectionEnumUnitCase($enum::class, $enum->name);

        return new static($reflection);
    }

    /**
     * Get the attribute instance
     *
     * @template TAttribute
     *
     * @param  class-string<TAttribute>  $attribute
     * @return TAttribute|null
     */
    public function getAttributeInstance(string $attribute)
    {
        $attributes = $this->reflection->getAttributes($attribute);

        return ($attributes[0] ?? null)?->newInstance();
    }

    /** @param class-string $attribute */
    public function hasAttribute(string $attribute): bool
    {
        return count($this->reflection->getAttributes($attribute)) > 0;
    }
}
