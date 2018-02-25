<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidReleasedYearValueException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null)
    {
        $this->message = sprintf("invalid value '%s' for method %s(), expects: 4 digits year (e.g. 2017)", $value, "releasedYear");
    }
}
