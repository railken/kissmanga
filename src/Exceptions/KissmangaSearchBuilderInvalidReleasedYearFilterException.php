<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidReleasedYearFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('releasedYear', $value, $suggestions);
    }
}
