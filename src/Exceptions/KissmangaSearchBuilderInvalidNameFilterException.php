<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidNameFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('name', $value, $suggestions);
    }
}
