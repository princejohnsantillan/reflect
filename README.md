# Reflect

Clearer API for PHP Reflection.

### Example

Without `Reflect`
```php
    public function payload(): Payload
    {
        $ref = new ReflectionEnumBackedCase(self::class, $this->name);

        $attributes = $ref->getAttributes(ServicePayload::class);        

        /** @var ServicePayload $attribute */
        $attribute = $attributes[0]->newInstance();

        return $attribute->getPayload();
    }

```

With `Reflect`
```php
    public function payload(): Payload
    {
        return Reflect::on($this)
            ->getAttributeInstance(ServicePayload::class)
            ->getPayload();
    }

```

Note: `getSoleAttributeInstance` already provides IDE support with template doc blocks.
