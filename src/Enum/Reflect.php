<?php

namespace PrinceJohn\Reflect\Enum;

use BackedEnum;
use PrinceJohn\Reflect\Exceptions\SoleAttributeException;
use ReflectionAttribute;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use UnitEnum;

class Reflect
{
    /**
     * @var ReflectionAttribute
     */
    protected array $attributes = [];

    /**
     * @var array<string, int>
     */
    protected array $attributesCount = [];

    final public function __construct(
        public ReflectionEnumBackedCase|ReflectionEnumUnitCase $reflection
    ) {}

    public static function on(BackedEnum|UnitEnum $enum): static
    {
        $reflection = match (true) {
            $enum instanceof BackedEnum => new ReflectionEnumBackedCase($enum::class, $enum->name),
            $enum instanceof UnitEnum => new ReflectionEnumUnitCase($enum::class, $enum->name),
        };

        return new static($reflection);
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum>[] */
    public function getAttributes(?string $name = null)
    {
        return $this->attributes[$name] ??= $this->reflection->getAttributes($name);
    }

    public function getAttributesCount(?string $name = null): int
    {
        return $this->attributesCount[$name] ??= count($this->getAttributes($name));
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum> */
    public function getSoleAttribute(?string $name = null)
    {
        $attributes = $this->getAttributes($name);

        if (count($attributes) !== 1) {
            throw SoleAttributeException::of($name);
        }

        return $attributes[0];
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum>|null */
    public function getFirstAttribute(?string $name = null)
    {
        return $this->getAttributes($name)[0] ?? null;
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum>|null */
    public function getLastAttribute(?string $name = null)
    {
        return $this->getAttributes($name)[$this->getAttributesCount($name) - 1] ?? null;
    }

    /**
     * Get sole attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $name
     * @return TClass|mixed
     */
    public function getSoleAttributeInstance(?string $name = null)
    {
        return $this->getSoleAttribute($name)->newInstance();
    }

    /**
     * Get first attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $name
     * @return TClass|null|mixed
     */
    public function getFirstAttributeInstance(?string $name = null)
    {
        return $this->getFirstAttribute($name)?->newInstance();
    }

    /**
     * Get last attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $name
     * @return TClass|null|mixed
     */
    public function getLastAttributeInstance(?string $name = null)
    {
        return $this->getLastAttribute($name)?->newInstance();
    }
}
