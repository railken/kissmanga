<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidSortByDirectionException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('sortBy', $value, $suggestions);
    }
}
