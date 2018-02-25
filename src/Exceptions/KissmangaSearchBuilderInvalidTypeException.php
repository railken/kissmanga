<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidTypeException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('type', $value, $suggestions);
    }
}
