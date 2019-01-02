<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaParserDateNotSupportedException extends KissmangaException
{
    public function __construct($date)
    {
        $this->message = sprintf('Format %s not supported', $date);
    }
}
