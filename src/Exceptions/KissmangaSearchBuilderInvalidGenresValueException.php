<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidGenresValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('genres', implode(", ", $value), $suggestions);
    }
}
