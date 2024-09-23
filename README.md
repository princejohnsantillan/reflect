# Reflect

Clearer API for PHP Reflection.

### Example

Without `Reflect`
```php
    public function payload(): Payload
    {
        $ref = new ReflectionEnumBackedCase(self::class, $this->name);

        $attributes = $ref->getAttributes(ServicePayload::class);

        if (count($attributes) !== 1) {
            throw new LogicException('A single Service Payload attribute is required.');
        }

        /** @var ServicePayload $attribute */
        $attribute = $attributes[0]->newInstance();

        return $attribute->payload;
    }

```

With `Reflect`
```php
    public function payload(): Payload
    {
        return Reflect::on($this)
            ->getSoleAttributeInstance(ServicePayload::class)
            ->payload;
    }

```

Note: `getSoleAttributeInstance` already provides IDE support with template doc blocks.
