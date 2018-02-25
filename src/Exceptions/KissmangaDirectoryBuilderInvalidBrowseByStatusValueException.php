<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaDirectoryBuilderInvalidBrowseByStatusValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('browseBy', $value, $suggestions);
    }
}
