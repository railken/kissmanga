<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaDirectoryBuilderInvalidBrowseByReleasedYearValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        $this->message = sprintf("invalid value '%s' for method %s(), expects: 4 digits year (e.g. 2017 or 'older')", $value, "browseBy");
    }
}
