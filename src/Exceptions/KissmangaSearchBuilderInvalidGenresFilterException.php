<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidGenresFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('genres', $value, $suggestions);
    }
}
