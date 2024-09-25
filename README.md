# Reflect

Clearer API for PHP Attributes and Reflection.

## Requirement
PHP 8.1 or higher

## Installation
```bash
composer require princejohnsantillan/reflect
```

## Example

BEFORE:
```php
enum Plan: string{
    case FREE = 'free';
    case HOBBY = 'hobby';
    case PRO = 'professional';
    case TEAM = 'team';
    case ENTERPRISE = 'enterprise';
    
    public function price(): int {
        return match($this){
            static::FREE => 0,
            static::HOBBY => 10,
            static::PRO => 20,
            static::TEAM => 50,
            static::ENTERPRISE = 200
        };
    }
    
    public function color(): string {
        return match($this){
            static::FREE => 'yellow',
            static::HOBBY => 'orange',
            static::PRO => 'blue',
            static::TEAM => 'silver',
            static::ENTERPRISE = 'gold'
        };
    }
}

```

AFTER:
```php
use PrinceJohn\Reflect\Traits\HasEnumTarget;

#[\Attribute]
class Price{
    use HasEnumTarget;
    
    public function __construct(public int $price) {}
}
```

```php
use PrinceJohn\Reflect\Traits\HasEnumTarget;

#[\Attribute]
class Color{
    use HasEnumTarget;
    
    public function __construct(public string $color) {}
}

```

```php
use PrinceJohn\Reflect\Enum\Reflect;

enum Plan: string{
    #[Price(0)]
    #[Color('yellow')]
    case FREE = 'free';
    
    #[Price(10)]
    #[Color('orange')]
    case HOBBY = 'hobby';
    
    #[Price(20)]
    #[Color('blue')]
    case PRO = 'professional';
    
    #[Price(50)]
    #[Color('silver')]
    case TEAM = 'team';
    
    #[Price(200)]
    #[Color('gold')]
    case ENTERPRISE = 'enterprise';
    
    public function price(): int {
        // Demonstrating usage via the Reflect class        
        return Reflect::on($this)
            ->getAttributeInstance(Price::class)
            ->price;            
    }
    
    public function color(): string {
        // Demonstrating the usage via the HasEnumTarget trait
        return Color::onEnum($this)->color;
    }
}

```

>[!NOTE]
> Alternatively, just return the attribute class, that way you can have more functionality at your disposal. 