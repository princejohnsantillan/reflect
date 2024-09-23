<?php

namespace PrinceJohn\Reflect\Exceptions;

use Exception;

final class SoleAttributeException extends Exception
{
    public static function of(?string $attribute): static
    {
        $message = is_null($attribute)
            ? 'One attribute was expected.'
            : "One {$attribute} attribute was expected.";

        return new self($message);
    }
}
