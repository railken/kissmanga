<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaSearchBuilderInvalidArtistFilterException extends KissmangaInvalidArgumentException
{
    public function __construct($value = null, $suggestions = [])
    {
        return parent::__construct('artist', $value, $suggestions);
    }
}
