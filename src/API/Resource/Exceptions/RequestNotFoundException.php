<?php

namespace Railken\Kissmanga\API\Resource\Exceptions;

use Railken\Kissmanga\Exceptions\KissmangaException;

class RequestNotFoundException extends KissmangaException
{
    public function __construct($uid)
    {
        $this->message = sprintf("The resource %s doesn't exist or is invalid", $uid);
    }
}
