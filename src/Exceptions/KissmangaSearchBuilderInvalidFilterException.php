<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        return parent::__construct($field, $value, $suggestions);
    }
}
