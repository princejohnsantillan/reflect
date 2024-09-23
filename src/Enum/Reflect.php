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
     * @var array<string, ReflectionAttribute<BackedEnum|UnitEnum>[]>
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
    public function getAttributes(?string $attribute = null)
    {
        return $this->attributes[$attribute] ??= $this->reflection->getAttributes($attribute);
    }

    public function getAttributesCount(?string $attribute = null): int
    {
        return $this->attributesCount[$attribute] ??= count($this->getAttributes($attribute));
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum> */
    public function getSoleAttribute(?string $attribute = null)
    {
        $attributes = $this->getAttributes($attribute);

        if (count($attributes) !== 1) {
            throw SoleAttributeException::of($attribute);
        }

        return $attributes[0];
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum>|null */
    public function getFirstAttribute(?string $attribute = null)
    {
        return $this->getAttributes($attribute)[0] ?? null;
    }

    /** @return ReflectionAttribute<BackedEnum|UnitEnum>|null */
    public function getLastAttribute(?string $attribute = null)
    {
        return $this->getAttributes($attribute)[$this->getAttributesCount($attribute) - 1] ?? null;
    }

    /**
     * Get sole attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $attribute
     * @return TClass|mixed
     */
    public function getSoleAttributeInstance(?string $attribute = null)
    {
        return $this->getSoleAttribute($attribute)->newInstance();
    }

    /**
     * Get first attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $attribute
     * @return TClass|null|mixed
     */
    public function getFirstAttributeInstance(?string $attribute = null)
    {
        return $this->getFirstAttribute($attribute)?->newInstance();
    }

    /**
     * Get last attribute instance
     *
     * @template TClass
     *
     * @param  class-string<TClass>|null  $attribute
     * @return TClass|null|mixed
     */
    public function getLastAttributeInstance(?string $attribute = null)
    {
        return $this->getLastAttribute($attribute)?->newInstance();
    }
}
