<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidAuthorFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('author', $value, $suggestions);
    }
}
