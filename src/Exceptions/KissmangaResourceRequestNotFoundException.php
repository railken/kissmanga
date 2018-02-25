<?php

namespace Railken\Kissmanga\Exceptions;

class KissmangaResourceRequestNotFoundException extends KissmangaException
{
    public function __construct($uid)
    {
        $this->message = sprintf("The resource %s doesn't exist or is invalid", $uid);
    }
}
