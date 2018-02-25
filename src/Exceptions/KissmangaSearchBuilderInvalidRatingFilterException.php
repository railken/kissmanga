<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidRatingFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('rating', $value, $suggestions);
    }
}
