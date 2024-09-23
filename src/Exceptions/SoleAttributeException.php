<?php

namespace PrinceJohn\Reflect\Exceptions;

use Exception;

class SoleAttributeException extends Exception
{
    public static function of(string $attribute): static
    {
        return new static("One attribute of {$attribute} was expected.");
    }
}