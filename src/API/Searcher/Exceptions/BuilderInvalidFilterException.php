<?php

namespace Railken\Kissmanga\API\Searcher\Exceptions;

use Railken\Kissmanga\Exceptions\KissmangaInvalidArgumentException;

class BuilderInvalidFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        return parent::__construct($field, $value, $suggestions);
    }
}
