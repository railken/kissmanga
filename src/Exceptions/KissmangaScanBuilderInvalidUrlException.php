<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaScanBuilderInvalidUrlException extends KissmangaException
{
    public function __construct($url, $suggestion)
    {
        $this->message = sprintf("invalid value '%s' for method %s(), e.g (%s)", $url, 'url', $suggestion);
    }
}
