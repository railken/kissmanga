<?php

namespace Railken\Kissmanga\API\Searcher\Exceptions;

use Railken\Kissmanga\Exceptions\KissmangaInvalidArgumentException;

class BuilderInvalidGenresFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('genres', $value, $suggestions);
    }
}
