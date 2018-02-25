<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidCompletedValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('completed', $value, $suggestions);
    }
}
