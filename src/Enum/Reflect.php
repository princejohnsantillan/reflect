<?php

namespace PrinceJohn\Reflect\Enum;

use BackedEnum;
use PrinceJohn\Reflect\Exceptions\AttributeNotFound;
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
     * Check if the attribute exists.
     *
     * @param  class-string  $attribute
     */
    public function hasAttribute(string $attribute): bool
    {
        return count($this->reflection->getAttributes($attribute)) > 0;
    }

    /**
     * Get the attribute instance.
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

    /**
     * Get the attribute instance or fail if not found.
     *
     * @template TAttribute
     *
     * @param  class-string<TAttribute>  $attribute
     * @return TAttribute
     *
     * @throws AttributeNotFound
     */
    public function getOrFailAttributeInstance(string $attribute)
    {
        $instance = $this->getAttributeInstance($attribute);

        if ($instance === null) {
            throw new AttributeNotFound("{$attribute} not found.");
        }

        return $instance;
    }
}
