<?php

namespace Railken\Kissmanga\API\Scan\Exceptions;

use Railken\Kissmanga\Exceptions\KissmangaException;

class ParserFailedDecryptScanException extends KissmangaException
{
    public function __construct($url, $original, $iv, $key)
    {
        $this->message = sprintf('The decrypter failed translating : %s, key: %s, iv: %s', $original, implode('', unpack('H*', $key)), implode('', unpack('H*', $iv)));
    }
}
