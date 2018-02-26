<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaDirectoryBuilderInvalidBrowseByInitialValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('browseBy', $value, $suggestions);
    }
}