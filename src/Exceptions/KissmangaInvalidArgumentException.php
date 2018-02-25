<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaInvalidArgumentException extends KissmangaException
{
    public function __construct($field, $value = null, $suggestions = [])
    {
        $this->message = sprintf("invalid value '%s' for method %s(), expects: ".implode(", ", $suggestions)."", $value, $field);
    }
}
