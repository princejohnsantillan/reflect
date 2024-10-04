<?php

namespace PrinceJohn\Reflect\Class;

use PrinceJohn\Reflect\Exceptions\AttributeNotFoundException;
use ReflectionClass;
use ReflectionException;

class Reflect
{
    final public function __construct(
        /**
         * @var ReflectionClass<object> $reflection
         */
        public ReflectionClass $reflection
    ) {}

    /**
     * @param  object|class-string  $class
     *
     * @throws ReflectionException
     */
    public static function on(object|string $class): static
    {
        return new static(new ReflectionClass($class));
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
     * @throws AttributeNotFoundException
     */
    public function getOrFailAttributeInstance(string $attribute)
    {
        $instance = $this->getAttributeInstance($attribute);

        if ($instance === null) {
            throw new AttributeNotFoundException("{$attribute} not found.");
        }

        return $instance;
    }

    /**
     * Get all attribute instances.
     *
     * @template TAttribute
     *
     * @param  class-string<TAttribute>  $attribute
     * @return array<TAttribute>
     */
    public function getAllAttributeInstances(string $attribute)
    {
        return array_map(
            fn ($ref) => $ref->newInstance(),
            $this->reflection->getAttributes($attribute)
        );
    }
}
