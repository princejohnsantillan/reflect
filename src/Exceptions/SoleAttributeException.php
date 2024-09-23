<?php

namespace PrinceJohn\Reflect\Exceptions;

use Exception;

final class SoleAttributeException extends Exception
{
    public static function of(?string $attribute): static
    {
        return new self("One {$attribute} attribute was expected.");
    }
}
